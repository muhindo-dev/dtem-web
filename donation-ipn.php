<?php
/**
 * Donation IPN Handler
 * Receives payment status notifications from Pesapal
 * 
 * This endpoint should be registered with Pesapal as the IPN URL
 * Pesapal will call this URL when payment status changes
 */

// Disable any output buffering
ob_start();

require_once 'config.php';
require_once 'functions.php';
require_once 'includes/PesapalHelper.php';

// Log IPN requests for debugging
$log_file = __DIR__ . '/logs/pesapal_ipn.log';
$log_dir = dirname($log_file);
if (!is_dir($log_dir)) {
    mkdir($log_dir, 0755, true);
}

function logIPN($message) {
    global $log_file;
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($log_file, "[$timestamp] $message\n", FILE_APPEND);
}

logIPN("IPN Request received");
logIPN("GET: " . json_encode($_GET));
logIPN("POST: " . json_encode($_POST));

// Get parameters - Pesapal sends via GET or POST depending on IPN registration
$order_tracking_id = $_GET['OrderTrackingId'] ?? $_POST['OrderTrackingId'] ?? '';
$order_merchant_reference = $_GET['OrderMerchantReference'] ?? $_POST['OrderMerchantReference'] ?? '';
$notification_type = $_GET['OrderNotificationType'] ?? $_POST['OrderNotificationType'] ?? '';

// Validate required parameters
if (empty($order_tracking_id) || empty($order_merchant_reference)) {
    logIPN("ERROR: Missing required parameters");
    http_response_code(400);
    echo PesapalHelper::buildIPNResponse($order_tracking_id, $order_merchant_reference, 500);
    exit;
}

logIPN("Processing: tracking_id=$order_tracking_id, merchant_ref=$order_merchant_reference");

try {
    // Get Pesapal settings
    $stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings WHERE setting_key LIKE 'pesapal_%'");
    $pesapal_settings = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pesapal_settings[$row['setting_key']] = $row['setting_value'];
    }
    
    // Find donation in database
    $stmt = $pdo->prepare("SELECT * FROM donations WHERE order_tracking_id = ? OR merchant_reference = ?");
    $stmt->execute([$order_tracking_id, $order_merchant_reference]);
    $donation = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$donation) {
        logIPN("ERROR: Donation not found for reference: $order_merchant_reference");
        http_response_code(404);
        echo PesapalHelper::buildIPNResponse($order_tracking_id, $order_merchant_reference, 500);
        exit;
    }
    
    logIPN("Found donation ID: " . $donation['id']);
    
    // Initialize Pesapal and get transaction status
    $pesapal = new PesapalHelper(
        $pesapal_settings['pesapal_consumer_key'],
        $pesapal_settings['pesapal_consumer_secret'],
        $pesapal_settings['pesapal_environment'] ?? 'sandbox'
    );
    
    $status_result = $pesapal->getTransactionStatus($order_tracking_id);
    logIPN("Status result: " . json_encode($status_result));
    
    if ($status_result['success']) {
        $status_code = $status_result['status_code'];
        $new_status = 'pending';
        
        // Map Pesapal status codes
        // 0 = INVALID, 1 = COMPLETED, 2 = FAILED, 3 = REVERSED
        switch ($status_code) {
            case 1:
                $new_status = 'completed';
                break;
            case 2:
                $new_status = 'failed';
                break;
            case 3:
                $new_status = 'reversed';
                break;
            case 0:
                $new_status = 'invalid';
                break;
        }
        
        logIPN("Status code: $status_code, New status: $new_status");
        
        // Only update if status changed and not already completed
        if ($donation['payment_status'] !== $new_status) {
            // Begin transaction
            $pdo->beginTransaction();
            
            try {
                // Update donation record
                $update_stmt = $pdo->prepare("
                    UPDATE donations SET 
                        payment_status = ?,
                        payment_method = ?,
                        confirmation_code = ?,
                        completed_at = CASE WHEN ? = 'completed' THEN NOW() ELSE completed_at END,
                        updated_at = NOW()
                    WHERE id = ?
                ");
                $update_stmt->execute([
                    $new_status,
                    $status_result['payment_method'] ?? null,
                    $status_result['confirmation_code'] ?? null,
                    $new_status,
                    $donation['id']
                ]);
                
                logIPN("Updated donation status to: $new_status");
                
                // If payment completed and has cause, update cause raised amount
                if ($new_status === 'completed' && $donation['cause_id'] && $donation['payment_status'] !== 'completed') {
                    $cause_update = $pdo->prepare("
                        UPDATE causes SET raised_amount = raised_amount + ? WHERE id = ?
                    ");
                    $cause_update->execute([$donation['amount'], $donation['cause_id']]);
                    logIPN("Updated cause {$donation['cause_id']} raised amount by {$donation['amount']}");
                }
                
                // If payment reversed and was completed, reverse the cause amount
                if ($new_status === 'reversed' && $donation['payment_status'] === 'completed' && $donation['cause_id']) {
                    $cause_update = $pdo->prepare("
                        UPDATE causes SET raised_amount = raised_amount - ? WHERE id = ?
                    ");
                    $cause_update->execute([$donation['amount'], $donation['cause_id']]);
                    logIPN("Reversed cause {$donation['cause_id']} raised amount by {$donation['amount']}");
                }
                
                $pdo->commit();
                logIPN("Transaction committed successfully");
                
            } catch (Exception $e) {
                $pdo->rollBack();
                logIPN("ERROR: Transaction failed - " . $e->getMessage());
                throw $e;
            }
        } else {
            logIPN("Status unchanged, no update needed");
        }
        
        // Send success response to Pesapal
        http_response_code(200);
        header('Content-Type: application/json');
        echo PesapalHelper::buildIPNResponse($order_tracking_id, $order_merchant_reference, 200);
        logIPN("IPN processed successfully");
        
    } else {
        logIPN("ERROR: Failed to get transaction status from Pesapal");
        http_response_code(500);
        echo PesapalHelper::buildIPNResponse($order_tracking_id, $order_merchant_reference, 500);
    }
    
} catch (Exception $e) {
    logIPN("EXCEPTION: " . $e->getMessage());
    http_response_code(500);
    echo PesapalHelper::buildIPNResponse($order_tracking_id, $order_merchant_reference, 500);
}

ob_end_flush();
