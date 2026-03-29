<?php
require_once 'config.php';
require_once 'functions.php';
require_once 'includes/pesapal-config.php';

// Check if donation data exists in session
if (!isset($_SESSION['pending_donation'])) {
    header('Location: donate.php');
    exit;
}

$donation_data = $_SESSION['pending_donation'];

try {
    // Get exchange rate and convert USD to UGX for Pesapal
    $exchangeRate = getExchangeRate();
    $amountUsd = $donation_data['amount']; // User's donation in USD
    $amountUgx = convertUsdToUgx($amountUsd); // Convert to UGX for Pesapal
    
    // Insert donation into database
    $stmt = $pdo->prepare("
        INSERT INTO donations (
            donor_name, donor_email, donor_phone,
            amount, amount_usd, exchange_rate, currency, cause_id, message, is_anonymous,
            pesapal_merchant_reference, payment_status,
            ip_address, user_agent
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        )
    ");
    
    $donor_name = $donation_data['first_name'] . ' ' . $donation_data['last_name'];
    
    $stmt->execute([
        $donor_name,
        $donation_data['email'],
        $donation_data['phone'] ?? null,
        $amountUgx,        // Store UGX amount (what Pesapal processes)
        $amountUsd,        // Store original USD amount
        $exchangeRate,     // Store exchange rate used
        'UGX',             // Pesapal currency
        $donation_data['cause_id'],
        $donation_data['message'] ?? null,
        $donation_data['is_anonymous'],
        $donation_data['merchant_reference'],
        'pending',
        $_SERVER['REMOTE_ADDR'] ?? null,
        $_SERVER['HTTP_USER_AGENT'] ?? null
    ]);
    
    $donation_id = $pdo->lastInsertId();
    
    // Store donation ID in session
    $_SESSION['donation_id'] = $donation_id;
    
    // Store both amounts in session for display
    $_SESSION['pending_donation']['amount_usd'] = $amountUsd;
    $_SESSION['pending_donation']['amount_ugx'] = $amountUgx;
    $_SESSION['pending_donation']['exchange_rate'] = $exchangeRate;
    
    // Prepare data for Pesapal (send UGX amount)
    $pesapal_data = [
        'amount' => $amountUgx,  // UGX amount for Pesapal
        'merchant_reference' => $donation_data['merchant_reference'],
        'first_name' => $donation_data['first_name'],
        'last_name' => $donation_data['last_name'],
        'email' => $donation_data['email'],
        'phone' => $donation_data['phone'] ?? '',
        'cause_name' => $donation_data['cause_title']
    ];
    
    // Generate Pesapal payment URL
    $payment_url = generatePesapalPaymentURL($pesapal_data);
    
    // Store payment URL in session
    $_SESSION['payment_url'] = $payment_url;
    
    // Redirect to payment iframe page
    header('Location: donate-payment.php');
    exit;
    
} catch (Exception $e) {
    error_log("Donation processing error: " . $e->getMessage());
    $_SESSION['error'] = 'An error occurred while processing your donation. Please try again.';
    header('Location: donate.php');
    exit;
}
