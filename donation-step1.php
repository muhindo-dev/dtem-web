<?php
/**
 * Donation Step 1 - Select Amount and Enter Details
 * Simple and straightforward donation form
 */
$currentPage = 'donate';
$pageTitle = 'Make a Donation';
$pageDescription = 'Support DTEHM with your generous donation. Every contribution makes a difference.';

require_once 'config.php';
require_once 'functions.php';

// Get currency settings
$currency = getCurrency();
$currencyCode = $currency['code'];
$currencySymbol = $currency['symbol'];
$minDonation = (int)getSetting('min_donation', 1);
$siteShortName = getSetting('site_short_name', 'DTEHM');

// Get optional cause from URL
$cause_id = isset($_GET['cause']) ? (int)$_GET['cause'] : 0;
$cause = null;

if ($cause_id > 0) {
    $stmt = $pdo->prepare("SELECT id, title, description, goal_amount, raised_amount FROM causes WHERE id = ? AND status = 'active'");
    $stmt->execute([$cause_id]);
    $cause = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Get all active causes for dropdown
$stmt = $pdo->query("SELECT id, title FROM causes WHERE status = 'active' ORDER BY title ASC");
$all_causes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateCsrfToken()) {
        $errors[] = 'Invalid form submission. Please try again.';
    } else {
    $errors = [];
    
    // Sanitize and validate inputs
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
    $custom_amount = isset($_POST['custom_amount']) ? floatval($_POST['custom_amount']) : 0;
    $donor_name = trim($_POST['donor_name'] ?? '');
    $donor_email = trim($_POST['donor_email'] ?? '');
    $donor_phone = trim($_POST['donor_phone'] ?? '');
    $selected_cause = isset($_POST['cause_id']) ? (int)$_POST['cause_id'] : 0;
    $message = trim($_POST['message'] ?? '');
    $is_anonymous = isset($_POST['is_anonymous']) ? 1 : 0;
    
    // Use custom amount if selected
    if ($amount === 0 && $custom_amount > 0) {
        $amount = $custom_amount;
    }
    
    // Validation
    if ($amount < $minDonation) {
        $errors[] = 'Minimum donation amount is ' . $currencySymbol . ' ' . number_format($minDonation);
    }
    if (empty($donor_name)) {
        $errors[] = 'Please enter your name';
    }
    if (empty($donor_email) || !filter_var($donor_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address';
    }
    if (empty($donor_phone)) {
        $errors[] = 'Please enter your phone number';
    }
    
    // If no errors, store in session and proceed to step 2
    if (empty($errors)) {
        $_SESSION['donation_data'] = [
            'amount' => $amount,
            'donor_name' => $donor_name,
            'donor_email' => $donor_email,
            'donor_phone' => $donor_phone,
            'cause_id' => $selected_cause,
            'message' => $message,
            'is_anonymous' => $is_anonymous,
            'currency' => $currencyCode
        ];
        
        // Get cause title if selected
        if ($selected_cause > 0) {
            foreach ($all_causes as $c) {
                if ($c['id'] == $selected_cause) {
                    $_SESSION['donation_data']['cause_title'] = $c['title'];
                    break;
                }
            }
        }
        
        header('Location: donation-step2.php');
        exit;
    }
    } // end CSRF else
}

include 'includes/header.php';
?>

<style>
.donation-page {
    padding: 120px 0 80px;
    min-height: 100vh;
    background: linear-gradient(180deg, #f8f9fa 0%, #fff 100%);
}

.donation-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 0 1rem;
}

.donation-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.donation-header h1 {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--primary-black);
    margin-bottom: 0.75rem;
}

.donation-header p {
    color: #666;
    font-size: 1.1rem;
    max-width: 500px;
    margin: 0 auto;
}

.donation-card {
    background: #fff;
    border: 2px solid var(--primary-blue);
    padding: 2rem;
}

.cause-banner {
    background: var(--light-yellow);
    border: 2px solid var(--primary-yellow);
    padding: 1rem 1.25rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.cause-banner i {
    font-size: 1.5rem;
    color: var(--primary-black);
}

.cause-banner-text h4 {
    font-size: 1rem;
    font-weight: 700;
    margin: 0 0 0.25rem;
}

.cause-banner-text p {
    font-size: 0.875rem;
    color: #666;
    margin: 0;
}

.section-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--primary-black);
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--primary-yellow);
}

.amount-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.amount-option {
    position: relative;
}

.amount-option input {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.amount-option label {
    display: block;
    padding: 1rem;
    text-align: center;
    border: 2px solid var(--primary-blue);
    cursor: pointer;
    font-weight: 700;
    font-size: 1rem;
    transition: all 0.2s;
    background: #fff;
}

.amount-option input:checked + label {
    background: var(--primary-yellow);
    transform: translateY(-2px);
    box-shadow: 4px 4px 0 var(--primary-black);
}

.amount-option label:hover {
    background: var(--light-yellow);
}

.custom-amount {
    margin-top: 1rem;
    position: relative;
}

.custom-amount label {
    display: block;
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.custom-amount-input {
    display: flex;
    align-items: center;
    border: 2px solid var(--primary-blue);
}

.custom-amount-input span {
    padding: 0.75rem 1rem;
    background: #f8f9fa;
    font-weight: 700;
    border-right: 2px solid var(--primary-black);
}

.custom-amount-input input {
    flex: 1;
    border: none;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    outline: none;
}

.form-section {
    margin-top: 2rem;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.form-group label span {
    color: #dc3545;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #dee2e6;
    font-size: 1rem;
    transition: border-color 0.2s;
    font-family: inherit;
}

.form-control:focus {
    outline: none;
    border-color: var(--white);
}

.form-control-select {
    background: #fff;
    cursor: pointer;
}

textarea.form-control {
    resize: vertical;
    min-height: 80px;
}

.checkbox-group {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-top: 1rem;
}

.checkbox-group input {
    width: 20px;
    height: 20px;
    cursor: pointer;
}

.checkbox-group label {
    margin: 0;
    cursor: pointer;
    font-size: 0.95rem;
}

.btn-donate {
    width: 100%;
    padding: 1rem 2rem;
    background: var(--primary-yellow);
    color: var(--primary-black);
    border: 2px solid var(--primary-blue);
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    margin-top: 1.5rem;
    transition: all 0.2s;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-donate:hover {
    transform: translateY(-2px);
    box-shadow: 4px 4px 0 var(--primary-black);
}

.error-box {
    background: #f8d7da;
    border: 2px solid #dc3545;
    color: #721c24;
    padding: 1rem;
    margin-bottom: 1.5rem;
}

.error-box ul {
    margin: 0;
    padding-left: 1.25rem;
}

.error-box li {
    margin-bottom: 0.25rem;
}

.secure-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 1.5rem;
    color: #666;
    font-size: 0.875rem;
}

.secure-badge i {
    color: #28a745;
}

@media (max-width: 480px) {
    .amount-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .donation-card {
        padding: 1.5rem;
    }
}
</style>

<div class="donation-page">
    <div class="donation-container">
        <div class="donation-header">
            <h1><i class="fas fa-heart" style="color: var(--white);"></i> Make a Donation</h1>
            <p>Your generosity helps us provide love, care, and education to vulnerable children</p>
        </div>
        
        <div class="donation-card">
            <?php if (!empty($errors)): ?>
            <div class="error-box">
                <ul>
                    <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
            
            <?php if ($cause): ?>
            <div class="cause-banner">
                <i class="fas fa-hand-holding-heart"></i>
                <div class="cause-banner-text">
                    <h4>Donating to: <?php echo htmlspecialchars($cause['title']); ?></h4>
                    <p>Goal: <?php echo $currencySymbol; ?> <?php echo number_format($cause['goal_amount']); ?></p>
                </div>
            </div>
            <?php endif; ?>
            
            <form method="POST" action="" id="donationForm">
                <?php echo csrfField(); ?>
                <!-- Amount Selection -->
                <div class="section-title">
                    <i class="fas fa-coins"></i> Select Amount (<?php echo $currencySymbol; ?>)
                </div>
                
                <div class="amount-grid">
                    <div class="amount-option">
                        <input type="radio" name="amount" value="5" id="amt1" <?php echo (isset($_POST['amount']) && $_POST['amount'] == '5') ? 'checked' : ''; ?>>
                        <label for="amt1">5</label>
                    </div>
                    <div class="amount-option">
                        <input type="radio" name="amount" value="10" id="amt2" <?php echo (isset($_POST['amount']) && $_POST['amount'] == '10') ? 'checked' : ''; ?>>
                        <label for="amt2">10</label>
                    </div>
                    <div class="amount-option">
                        <input type="radio" name="amount" value="25" id="amt3" <?php echo (isset($_POST['amount']) && $_POST['amount'] == '25') ? 'checked' : 'checked'; ?>>
                        <label for="amt3">25</label>
                    </div>
                    <div class="amount-option">
                        <input type="radio" name="amount" value="50" id="amt4" <?php echo (isset($_POST['amount']) && $_POST['amount'] == '50') ? 'checked' : ''; ?>>
                        <label for="amt4">50</label>
                    </div>
                    <div class="amount-option">
                        <input type="radio" name="amount" value="100" id="amt5" <?php echo (isset($_POST['amount']) && $_POST['amount'] == '100') ? 'checked' : ''; ?>>
                        <label for="amt5">100</label>
                    </div>
                    <div class="amount-option">
                        <input type="radio" name="amount" value="250" id="amt6" <?php echo (isset($_POST['amount']) && $_POST['amount'] == '250') ? 'checked' : ''; ?>>
                        <label for="amt6">250</label>
                    </div>
                </div>
                
                <div class="custom-amount">
                    <label>Or enter custom amount:</label>
                    <div class="custom-amount-input">
                        <span><?php echo $currencySymbol; ?></span>
                        <input type="number" name="custom_amount" placeholder="Enter amount (1-1000)" min="1" max="1000" step="1" value="<?php echo htmlspecialchars($_POST['custom_amount'] ?? ''); ?>" id="customAmount">
                    </div>
                </div>
                
                <!-- Cause Selection (if not pre-selected) -->
                <?php if (!$cause && !empty($all_causes)): ?>
                <div class="form-section">
                    <div class="section-title">
                        <i class="fas fa-hand-holding-heart"></i> Select Cause (Optional)
                    </div>
                    <div class="form-group">
                        <select name="cause_id" class="form-control form-control-select">
                            <option value="0">General Donation - Where needed most</option>
                            <?php foreach ($all_causes as $c): ?>
                            <option value="<?php echo $c['id']; ?>" <?php echo (isset($_POST['cause_id']) && $_POST['cause_id'] == $c['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($c['title']); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php else: ?>
                <input type="hidden" name="cause_id" value="<?php echo $cause_id; ?>">
                <?php endif; ?>
                
                <!-- Donor Information -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fas fa-user"></i> Your Information
                    </div>
                    
                    <div class="form-group">
                        <label>Full Name <span>*</span></label>
                        <input type="text" name="donor_name" class="form-control" placeholder="Enter your full name" value="<?php echo htmlspecialchars($_POST['donor_name'] ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Email Address <span>*</span></label>
                        <input type="email" name="donor_email" class="form-control" placeholder="your@email.com" value="<?php echo htmlspecialchars($_POST['donor_email'] ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Phone Number <span>*</span></label>
                        <input type="tel" name="donor_phone" class="form-control" placeholder="0700 000 000" value="<?php echo htmlspecialchars($_POST['donor_phone'] ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Message (Optional)</label>
                        <textarea name="message" class="form-control" placeholder="Leave a message of support..."><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" name="is_anonymous" id="isAnonymous" value="1" <?php echo isset($_POST['is_anonymous']) ? 'checked' : ''; ?>>
                        <label for="isAnonymous">Make my donation anonymous</label>
                    </div>
                </div>
                
                <button type="submit" class="btn-donate">
                    <i class="fas fa-arrow-right"></i> Continue to Payment
                </button>
                
                <div class="secure-badge">
                    <i class="fas fa-lock"></i>
                    Secure payment powered by Pesapal
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Clear amount selection when custom amount is entered
document.getElementById('customAmount').addEventListener('input', function() {
    if (this.value) {
        document.querySelectorAll('input[name="amount"]').forEach(function(radio) {
            radio.checked = false;
        });
    }
});

// Clear custom amount when preset is selected
document.querySelectorAll('input[name="amount"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        document.getElementById('customAmount').value = '';
    });
});
</script>

<?php include 'includes/footer.php'; ?>
