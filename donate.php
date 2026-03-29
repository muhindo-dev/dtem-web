<?php
require_once 'config.php';
require_once 'functions.php';

// Get all active causes for dropdown
$stmt = $pdo->prepare("SELECT id, title, raised_amount, goal_amount FROM causes WHERE status = 'active' ORDER BY title ASC");
$stmt->execute();
$causes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get settings using helper functions
$siteShortName = getSetting('site_short_name', 'DTEHM');
$siteName = getSetting('site_name', 'DTEHM Health Ministries');
$currency = getCurrency();

$currentPage = 'donate';
$pageTitle = 'Make a Donation';
$pageDescription = 'Support ' . $siteShortName . ' by making a donation to help orphaned and vulnerable children.';
include 'includes/header.php';
?>

<style>
.donation-form-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 4rem 0;
}

.form-card {
    background: #fff;
    border: 2px solid var(--primary-blue);
    padding: 3rem;
    margin-bottom: 2rem;
}

.form-section-title {
    color: var(--primary-black);
    font-size: 1.5rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 3px solid var(--primary-blue);
}

.amount-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.amount-option {
    position: relative;
}

.amount-option input[type="radio"] {
    position: absolute;
    opacity: 0;
}

.amount-option label {
    display: block;
    background: #fff;
    border: 2px solid var(--primary-blue);
    padding: 1.5rem 1rem;
    text-align: center;
    font-size: 1.25rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    color: var(--primary-black);
}

.amount-option input[type="radio"]:checked + label {
    background: var(--primary-yellow);
    color: var(--primary-black);
    transform: translateY(-3px);
    box-shadow: 0 2px 15px rgba(1,57,154,0.1);
}

.amount-option label:hover {
    transform: translateY(-3px);
    box-shadow: 0 2px 15px rgba(1,57,154,0.1);
}

.custom-amount-wrapper {
    margin-top: 1rem;
}

.custom-amount-input {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.custom-amount-input span {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-black);
}

.form-control, .form-select {
    border: 2px solid var(--primary-blue);
    border-radius: 0;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: var(--white);
    box-shadow: 0 2px 10px rgba(1,57,154,0.1);
    outline: 0;
}

.form-label {
    font-weight: 600;
    color: var(--primary-black);
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
}

.cause-select-wrapper {
    margin-bottom: 2rem;
}

.cause-info {
    background: #f8f9fa;
    border: 2px solid var(--primary-blue);
    padding: 1rem;
    margin-top: 1rem;
    display: none;
}

.cause-info.active {
    display: block;
}

.cause-progress {
    margin-top: 0.5rem;
}

.cause-progress .progress {
    height: 8px;
    background: #e0e0e0;
    border: 2px solid var(--primary-blue);
    border-radius: 0;
}

.cause-progress .progress-bar {
    background: var(--primary-yellow);
}

.checkbox-wrapper {
    margin: 1.5rem 0;
}

.form-check-input {
    border: 2px solid var(--primary-blue);
    border-radius: 0;
    width: 1.5rem;
    height: 1.5rem;
    cursor: pointer;
}

.form-check-input:checked {
    background-color: var(--white);
    border-color: var(--primary-black);
}

.form-check-label {
    font-weight: 600;
    color: var(--primary-black);
    margin-left: 0.5rem;
    cursor: pointer;
}

.btn-donate {
    background: var(--primary-yellow);
    color: var(--primary-black);
    border: 2px solid var(--primary-blue);
    padding: 1rem 3rem;
    font-size: 1.25rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    width: 100%;
    transition: all 0.3s ease;
}

.btn-donate:hover {
    background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
    color: var(--white);
    transform: translateY(-3px);
    box-shadow: 0 2px 15px rgba(1,57,154,0.1);
}

.secure-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 1.5rem;
    color: #666;
    font-size: 0.9rem;
}

.secure-badge i {
    color: #28a745;
}
</style>

<div class="page-header">
    <div class="container">
        <h1>Make a Donation</h1>
        <p>Your generosity helps us serve communities across Uganda</p>
    </div>
</div>

<section class="donation-form-container">
    <div class="container">
        <form method="POST" action="donate-confirm.php" id="donationForm">
            
            <!-- Donation Amount -->
            <div class="form-card">
                <h2 class="form-section-title">Select Donation Amount</h2>
                
                <div class="amount-grid">
                    <div class="amount-option">
                        <input type="radio" name="amount_preset" id="amount_5" value="5">
                        <label for="amount_5"><?php echo $currency['symbol']; ?> 5</label>
                    </div>
                    <div class="amount-option">
                        <input type="radio" name="amount_preset" id="amount_10" value="10">
                        <label for="amount_10"><?php echo $currency['symbol']; ?> 10</label>
                    </div>
                    <div class="amount-option">
                        <input type="radio" name="amount_preset" id="amount_25" value="25">
                        <label for="amount_25"><?php echo $currency['symbol']; ?> 25</label>
                    </div>
                    <div class="amount-option">
                        <input type="radio" name="amount_preset" id="amount_50" value="50">
                        <label for="amount_50"><?php echo $currency['symbol']; ?> 50</label>
                    </div>
                    <div class="amount-option">
                        <input type="radio" name="amount_preset" id="amount_100" value="100">
                        <label for="amount_100"><?php echo $currency['symbol']; ?> 100</label>
                    </div>
                    <div class="amount-option">
                        <input type="radio" name="amount_preset" id="amount_custom" value="custom">
                        <label for="amount_custom">Custom</label>
                    </div>
                </div>
                
                <div class="custom-amount-wrapper" id="customAmountWrapper" style="display: none;">
                    <label for="custom_amount" class="form-label">Enter Custom Amount</label>
                    <div class="custom-amount-input">
                        <span><?php echo $currency['symbol']; ?></span>
                        <input type="number" class="form-control" id="custom_amount" name="custom_amount" 
                               min="1" max="1000" step="1" placeholder="Enter amount (1-1000)">
                    </div>
                </div>
            </div>
            
            <!-- Cause Selection -->
            <div class="form-card">
                <h2 class="form-section-title">Choose Where to Donate</h2>
                
                <div class="cause-select-wrapper">
                    <label for="cause_id" class="form-label">Select Cause (Optional)</label>
                    <select class="form-select" id="cause_id" name="cause_id">
                        <option value="">General Donation (Where Most Needed)</option>
                        <?php foreach ($causes as $cause): 
                            $progress = $cause['goal_amount'] > 0 ? ($cause['raised_amount'] / $cause['goal_amount']) * 100 : 0;
                        ?>
                            <option value="<?= $cause['id'] ?>" 
                                    data-raised="<?= number_format($cause['raised_amount']) ?>"
                                    data-goal="<?= number_format($cause['goal_amount']) ?>"
                                    data-progress="<?= $progress ?>">
                                <?= htmlspecialchars($cause['title']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    
                    <div class="cause-info" id="causeInfo">
                        <div><strong>Progress:</strong> <span id="causeStats"></span></div>
                        <div class="cause-progress">
                            <div class="progress">
                                <div class="progress-bar" id="causeProgressBar" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Donor Information -->
            <div class="form-card">
                <h2 class="form-section-title">Your Information</h2>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="+256...">
                    </div>
                    
                    <div class="col-12">
                        <label for="message" class="form-label">Message (Optional)</label>
                        <textarea class="form-control" id="message" name="message" rows="3" 
                                  placeholder="Share why you're donating..."></textarea>
                    </div>
                    
                    <div class="col-12">
                        <div class="checkbox-wrapper">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_anonymous" name="is_anonymous" value="1">
                                <label class="form-check-label" for="is_anonymous">
                                    Make this donation anonymous
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="btn btn-donate">
                <i class="fas fa-heart me-2"></i> Continue to Payment
            </button>
            
            <div class="secure-badge">
                <i class="fas fa-lock"></i>
                <span>Secure payment powered by Pesapal</span>
            </div>
        </form>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Amount selection handling
    const amountRadios = document.querySelectorAll('input[name="amount_preset"]');
    const customAmountWrapper = document.getElementById('customAmountWrapper');
    const customAmountInput = document.getElementById('custom_amount');
    
    amountRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'custom') {
                customAmountWrapper.style.display = 'block';
                customAmountInput.required = true;
                customAmountInput.focus();
            } else {
                customAmountWrapper.style.display = 'none';
                customAmountInput.required = false;
                customAmountInput.value = '';
            }
        });
    });
    
    // Cause selection handling
    const causeSelect = document.getElementById('cause_id');
    const causeInfo = document.getElementById('causeInfo');
    const causeStats = document.getElementById('causeStats');
    const causeProgressBar = document.getElementById('causeProgressBar');
    
    causeSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        
        if (this.value) {
            const raised = selectedOption.dataset.raised;
            const goal = selectedOption.dataset.goal;
            const progress = parseFloat(selectedOption.dataset.progress);
            
            causeStats.textContent = `<?php echo $currency['symbol']; ?> ${raised} raised of <?php echo $currency['symbol']; ?> ${goal} goal`;
            causeProgressBar.style.width = `${Math.min(progress, 100)}%`;
            causeInfo.classList.add('active');
        } else {
            causeInfo.classList.remove('active');
        }
    });
    
    // Form validation
    const form = document.getElementById('donationForm');
    form.addEventListener('submit', function(e) {
        const amountChecked = document.querySelector('input[name="amount_preset"]:checked');
        
        if (!amountChecked) {
            e.preventDefault();
            alert('Please select a donation amount');
            return false;
        }
        
        if (amountChecked.value === 'custom') {
            const customAmount = parseFloat(customAmountInput.value);
            if (!customAmount || customAmount < 1000) {
                e.preventDefault();
                alert('Custom amount must be at least <?php echo $currency['symbol']; ?> 1,000');
                customAmountInput.focus();
                return false;
            }
        }
    });
});
</script>

<?php include 'includes/footer.php'; ?>
