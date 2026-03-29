<?php
/**
 * Donation Step 2 - Confirm and Initiate Payment
 * Shows donation summary and launches Pesapal payment
 */
$currentPage = 'donate';
$pageTitle = 'Confirm Donation';
$pageDescription = 'Confirm your donation details and proceed to payment.';

require_once 'config.php';
require_once 'functions.php';
require_once 'includes/PesapalHelper.php';

// Get currency settings
$currency = getCurrency();

// Check if donation data exists in session
if (!isset($_SESSION['donation_data'])) {
    header('Location: donation-step1.php');
    exit;
}

$donation = $_SESSION['donation_data'];
$error_message = '';

// Get Pesapal settings
$stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings WHERE setting_key LIKE 'pesapal_%'");
$pesapal_settings = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $pesapal_settings[$row['setting_key']] = $row['setting_value'];
}

// Check if Pesapal is configured
$pesapal_configured = !empty($pesapal_settings['pesapal_consumer_key']) && 
                       !empty($pesapal_settings['pesapal_consumer_secret']) && 
                       !empty($pesapal_settings['pesapal_ipn_id']);

// Handle payment initiation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['initiate_payment'])) {
    if (!$pesapal_configured) {
        $error_message = 'Payment gateway is not configured. Please contact the administrator.';
    } else {
        try {
            // Generate unique merchant reference
            $merchant_reference = PesapalHelper::generateMerchantReference('DTEHM');
            
            // Split donor name into first and last name
            $name_parts = explode(' ', $donation['donor_name'], 2);
            $first_name = $name_parts[0];
            $last_name = $name_parts[1] ?? '';
            
            // Initialize Pesapal
            $pesapal = new PesapalHelper(
                $pesapal_settings['pesapal_consumer_key'],
                $pesapal_settings['pesapal_consumer_secret'],
                $pesapal_settings['pesapal_environment'] ?? 'sandbox',
                $pesapal_settings['pesapal_ipn_id']
            );
            
            // Build callback URL
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'];
            $callback_url = $protocol . '://' . $host . '/ulfa/donation-step3.php';
            $cancellation_url = $protocol . '://' . $host . '/ulfa/donation-step1.php';
            
            // Build description
            $description = 'Donation to DTEHM';
            if (!empty($donation['cause_title'])) {
                $description .= ' - ' . substr($donation['cause_title'], 0, 50);
            }
            
            // Submit order to Pesapal
            $order_result = $pesapal->submitOrder([
                'merchant_reference' => $merchant_reference,
                'amount' => $donation['amount'],
                'currency' => $currency['code'],
                'description' => $description,
                'callback_url' => $callback_url,
                'cancellation_url' => $cancellation_url,
                'email' => $donation['donor_email'],
                'phone' => $donation['donor_phone'],
                'first_name' => $first_name,
                'last_name' => $last_name
            ]);
            
            if ($order_result['success']) {
                // Save donation to database
                $stmt = $pdo->prepare("
                    INSERT INTO donations (
                        donor_name, donor_email, donor_phone,
                        amount, currency, cause_id, message, is_anonymous,
                        merchant_reference, order_tracking_id, payment_status,
                        ip_address, created_at
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', ?, NOW())
                ");
                
                $stmt->execute([
                    $donation['donor_name'],
                    $donation['donor_email'],
                    $donation['donor_phone'],
                    $donation['amount'],
                    $currency['code'],
                    $donation['cause_id'] ?: null,
                    $donation['message'] ?: null,
                    $donation['is_anonymous'],
                    $merchant_reference,
                    $order_result['order_tracking_id'],
                    $_SERVER['REMOTE_ADDR'] ?? null
                ]);
                
                $donation_id = $pdo->lastInsertId();
                
                // Store order tracking info in session
                $_SESSION['payment_tracking'] = [
                    'donation_id' => $donation_id,
                    'merchant_reference' => $merchant_reference,
                    'order_tracking_id' => $order_result['order_tracking_id'],
                    'redirect_url' => $order_result['redirect_url']
                ];
                
                // Redirect to Pesapal payment page
                header('Location: ' . $order_result['redirect_url']);
                exit;
                
            } else {
                $error_message = 'Failed to initiate payment: ' . ($order_result['error'] ?? 'Unknown error');
                error_log('Pesapal Error: ' . print_r($order_result, true));
            }
            
        } catch (Exception $e) {
            $error_message = 'An error occurred while processing your donation. Please try again.';
            error_log('Donation Error: ' . $e->getMessage());
        }
    }
}

include 'includes/header.php';
?>

<style>
.confirmation-page {
    padding: 120px 0 80px;
    min-height: 100vh;
    background: linear-gradient(180deg, #f8f9fa 0%, #fff 100%);
}

.confirmation-container {
    max-width: 550px;
    margin: 0 auto;
    padding: 0 1rem;
}

.confirmation-header {
    text-align: center;
    margin-bottom: 2rem;
}

.confirmation-header h1 {
    font-size: 2rem;
    font-weight: 800;
    color: var(--primary-black);
    margin-bottom: 0.5rem;
}

.confirmation-header p {
    color: #666;
    font-size: 1rem;
}

.confirmation-card {
    background: #fff;
    border: 2px solid var(--primary-blue);
}

.card-header {
    background: var(--primary-yellow);
    padding: 1rem 1.5rem;
    border-bottom: 3px solid var(--primary-black);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.card-header i {
    font-size: 1.25rem;
}

.card-header h3 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 700;
}

.card-body {
    padding: 1.5rem;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    padding: 0.75rem 0;
    border-bottom: 1px solid #eee;
}

.summary-row:last-child {
    border-bottom: none;
}

.summary-label {
    color: #666;
    font-size: 0.95rem;
}

.summary-value {
    font-weight: 600;
    color: var(--primary-black);
    text-align: right;
    max-width: 60%;
}

.summary-row.total {
    border-top: 2px solid var(--primary-black);
    border-bottom: none;
    padding-top: 1rem;
    margin-top: 0.5rem;
}

.summary-row.total .summary-label,
.summary-row.total .summary-value {
    font-size: 1.25rem;
    font-weight: 800;
    color: var(--primary-black);
}

.error-box {
    background: #f8d7da;
    border: 2px solid #dc3545;
    color: #721c24;
    padding: 1rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.error-box i {
    font-size: 1.25rem;
}

.warning-box {
    background: #fff3cd;
    border: 2px solid #ffc107;
    color: #856404;
    padding: 1rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.warning-box i {
    font-size: 1.25rem;
}

.btn-group {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}

.btn-back {
    flex: 1;
    padding: 1rem;
    background: #fff;
    color: var(--primary-black);
    border: 2px solid var(--primary-blue);
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-back:hover {
    background: #f8f9fa;
}

.btn-pay {
    flex: 2;
    padding: 1rem;
    background: var(--primary-yellow);
    color: var(--primary-black);
    border: 2px solid var(--primary-blue);
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
    text-transform: uppercase;
}

.btn-pay:hover {
    transform: translateY(-2px);
    box-shadow: 4px 4px 0 var(--primary-black);
}

.btn-pay:disabled {
    background: #ccc;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.secure-notice {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 1.5rem;
    padding-top: 1rem;
    border-top: 1px solid #eee;
    color: #666;
    font-size: 0.85rem;
}

.secure-notice i {
    color: #28a745;
}

.payment-methods {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 1rem;
    opacity: 0.7;
}

.payment-methods img {
    height: 30px;
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

.step.active {
    color: var(--primary-black);
    font-weight: 600;
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

.step.active .step-number {
    background: var(--primary-yellow);
    color: var(--primary-black);
}

.step.completed .step-number {
    background: #28a745;
    color: #fff;
}

.step-divider {
    width: 40px;
    height: 2px;
    background: #ddd;
}
</style>

<div class="confirmation-page">
    <div class="confirmation-container">
        <!-- Progress Steps -->
        <div class="steps-indicator">
            <div class="step completed">
                <span class="step-number"><i class="fas fa-check"></i></span>
                <span>Details</span>
            </div>
            <div class="step-divider"></div>
            <div class="step active">
                <span class="step-number">2</span>
                <span>Confirm</span>
            </div>
            <div class="step-divider"></div>
            <div class="step">
                <span class="step-number">3</span>
                <span>Pay</span>
            </div>
        </div>
        
        <div class="confirmation-header">
            <h1>Confirm Your Donation</h1>
            <p>Please review your donation details before proceeding</p>
        </div>
        
        <?php if ($error_message): ?>
        <div class="error-box">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo htmlspecialchars($error_message); ?></span>
        </div>
        <?php endif; ?>
        
        <?php if (!$pesapal_configured): ?>
        <div class="warning-box">
            <i class="fas fa-exclamation-triangle"></i>
            <span>Payment gateway is not configured. Please contact the site administrator.</span>
        </div>
        <?php endif; ?>
        
        <div class="confirmation-card">
            <div class="card-header">
                <i class="fas fa-receipt"></i>
                <h3>Donation Summary</h3>
            </div>
            
            <div class="card-body">
                <div class="summary-row">
                    <span class="summary-label">Donor Name</span>
                    <span class="summary-value">
                        <?php echo $donation['is_anonymous'] ? 'Anonymous' : htmlspecialchars($donation['donor_name']); ?>
                    </span>
                </div>
                
                <div class="summary-row">
                    <span class="summary-label">Email</span>
                    <span class="summary-value"><?php echo htmlspecialchars($donation['donor_email']); ?></span>
                </div>
                
                <div class="summary-row">
                    <span class="summary-label">Phone</span>
                    <span class="summary-value"><?php echo htmlspecialchars($donation['donor_phone']); ?></span>
                </div>
                
                <div class="summary-row">
                    <span class="summary-label">Donating To</span>
                    <span class="summary-value">
                        <?php echo !empty($donation['cause_title']) ? htmlspecialchars($donation['cause_title']) : 'General Fund'; ?>
                    </span>
                </div>
                
                <?php if (!empty($donation['message'])): ?>
                <div class="summary-row">
                    <span class="summary-label">Message</span>
                    <span class="summary-value"><?php echo htmlspecialchars($donation['message']); ?></span>
                </div>
                <?php endif; ?>
                
                <div class="summary-row total">
                    <span class="summary-label">Total Amount</span>
                    <span class="summary-value"><?php echo formatCurrency($donation['amount']); ?></span>
                </div>
            </div>
        </div>
        
        <form method="POST" action="">
            <div class="btn-group">
                <a href="donation-step1.php" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Edit
                </a>
                <button type="submit" name="initiate_payment" class="btn-pay" <?php echo !$pesapal_configured ? 'disabled' : ''; ?>>
                    <i class="fas fa-lock"></i> Pay Now
                </button>
            </div>
        </form>
        
        <div class="secure-notice">
            <i class="fas fa-shield-alt"></i>
            Your payment is secured with 256-bit SSL encryption
        </div>
        
        <div class="payment-methods">
            <span style="font-size: 0.8rem; color: #999;">Accepted: MTN Mobile Money, Airtel Money, Visa, Mastercard</span>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
