<?php
/**
 * Donation Step 3 - Payment Verification / Callback
 * Pesapal redirects here after payment attempt
 * Checks payment status and shows result to user
 */
$currentPage = 'donate';
$pageTitle = 'Payment Status';
$pageDescription = 'Checking your payment status...';

require_once 'config.php';
require_once 'functions.php';
require_once 'includes/PesapalHelper.php';

// Get currency settings
$currency = getCurrency();

// Get callback parameters from Pesapal
$order_tracking_id = $_GET['OrderTrackingId'] ?? '';
$order_merchant_reference = $_GET['OrderMerchantReference'] ?? '';
$notification_type = $_GET['OrderNotificationType'] ?? '';

$payment_status = null;
$donation = null;
$error_message = '';

// Get Pesapal settings
$stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings WHERE setting_key LIKE 'pesapal_%'");
$pesapal_settings = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $pesapal_settings[$row['setting_key']] = $row['setting_value'];
}

// Check if we have tracking info
if (empty($order_tracking_id)) {
    // Check session for tracking info
    if (isset($_SESSION['payment_tracking'])) {
        $order_tracking_id = $_SESSION['payment_tracking']['order_tracking_id'];
        $order_merchant_reference = $_SESSION['payment_tracking']['merchant_reference'];
    }
}

if (!empty($order_tracking_id)) {
    try {
        // Get donation from database
        $stmt = $pdo->prepare("SELECT * FROM donations WHERE order_tracking_id = ? OR merchant_reference = ?");
        $stmt->execute([$order_tracking_id, $order_merchant_reference]);
        $donation = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($donation) {
            // Initialize Pesapal and check status
            $pesapal = new PesapalHelper(
                $pesapal_settings['pesapal_consumer_key'],
                $pesapal_settings['pesapal_consumer_secret'],
                $pesapal_settings['pesapal_environment'] ?? 'sandbox'
            );
            
            $status_result = $pesapal->getTransactionStatus($order_tracking_id);
            
            if ($status_result['success']) {
                $payment_status = $status_result;
                
                // Update donation record if status changed
                $new_status = 'pending';
                $status_code = $status_result['status_code'];
                
                if ($status_code === 1) {
                    $new_status = 'completed';
                } elseif ($status_code === 2) {
                    $new_status = 'failed';
                } elseif ($status_code === 3) {
                    $new_status = 'reversed';
                }
                
                // Update database if status changed
                if ($donation['payment_status'] !== $new_status) {
                    $update_stmt = $pdo->prepare("
                        UPDATE donations SET 
                            payment_status = ?,
                            payment_method = ?,
                            confirmation_code = ?,
                            completed_at = CASE WHEN ? = 'completed' THEN NOW() ELSE completed_at END
                        WHERE id = ?
                    ");
                    $update_stmt->execute([
                        $new_status,
                        $status_result['payment_method'] ?? null,
                        $status_result['confirmation_code'] ?? null,
                        $new_status,
                        $donation['id']
                    ]);
                    
                    $donation['payment_status'] = $new_status;
                    
                    // If completed, update cause raised amount
                    if ($new_status === 'completed' && $donation['cause_id']) {
                        $cause_update = $pdo->prepare("
                            UPDATE causes SET raised_amount = raised_amount + ? WHERE id = ?
                        ");
                        $cause_update->execute([$donation['amount'], $donation['cause_id']]);
                    }
                }
            } else {
                $error_message = 'Unable to verify payment status. Please check again later.';
            }
        } else {
            $error_message = 'Donation record not found.';
        }
        
    } catch (Exception $e) {
        $error_message = 'An error occurred while verifying your payment.';
        error_log('Payment verification error: ' . $e->getMessage());
    }
} else {
    $error_message = 'No payment information found. Please start a new donation.';
}

// Clear session data
unset($_SESSION['donation_data']);
unset($_SESSION['payment_tracking']);

include 'includes/header.php';
?>

<style>
.status-page {
    padding: 120px 0 80px;
    min-height: 100vh;
    background: linear-gradient(180deg, #f8f9fa 0%, #fff 100%);
}

.status-container {
    max-width: 550px;
    margin: 0 auto;
    padding: 0 1rem;
}

.status-card {
    background: #fff;
    border: 2px solid var(--primary-blue);
    text-align: center;
    padding: 3rem 2rem;
}

.status-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    border: 4px solid;
}

.status-icon.success {
    background: #d4edda;
    border-color: #28a745;
    color: #28a745;
}

.status-icon.pending {
    background: #fff3cd;
    border-color: #ffc107;
    color: #ffc107;
}

.status-icon.failed {
    background: #f8d7da;
    border-color: #dc3545;
    color: #dc3545;
}

.status-icon.error {
    background: #f8d7da;
    border-color: #dc3545;
    color: #dc3545;
}

.status-title {
    font-size: 1.75rem;
    font-weight: 800;
    margin-bottom: 0.75rem;
}

.status-title.success { color: #28a745; }
.status-title.pending { color: #856404; }
.status-title.failed { color: #dc3545; }
.status-title.error { color: #dc3545; }

.status-message {
    color: #666;
    font-size: 1.1rem;
    margin-bottom: 2rem;
}

.donation-details {
    background: #f8f9fa;
    border: 2px solid #dee2e6;
    padding: 1.5rem;
    text-align: left;
    margin-bottom: 2rem;
}

.donation-details h4 {
    font-size: 0.9rem;
    font-weight: 700;
    color: var(--primary-black);
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--primary-yellow);
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
    font-size: 0.95rem;
}

.detail-label {
    color: #666;
}

.detail-value {
    font-weight: 600;
    color: var(--primary-black);
}

.detail-row.total {
    border-top: 2px solid #dee2e6;
    margin-top: 0.5rem;
    padding-top: 1rem;
}

.detail-row.total .detail-label,
.detail-row.total .detail-value {
    font-size: 1.1rem;
    font-weight: 700;
}

.btn-group {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.btn-primary {
    padding: 1rem 2rem;
    background: var(--primary-yellow);
    color: var(--primary-black);
    border: 2px solid var(--primary-blue);
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 4px 4px 0 var(--primary-black);
}

.btn-secondary {
    padding: 1rem 2rem;
    background: #fff;
    color: var(--primary-black);
    border: 2px solid var(--primary-blue);
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-secondary:hover {
    background: #f8f9fa;
}

.reference-number {
    margin-top: 1.5rem;
    padding: 1rem;
    background: var(--light-yellow);
    border: 2px solid var(--primary-yellow);
}

.reference-number span {
    font-size: 0.85rem;
    color: #666;
}

.reference-number strong {
    display: block;
    font-size: 1.1rem;
    margin-top: 0.25rem;
    font-family: monospace;
}

.steps-indicator {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
}

.step {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    color: #999;
}

.step.completed {
    color: #28a745;
}

.step-number {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #ddd;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.8rem;
}

.step.completed .step-number {
    background: #28a745;
    color: #fff;
}

.step-divider {
    width: 40px;
    height: 2px;
    background: #28a745;
}

.share-section {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #eee;
}

.share-section h5 {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 1rem;
}

.share-buttons {
    display: flex;
    justify-content: center;
    gap: 0.75rem;
}

.share-btn {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid;
    font-size: 1.1rem;
    text-decoration: none;
    transition: all 0.2s;
}

.share-btn.facebook { border-color: #1877f2; color: #1877f2; }
.share-btn.twitter { border-color: #1da1f2; color: #1da1f2; }
.share-btn.whatsapp { border-color: #25d366; color: #25d366; }

.share-btn:hover {
    transform: translateY(-2px);
}

.retry-section {
    margin-top: 2rem;
    padding: 1rem;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
}

.retry-section p {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 1rem;
}

.check-status-btn {
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
    color: #fff;
    border: none;
    font-weight: 600;
    cursor: pointer;
    font-size: 0.9rem;
}
</style>

<div class="status-page">
    <div class="status-container">
        <!-- Progress Steps -->
        <div class="steps-indicator">
            <div class="step completed">
                <span class="step-number"><i class="fas fa-check"></i></span>
                <span>Details</span>
            </div>
            <div class="step-divider"></div>
            <div class="step completed">
                <span class="step-number"><i class="fas fa-check"></i></span>
                <span>Confirm</span>
            </div>
            <div class="step-divider"></div>
            <div class="step completed">
                <span class="step-number"><i class="fas fa-check"></i></span>
                <span>Complete</span>
            </div>
        </div>
        
        <div class="status-card">
            <?php if ($error_message): ?>
                <!-- Error State -->
                <div class="status-icon error">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <h2 class="status-title error">Something Went Wrong</h2>
                <p class="status-message"><?php echo htmlspecialchars($error_message); ?></p>
                <div class="btn-group">
                    <a href="donation-step1.php" class="btn-primary">
                        <i class="fas fa-redo"></i> Try Again
                    </a>
                </div>
                
            <?php elseif ($donation && $donation['payment_status'] === 'completed'): ?>
                <!-- Success State -->
                <div class="status-icon success">
                    <i class="fas fa-check"></i>
                </div>
                <h2 class="status-title success">Thank You!</h2>
                <p class="status-message">Your donation has been received successfully. Your generosity will help transform lives.</p>
                
                <div class="donation-details">
                    <h4><i class="fas fa-receipt"></i> Donation Receipt</h4>
                    <div class="detail-row">
                        <span class="detail-label">Donor</span>
                        <span class="detail-value"><?php echo $donation['is_anonymous'] ? 'Anonymous' : htmlspecialchars($donation['donor_name']); ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Date</span>
                        <span class="detail-value"><?php echo date('M d, Y - h:i A', strtotime($donation['created_at'])); ?></span>
                    </div>
                    <?php if ($payment_status && $payment_status['payment_method']): ?>
                    <div class="detail-row">
                        <span class="detail-label">Payment Method</span>
                        <span class="detail-value"><?php echo htmlspecialchars($payment_status['payment_method']); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="detail-row total">
                        <span class="detail-label">Amount</span>
                        <span class="detail-value"><?php echo formatCurrency($donation['amount']); ?></span>
                    </div>
                </div>
                
                <div class="reference-number">
                    <span>Reference Number</span>
                    <strong><?php echo htmlspecialchars($donation['merchant_reference']); ?></strong>
                </div>
                
                <div class="btn-group" style="margin-top: 2rem;">
                    <a href="index.php" class="btn-secondary">
                        <i class="fas fa-home"></i> Go Home
                    </a>
                    <a href="donation-step1.php" class="btn-primary">
                        <i class="fas fa-heart"></i> Donate Again
                    </a>
                </div>
                
                <div class="share-section">
                    <h5>Share your support</h5>
                    <div class="share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://dtehmhealth.com'); ?>" target="_blank" class="share-btn facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode('I just donated to DTEHM to support orphaned children in Uganda! Join me: https://dtehmhealth.com'); ?>" target="_blank" class="share-btn twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text=<?php echo urlencode('I just donated to DTEHM to support orphaned children in Uganda! Join me: https://dtehmhealth.com'); ?>" target="_blank" class="share-btn whatsapp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
                
            <?php elseif ($donation && $donation['payment_status'] === 'failed'): ?>
                <!-- Failed State -->
                <div class="status-icon failed">
                    <i class="fas fa-times"></i>
                </div>
                <h2 class="status-title failed">Payment Failed</h2>
                <p class="status-message">
                    <?php echo $payment_status['description'] ?? 'Your payment could not be processed. Please try again.'; ?>
                </p>
                
                <div class="btn-group">
                    <a href="donation-step1.php" class="btn-primary">
                        <i class="fas fa-redo"></i> Try Again
                    </a>
                </div>
                
            <?php elseif ($donation && $donation['payment_status'] === 'pending'): ?>
                <!-- Pending State -->
                <div class="status-icon pending">
                    <i class="fas fa-clock"></i>
                </div>
                <h2 class="status-title pending">Payment Processing</h2>
                <p class="status-message">Your payment is being processed. This may take a few moments.</p>
                
                <div class="donation-details">
                    <h4><i class="fas fa-info-circle"></i> Transaction Details</h4>
                    <div class="detail-row">
                        <span class="detail-label">Amount</span>
                        <span class="detail-value"><?php echo formatCurrency($donation['amount']); ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Reference</span>
                        <span class="detail-value"><?php echo htmlspecialchars($donation['merchant_reference']); ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Status</span>
                        <span class="detail-value" style="color: #856404;">Pending</span>
                    </div>
                </div>
                
                <div class="retry-section">
                    <p>If you've completed the payment, click below to check the status again:</p>
                    <button onclick="location.reload();" class="check-status-btn">
                        <i class="fas fa-sync-alt"></i> Check Status
                    </button>
                </div>
                
                <div class="btn-group" style="margin-top: 1.5rem;">
                    <a href="index.php" class="btn-secondary">
                        <i class="fas fa-home"></i> Go Home
                    </a>
                </div>
                
            <?php else: ?>
                <!-- Unknown State -->
                <div class="status-icon error">
                    <i class="fas fa-question"></i>
                </div>
                <h2 class="status-title error">Status Unknown</h2>
                <p class="status-message">We couldn't determine the status of your payment. Please contact us if you need assistance.</p>
                
                <div class="btn-group">
                    <a href="contact.php" class="btn-secondary">
                        <i class="fas fa-envelope"></i> Contact Us
                    </a>
                    <a href="donation-step1.php" class="btn-primary">
                        <i class="fas fa-redo"></i> Try Again
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
