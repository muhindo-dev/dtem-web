<?php
require_once 'config.php';
require_once 'functions.php';
require_once 'includes/pesapal-config.php';

// Get currency settings
$currency = getCurrency();

// Get Pesapal callback parameters
$merchant_reference = $_GET['pesapal_merchant_reference'] ?? $_SESSION['pending_donation']['merchant_reference'] ?? null;
$tracking_id = $_GET['pesapal_transaction_tracking_id'] ?? null;

// Check if we have necessary data
if (!$merchant_reference) {
    header('Location: donate.php');
    exit;
}

// Get donation from database
$donation = getDonationByReference($merchant_reference);

if (!$donation) {
    $_SESSION['error'] = 'Donation not found';
    header('Location: donate.php');
    exit;
}

// If tracking ID is provided, query payment status
$payment_verified = false;
$payment_status = 'pending';
$error_message = null;

if ($tracking_id) {
    try {
        $status_result = queryPesapalPaymentStatus($merchant_reference, $tracking_id);
        
        if ($status_result) {
            $payment_status = updateDonationStatus(
                $donation['id'],
                $status_result['tracking_id'],
                $status_result['payment_method'],
                $status_result['status']
            );
            $payment_verified = true;
            
            // Refresh donation data
            $donation = getDonationById($donation['id']);
        }
    } catch (Exception $e) {
        error_log("Payment verification error: " . $e->getMessage());
        $error_message = 'Unable to verify payment status. Please contact us if payment was deducted.';
    }
} else {
    // No tracking ID yet, show waiting screen
    $payment_status = $donation['payment_status'];
}

// Clear session data
unset($_SESSION['pending_donation']);
unset($_SESSION['payment_url']);
unset($_SESSION['donation_id']);

$page_title = 'Payment Verification';
include 'includes/header.php';
?>

<style>
.verify-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 4rem 0;
    min-height: 70vh;
}

.status-card {
    background: #fff;
    border: 2px solid var(--primary-blue);
    padding: 3rem;
    text-align: center;
}

.status-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid var(--primary-blue);
}

.status-icon i {
    font-size: 3rem;
}

.status-icon.success {
    background: #4caf50;
    color: #fff;
}

.status-icon.pending {
    background: var(--primary-yellow);
    color: var(--primary-black);
}

.status-icon.failed {
    background: #f44336;
    color: #fff;
}

.status-icon.waiting {
    background: #2196f3;
    color: #fff;
}

.status-title {
    font-size: clamp(1.75rem, 4vw, 2.5rem);
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1rem;
    color: var(--primary-black);
}

.status-message {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #666;
    margin-bottom: 2rem;
}

.donation-summary {
    background: #f8f9fa;
    border: 2px solid var(--primary-blue);
    padding: 2rem;
    margin: 2rem 0;
    text-align: left;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    padding: 0.75rem 0;
    border-bottom: 2px solid #e0e0e0;
}

.summary-row:last-child {
    border-bottom: none;
}

.summary-label {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.9rem;
    color: #666;
}

.summary-value {
    font-weight: 700;
    color: var(--primary-black);
}

.summary-value.amount {
    font-size: 1.5rem;
    color: #4caf50;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
    flex-wrap: wrap;
}

.btn-primary {
    background: var(--primary-yellow);
    color: var(--primary-black);
    border: 2px solid var(--primary-blue);
    padding: 1rem 2.5rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
    color: var(--white);
    transform: translateY(-3px);
    box-shadow: 5px 5px 0 var(--primary-yellow);
}

.btn-secondary {
    background: #fff;
    color: var(--primary-black);
    border: 2px solid var(--primary-blue);
    padding: 1rem 2.5rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
    color: var(--white);
    transform: translateY(-3px);
    box-shadow: 5px 5px 0 var(--primary-yellow);
}

.spinner-border {
    width: 3rem;
    height: 3rem;
    border: 4px solid #e0e0e0;
    border-top-color: var(--white);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.alert {
    border: 2px solid var(--primary-blue);
    padding: 1.5rem;
    margin: 2rem 0;
    border-radius: 0;
}

.alert-warning {
    background: #fff3cd;
    color: #856404;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
}

.next-steps {
    background: #e3f2fd;
    border: 2px solid var(--primary-blue);
    padding: 2rem;
    margin-top: 2rem;
    text-align: left;
}

.next-steps h3 {
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.next-steps ul {
    margin: 0;
    padding-left: 1.5rem;
}

.next-steps li {
    margin-bottom: 0.5rem;
    line-height: 1.6;
}
</style>

<section class="verify-container">
    <div class="container">
        
        <?php if ($payment_status === 'completed'): ?>
            <!-- Success State -->
            <div class="status-card">
                <div class="status-icon success">
                    <i class="fas fa-check-circle"></i>
                </div>
                
                <h1 class="status-title">Thank You!</h1>
                <p class="status-message">
                    Your donation has been received successfully. You are making a real difference in our community!
                </p>
                
                <div class="donation-summary">
                    <div class="summary-row">
                        <span class="summary-label">Amount Donated:</span>
                        <span class="summary-value amount"><?= formatDonationAmount($donation) ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Reference Number:</span>
                        <span class="summary-value"><?= htmlspecialchars($donation['pesapal_merchant_reference']) ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Donation To:</span>
                        <span class="summary-value"><?= htmlspecialchars($donation['cause_title'] ?? 'General Fund') ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Payment Method:</span>
                        <span class="summary-value"><?= htmlspecialchars($donation['pesapal_payment_method'] ?? 'N/A') ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Date:</span>
                        <span class="summary-value"><?= date('M d, Y - h:i A', strtotime($donation['payment_date'])) ?></span>
                    </div>
                </div>
                
                <div class="next-steps">
                    <h3><i class="fas fa-info-circle me-2"></i> What Happens Next?</h3>
                    <ul>
                        <li>A confirmation email has been sent to <strong><?= htmlspecialchars($donation['donor_email']) ?></strong></li>
                        <li>You will receive a receipt for tax purposes (if applicable)</li>
                        <li>Your donation will be put to work immediately</li>
                        <li>We'll keep you updated on the impact of your contribution</li>
                    </ul>
                </div>
                
                <div class="action-buttons">
                    <a href="index.php" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i> Return Home
                    </a>
                    <a href="causes.php" class="btn btn-secondary">
                        <i class="fas fa-heart me-2"></i> View Other Causes
                    </a>
                </div>
            </div>
            
        <?php elseif ($payment_status === 'failed' || $payment_status === 'cancelled'): ?>
            <!-- Failed State -->
            <div class="status-card">
                <div class="status-icon failed">
                    <i class="fas fa-times-circle"></i>
                </div>
                
                <h1 class="status-title">Payment <?= ucfirst($payment_status) ?></h1>
                <p class="status-message">
                    <?php if ($payment_status === 'failed'): ?>
                        Unfortunately, your payment could not be processed. Please try again or contact your payment provider.
                    <?php else: ?>
                        Your payment was cancelled. No charges were made to your account.
                    <?php endif; ?>
                </p>
                
                <?php if ($error_message): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <?= htmlspecialchars($error_message) ?>
                    </div>
                <?php endif; ?>
                
                <div class="donation-summary">
                    <div class="summary-row">
                        <span class="summary-label">Reference Number:</span>
                        <span class="summary-value"><?= htmlspecialchars($donation['pesapal_merchant_reference']) ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Amount:</span>
                        <span class="summary-value"><?= formatDonationAmount($donation) ?></span>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <a href="donate.php" class="btn btn-primary">
                        <i class="fas fa-redo me-2"></i> Try Again
                    </a>
                    <a href="contact.php" class="btn btn-secondary">
                        <i class="fas fa-envelope me-2"></i> Contact Us
                    </a>
                </div>
            </div>
            
        <?php else: ?>
            <!-- Pending/Waiting State -->
            <div class="status-card">
                <div class="status-icon waiting">
                    <div class="spinner-border"></div>
                </div>
                
                <h1 class="status-title">Verifying Payment...</h1>
                <p class="status-message">
                    Please wait while we confirm your payment. This usually takes a few seconds.
                </p>
                
                <div class="alert alert-warning">
                    <i class="fas fa-clock me-2"></i>
                    <strong>Please do not close this page.</strong> We are checking with Pesapal to confirm your payment status.
                </div>
                
                <div class="donation-summary">
                    <div class="summary-row">
                        <span class="summary-label">Reference Number:</span>
                        <span class="summary-value"><?= htmlspecialchars($donation['pesapal_merchant_reference']) ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Amount:</span>
                        <span class="summary-value"><?= formatDonationAmount($donation) ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Status:</span>
                        <span class="summary-value">Checking...</span>
                    </div>
                </div>
                
                <div class="action-buttons" style="margin-top: 3rem;">
                    <button onclick="location.reload()" class="btn btn-secondary">
                        <i class="fas fa-sync me-2"></i> Refresh Status
                    </button>
                </div>
            </div>
            
            <script>
            // Auto-refresh every 5 seconds to check payment status
            let refreshCount = 0;
            const maxRefreshes = 24; // 2 minutes total (5 seconds × 24)
            
            const autoRefresh = setInterval(function() {
                refreshCount++;
                
                if (refreshCount >= maxRefreshes) {
                    clearInterval(autoRefresh);
                    return;
                }
                
                // Reload the page to check status
                location.reload();
            }, 5000);
            
            // Stop auto-refresh when page is hidden
            document.addEventListener('visibilitychange', function() {
                if (document.hidden) {
                    clearInterval(autoRefresh);
                }
            });
            </script>
        <?php endif; ?>
        
    </div>
</section>

<?php include 'includes/footer.php'; ?>
