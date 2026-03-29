<?php
/**
 * Pesapal Payment Gateway Configuration
 * Handles Pesapal API integration for DTEHM donations
 */

// Pesapal API endpoints
define('PESAPAL_SANDBOX_URL', 'https://demo.pesapal.com/API/PostPesapalDirectOrderV4');
define('PESAPAL_LIVE_URL', 'https://www.pesapal.com/API/PostPesapalDirectOrderV4');
define('PESAPAL_QUERY_STATUS_SANDBOX', 'https://demo.pesapal.com/api/querypaymentstatus');
define('PESAPAL_QUERY_STATUS_LIVE', 'https://www.pesapal.com/api/querypaymentstatus');

/**
 * Get Pesapal configuration from site_settings
 */
function getPesapalConfig() {
    global $pdo;
    
    $settings = [];
    $stmt = $pdo->prepare("SELECT setting_key, setting_value FROM site_settings WHERE setting_group = 'payment'");
    $stmt->execute();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $settings[$row['setting_key']] = $row['setting_value'];
    }
    
    return [
        'consumer_key' => $settings['pesapal_consumer_key'] ?? '',
        'consumer_secret' => $settings['pesapal_consumer_secret'] ?? '',
        'environment' => $settings['pesapal_environment'] ?? 'sandbox',
        'ipn_url' => $settings['pesapal_ipn_url'] ?? '',
        'api_url' => ($settings['pesapal_environment'] ?? 'sandbox') === 'live' ? PESAPAL_LIVE_URL : PESAPAL_SANDBOX_URL,
        'query_url' => ($settings['pesapal_environment'] ?? 'sandbox') === 'live' ? PESAPAL_QUERY_STATUS_LIVE : PESAPAL_QUERY_STATUS_SANDBOX
    ];
}

/**
 * Generate OAuth signature for Pesapal API
 */
function pesapalOAuthSignature($consumer_key, $consumer_secret, $signed_url) {
    $oauth = [
        'oauth_consumer_key' => $consumer_key,
        'oauth_signature_method' => 'HMAC-SHA1',
        'oauth_timestamp' => time(),
        'oauth_nonce' => md5(uniqid(rand(), true)),
        'oauth_version' => '1.0'
    ];
    
    $base_info = buildBaseString($signed_url, 'GET', $oauth);
    $composite_key = rawurlencode($consumer_secret) . '&';
    $oauth['oauth_signature'] = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
    
    return $oauth;
}

/**
 * Build OAuth base string
 */
function buildBaseString($baseURI, $method, $params) {
    $r = [];
    ksort($params);
    foreach ($params as $key => $value) {
        $r[] = "$key=" . rawurlencode($value);
    }
    return $method . "&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
}

/**
 * Generate Pesapal payment iframe URL
 */
function generatePesapalPaymentURL($donation) {
    $config = getPesapalConfig();
    
    if (empty($config['consumer_key']) || empty($config['consumer_secret'])) {
        throw new Exception('Pesapal credentials not configured');
    }
    
    // Build payment XML
    $xml = '<?xml version="1.0" encoding="utf-8"?>';
    $xml .= '<PesapalDirectOrderInfo xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';
    $xml .= '<Amount>' . number_format($donation['amount'], 2, '.', '') . '</Amount>';
    $xml .= '<Description>Donation to DTEHM - ' . ($donation['cause_name'] ?? 'General Fund') . '</Description>';
    $xml .= '<Type>MERCHANT</Type>';
    $xml .= '<Reference>' . $donation['merchant_reference'] . '</Reference>';
    $xml .= '<FirstName>' . htmlspecialchars($donation['first_name']) . '</FirstName>';
    $xml .= '<LastName>' . htmlspecialchars($donation['last_name']) . '</LastName>';
    $xml .= '<Email>' . htmlspecialchars($donation['email']) . '</Email>';
    $xml .= '<PhoneNumber>' . htmlspecialchars($donation['phone'] ?? '') . '</PhoneNumber>';
    $xml .= '</PesapalDirectOrderInfo>';
    
    // Build callback URL
    $callback_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") 
                  . "://$_SERVER[HTTP_HOST]/ulfa/donate-verify.php";
    
    // Build payment URL with parameters
    $params = [
        'oauth_callback' => $callback_url,
        'pesapal_request_data' => $xml
    ];
    
    $oauth = pesapalOAuthSignature($config['consumer_key'], $config['consumer_secret'], $config['api_url']);
    
    // Build query string
    $query = [];
    foreach ($oauth as $key => $value) {
        $query[] = $key . '=' . urlencode($value);
    }
    foreach ($params as $key => $value) {
        $query[] = $key . '=' . urlencode($value);
    }
    
    return $config['api_url'] . '?' . implode('&', $query);
}

/**
 * Query Pesapal payment status
 */
function queryPesapalPaymentStatus($merchant_reference, $tracking_id) {
    $config = getPesapalConfig();
    
    $oauth = pesapalOAuthSignature($config['consumer_key'], $config['consumer_secret'], $config['query_url']);
    
    $query = [];
    foreach ($oauth as $key => $value) {
        $query[] = $key . '=' . urlencode($value);
    }
    $query[] = 'pesapal_merchant_reference=' . urlencode($merchant_reference);
    $query[] = 'pesapal_transaction_tracking_id=' . urlencode($tracking_id);
    
    $url = $config['query_url'] . '?' . implode('&', $query);
    
    // Make HTTP request
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    
    // Parse response
    if ($response) {
        // Response format: pesapal_response_data=<tracking_id>,<payment_method>,<status>,<merchant_reference>
        $parts = explode(',', str_replace('pesapal_response_data=', '', $response));
        if (count($parts) >= 3) {
            return [
                'tracking_id' => $parts[0] ?? '',
                'payment_method' => $parts[1] ?? '',
                'status' => $parts[2] ?? '',
                'merchant_reference' => $parts[3] ?? ''
            ];
        }
    }
    
    return null;
}

/**
 * Update donation status based on Pesapal response
 */
function updateDonationStatus($donation_id, $tracking_id, $payment_method, $status) {
    global $pdo;
    
    $payment_status = 'pending';
    $payment_date = null;
    
    switch (strtoupper($status)) {
        case 'COMPLETED':
        case 'PAID':
            $payment_status = 'completed';
            $payment_date = date('Y-m-d H:i:s');
            break;
        case 'FAILED':
            $payment_status = 'failed';
            break;
        case 'CANCELLED':
        case 'INVALID':
            $payment_status = 'cancelled';
            break;
    }
    
    $stmt = $pdo->prepare("
        UPDATE donations 
        SET pesapal_tracking_id = ?,
            pesapal_payment_method = ?,
            payment_status = ?,
            payment_date = ?,
            updated_at = NOW()
        WHERE id = ?
    ");
    
    $stmt->execute([
        $tracking_id,
        $payment_method,
        $payment_status,
        $payment_date,
        $donation_id
    ]);
    
    // If payment completed, update cause totals
    if ($payment_status === 'completed') {
        $donation = getDonationById($donation_id);
        if ($donation && $donation['cause_id']) {
            $stmt = $pdo->prepare("
                UPDATE causes 
                SET total_donations = total_donations + ?,
                    donation_count = donation_count + 1
                WHERE id = ?
            ");
            $stmt->execute([$donation['amount'], $donation['cause_id']]);
        }
    }
    
    return $payment_status;
}

/**
 * Get donation by ID
 */
function getDonationById($id) {
    global $pdo;
    
    $stmt = $pdo->prepare("
        SELECT d.*, c.title as cause_title
        FROM donations d
        LEFT JOIN causes c ON d.cause_id = c.id
        WHERE d.id = ?
    ");
    
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Get donation by merchant reference
 */
function getDonationByReference($merchant_reference) {
    global $pdo;
    
    $stmt = $pdo->prepare("
        SELECT d.*, c.title as cause_title
        FROM donations d
        LEFT JOIN causes c ON d.cause_id = c.id
        WHERE d.pesapal_merchant_reference = ?
    ");
    
    $stmt->execute([$merchant_reference]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
