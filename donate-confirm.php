<?php
require_once 'config.php';
require_once 'functions.php';
require_once 'includes/pesapal-config.php';

// Get currency settings
$currency = getCurrency();

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: donate.php');
    exit;
}

// Get and validate donation amount
$amount_preset = $_POST['amount_preset'] ?? '';
$custom_amount = $_POST['custom_amount'] ?? 0;

if ($amount_preset === 'custom') {
    $amount = floatval($custom_amount);
} else {
    $amount = floatval($amount_preset);
}

if ($amount < 1000) {
    $_SESSION['error'] = 'Minimum donation amount is ' . $currency['symbol'] . ' 1,000';
    header('Location: donate.php');
    exit;
}

// Get form data
$cause_id = !empty($_POST['cause_id']) ? intval($_POST['cause_id']) : null;
$first_name = trim($_POST['first_name'] ?? '');
$last_name = trim($_POST['last_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$message = trim($_POST['message'] ?? '');
$is_anonymous = isset($_POST['is_anonymous']) ? 1 : 0;

// Validate required fields
if (empty($first_name) || empty($last_name) || empty($email)) {
    $_SESSION['error'] = 'Please fill in all required fields';
    header('Location: donate.php');
    exit;
}

// Get cause details if specified
$cause = null;
if ($cause_id) {
    $stmt = $pdo->prepare("SELECT * FROM causes WHERE id = ? AND status = 'active'");
    $stmt->execute([$cause_id]);
    $cause = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Generate unique merchant reference
$merchant_reference = 'DTEHM-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));

// Store donation in session for confirmation
$_SESSION['pending_donation'] = [
    'amount' => $amount,
    'cause_id' => $cause_id,
    'cause_title' => $cause['title'] ?? 'General Fund',
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email,
    'phone' => $phone,
    'message' => $message,
    'is_anonymous' => $is_anonymous,
    'merchant_reference' => $merchant_reference
];

$page_title = 'Confirm Donation';
include 'includes/header.php';
?>

<style>
.confirm-hero {
    background: linear-gradient(rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.85)),
                url('uploads/photo-1593113646773-028c64a8f1b8.jpg') center/cover;
    padding: 6rem 0 4rem;
    margin-bottom: 0;
}

.confirm-hero h1 {
    color: var(--white);
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.confirmation-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 4rem 0;
}

.summary-card {
    background: #fff;
    border: 2px solid var(--primary-blue);
    padding: 3rem;
    margin-bottom: 2rem;
}

.amount-highlight {
    background: var(--primary-yellow);
    border: 2px solid var(--primary-blue);
    padding: 2rem;
    text-align: center;
    margin-bottom: 3rem;
}

.amount-highlight .label {
    text-transform: uppercase;
    font-weight: 600;
    font-size: 0.9rem;
    letter-spacing: 1px;
    margin-bottom: 0.5rem;
}

.amount-highlight .amount {
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    font-weight: 800;
    color: var(--primary-black);
    line-height: 1;
}

.section-title {
    color: var(--primary-black);
    font-size: 1.25rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 3px solid var(--primary-blue);
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 1rem 0;
    border-bottom: 2px solid #e0e0e0;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
    color: #666;
}

.detail-value {
    font-weight: 600;
    color: var(--primary-black);
    text-align: right;
}

.action-buttons {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-top: 2rem;
}

.btn-back {
    background: #fff;
    color: var(--primary-black);
    border: 2px solid var(--primary-blue);
    padding: 1rem 2rem;
    font-size: 1.1rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    text-align: center;
}

.btn-back:hover {
    background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
    color: var(--white);
    transform: translateY(-3px);
    box-shadow: 5px 5px 0 var(--primary-yellow);
}

.btn-proceed {
    background: var(--primary-yellow);
    color: var(--primary-black);
    border: 2px solid var(--primary-blue);
    padding: 1rem 2rem;
    font-size: 1.1rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}

.btn-proceed:hover {
    background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
    color: var(--white);
    transform: translateY(-3px);
    box-shadow: 5px 5px 0 var(--primary-yellow);
}

.terms-notice {
    background: #f8f9fa;
    border: 2px solid var(--primary-blue);
    padding: 1.5rem;
    margin-top: 2rem;
    font-size: 0.9rem;
    line-height: 1.6;
}

.secure-info {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: 1.5rem;
    padding: 1rem;
    background: #e8f5e9;
    border: 2px solid #4caf50;
}

.secure-info i {
    font-size: 2rem;
    color: #4caf50;
}

.secure-info-text {
    flex: 1;
}

.secure-info-text strong {
    display: block;
    color: var(--primary-black);
    margin-bottom: 0.25rem;
}

.secure-info-text small {
    color: #666;
}

@media (max-width: 768px) {
    .action-buttons {
        grid-template-columns: 1fr;
    }
}
</style>

<section class="confirm-hero">
    <div class="container">
        <div class="text-center">
            <h1>Confirm Your Donation</h1>
        </div>
    </div>
</section>

<section class="confirmation-container">
    <div class="container">
        
        <!-- Amount Highlight -->
        <div class="amount-highlight">
            <div class="label">Your Donation Amount</div>
            <div class="amount"><?= formatCurrency($amount) ?></div>
        </div>
        
        <!-- Donation Details -->
        <div class="summary-card">
            <h2 class="section-title">Donation Details</h2>
            
            <div class="detail-row">
                <span class="detail-label">Donating To:</span>
                <span class="detail-value"><?= htmlspecialchars($_SESSION['pending_donation']['cause_title']) ?></span>
            </div>
            
            <div class="detail-row">
                <span class="detail-label">Reference Number:</span>
                <span class="detail-value"><?= htmlspecialchars($merchant_reference) ?></span>
            </div>
            
            <?php if (!empty($message)): ?>
            <div class="detail-row">
                <span class="detail-label">Your Message:</span>
                <span class="detail-value"><?= htmlspecialchars($message) ?></span>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Donor Information -->
        <div class="summary-card">
            <h2 class="section-title">Your Information</h2>
            
            <div class="detail-row">
                <span class="detail-label">Name:</span>
                <span class="detail-value">
                    <?php if ($is_anonymous): ?>
                        Anonymous
                    <?php else: ?>
                        <?= htmlspecialchars($first_name . ' ' . $last_name) ?>
                    <?php endif; ?>
                </span>
            </div>
            
            <div class="detail-row">
                <span class="detail-label">Email:</span>
                <span class="detail-value"><?= htmlspecialchars($email) ?></span>
            </div>
            
            <?php if (!empty($phone)): ?>
            <div class="detail-row">
                <span class="detail-label">Phone:</span>
                <span class="detail-value"><?= htmlspecialchars($phone) ?></span>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Secure Payment Info -->
        <div class="secure-info">
            <i class="fas fa-shield-alt"></i>
            <div class="secure-info-text">
                <strong>Secure Payment Processing</strong>
                <small>Your payment will be processed securely through Pesapal. You will be redirected to complete the transaction.</small>
            </div>
        </div>
        
        <!-- Terms Notice -->
        <div class="terms-notice">
            <i class="fas fa-info-circle me-2"></i>
            By proceeding, you agree that this donation is voluntary and non-refundable. 
            You will receive a confirmation email once your payment is processed successfully.
        </div>
        
        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="donate.php" class="btn btn-back">
                <i class="fas fa-arrow-left me-2"></i> Go Back
            </a>
            
            <form method="POST" action="donate-process.php" style="margin: 0;">
                <button type="submit" class="btn btn-proceed w-100">
                    Proceed to Payment <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </form>
        </div>
        
    </div>
</section>

<?php include 'includes/footer.php'; ?>
