<?php
require_once 'config.php';
require_once 'functions.php';

// Check if payment URL exists
if (!isset($_SESSION['payment_url']) || !isset($_SESSION['donation_id'])) {
    header('Location: donate.php');
    exit;
}

$payment_url = $_SESSION['payment_url'];
$donation_id = $_SESSION['donation_id'];
$pending_donation = $_SESSION['pending_donation'] ?? [];

// Get amounts for display
$amountUsd = $pending_donation['amount_usd'] ?? $pending_donation['amount'] ?? 0;
$amountUgx = $pending_donation['amount_ugx'] ?? convertUsdToUgx($amountUsd);
$exchangeRate = $pending_donation['exchange_rate'] ?? getExchangeRate();

$page_title = 'Complete Payment';
include 'includes/header.php';
?>

<style>
.payment-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 3rem 0;
    min-height: 80vh;
}

.payment-header {
    background: var(--primary-yellow);
    border: 2px solid var(--primary-blue);
    padding: 2rem;
    margin-bottom: 2rem;
    text-align: center;
}

.payment-header h1 {
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 0.5rem;
}

.payment-header p {
    margin: 0;
    font-weight: 600;
}

.iframe-container {
    background: #fff;
    border: 2px solid var(--primary-blue);
    padding: 1rem;
    min-height: 600px;
    position: relative;
}

.iframe-container iframe {
    width: 100%;
    height: 600px;
    border: none;
}

.loading-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.95);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 10;
}

.loading-overlay.hidden {
    display: none;
}

.spinner {
    width: 60px;
    height: 60px;
    border: 5px solid #e0e0e0;
    border-top: 5px solid var(--primary-yellow);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.loading-text {
    margin-top: 1.5rem;
    font-weight: 600;
    color: var(--primary-black);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.payment-info {
    background: #f8f9fa;
    border: 2px solid var(--primary-blue);
    padding: 1.5rem;
    margin-top: 2rem;
}

.payment-info h3 {
    font-size: 1.1rem;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 1rem;
}

.payment-info ul {
    margin: 0;
    padding-left: 1.5rem;
}

.payment-info li {
    margin-bottom: 0.5rem;
    line-height: 1.6;
}

.secure-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    margin-top: 2rem;
    padding: 1rem;
    background: #e8f5e9;
    border: 2px solid #4caf50;
}

.secure-badge i {
    font-size: 1.5rem;
    color: #4caf50;
}

.secure-badge span {
    font-weight: 600;
    color: var(--primary-black);
}
</style>

<section class="payment-container">
    <div class="container">
        
        <div class="payment-header">
            <h1><i class="fas fa-credit-card me-2"></i> Complete Your Payment</h1>
            <p>You are being redirected to our secure payment partner, Pesapal</p>
            <div style="margin-top: 1rem; padding: 1rem; background: rgba(0,0,0,0.1); border-radius: 8px;">
                <div style="font-size: 1.5rem; font-weight: 800;">$ <?= number_format($amountUsd, 2) ?> USD</div>
                <div style="font-size: 0.9rem; margin-top: 0.5rem; opacity: 0.9;">
                    <i class="fas fa-exchange-alt me-1"></i> UGX <?= number_format($amountUgx, 0) ?> 
                    <span style="font-size: 0.8rem;">(Rate: 1 USD = <?= number_format($exchangeRate, 0) ?> UGX)</span>
                </div>
            </div>
        </div>
        
        <div class="iframe-container">
            <div class="loading-overlay" id="loadingOverlay">
                <div class="spinner"></div>
                <div class="loading-text">Loading secure payment form...</div>
            </div>
            
            <iframe 
                id="pesapal_iframe" 
                src="<?= htmlspecialchars($payment_url) ?>"
                onload="hideLoading()">
            </iframe>
        </div>
        
        <div class="payment-info">
            <h3><i class="fas fa-info-circle me-2"></i> Payment Instructions</h3>
            <ul>
                <li>Complete the payment form in the box above</li>
                <li>Choose your preferred payment method (Mobile Money, Card, Bank)</li>
                <li>You will be automatically redirected once payment is complete</li>
                <li>Keep this page open until payment is confirmed</li>
                <li>If you experience any issues, please contact us at <?= htmlspecialchars($settings['contact_email'] ?? 'dtehmhealth@gmail.com') ?></li>
            </ul>
        </div>
        
        <div class="secure-badge">
            <i class="fas fa-shield-alt"></i>
            <span>Your payment is secured with 256-bit SSL encryption</span>
        </div>
        
    </div>
</section>

<script>
function hideLoading() {
    const overlay = document.getElementById('loadingOverlay');
    if (overlay) {
        overlay.classList.add('hidden');
    }
}

// Auto-hide loading after 10 seconds if iframe doesn't load
setTimeout(hideLoading, 10000);

// Listen for payment completion messages
window.addEventListener('message', function(event) {
    // Check if message is from Pesapal
    if (event.data && typeof event.data === 'string') {
        if (event.data.includes('pesapal')) {
            // Redirect to verification page
            window.location.href = 'donate-verify.php';
        }
    }
});
</script>

<?php include 'includes/footer.php'; ?>
