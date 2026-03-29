<?php
$currentPage = 'insurance';
$pageTitle = 'Insurance Programs';
include 'config.php';
include 'functions.php';

$pageDescription = 'DTEHM Health Insurance programs - affordable comprehensive health coverage for you and your family.';
include 'includes/header.php';

// Get insurance programs
$programs = $pdo->query("SELECT * FROM insurance_programs WHERE status = 'active' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Health Insurance</h1>
            <p>Comprehensive and affordable health coverage for you and your family</p>
        </div>
    </div>

    <!-- Insurance Overview -->
    <section class="section-pad">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <h2 class="section-heading">Why DTEHM Insurance?</h2>
                    <p style="color: var(--gray-text); line-height: 1.8;">
                        DTEHM Health Ministries offers health insurance programs designed to provide comprehensive medical coverage 
                        at affordable premiums. Our insurance partners ensure you and your family get the care you need 
                        without financial burden.
                    </p>
                    <div class="row mt-4">
                        <div class="col-6 mb-3">
                            <div style="display: flex; align-items: start; gap: 0.8rem;">
                                <i class="fas fa-shield-alt" style="color: var(--primary-green); font-size: 1.3rem; margin-top: 3px;"></i>
                                <div>
                                    <strong style="color: var(--dark-blue);">Full Coverage</strong>
                                    <p style="font-size: 0.85rem; color: var(--gray-text); margin: 0;">Comprehensive health protection</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div style="display: flex; align-items: start; gap: 0.8rem;">
                                <i class="fas fa-wallet" style="color: var(--primary-green); font-size: 1.3rem; margin-top: 3px;"></i>
                                <div>
                                    <strong style="color: var(--dark-blue);">Affordable</strong>
                                    <p style="font-size: 0.85rem; color: var(--gray-text); margin: 0;">Low monthly premiums</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div style="display: flex; align-items: start; gap: 0.8rem;">
                                <i class="fas fa-hospital" style="color: var(--primary-green); font-size: 1.3rem; margin-top: 3px;"></i>
                                <div>
                                    <strong style="color: var(--dark-blue);">Hospital Network</strong>
                                    <p style="font-size: 0.85rem; color: var(--gray-text); margin: 0;">Partner hospitals across Uganda</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div style="display: flex; align-items: start; gap: 0.8rem;">
                                <i class="fas fa-users" style="color: var(--primary-green); font-size: 1.3rem; margin-top: 3px;"></i>
                                <div>
                                    <strong style="color: var(--dark-blue);">Family Plans</strong>
                                    <p style="font-size: 0.85rem; color: var(--gray-text); margin: 0;">Cover your loved ones</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="content-block" style="position: relative; text-align: center;">
                        <i class="fas fa-hand-holding-medical" style="font-size: 3rem; color: var(--primary-blue); opacity: 0.15; position: absolute; top: 1rem; right: 2rem;"></i>
                        <i class="fas fa-heartbeat" style="font-size: 3rem; color: var(--primary-blue); margin-bottom: 1.5rem;"></i>
                        <h3 style="color: var(--dark-blue); font-weight: 700;">Health is Wealth</h3>
                        <p style="color: var(--gray-text);">Protect your health, protect your future. With DTEHM insurance, you get peace of mind knowing medical expenses are covered.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Insurance Programs -->
    <section class="section-pad-sm" style="background: var(--light-gray);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-heading">Our Insurance Programs</h2>
                <p style="color: var(--gray-text);">Choose the plan that best fits your needs</p>
            </div>

            <?php if (empty($programs)): ?>
            <div class="text-center py-5">
                <i class="fas fa-shield-alt" style="font-size: 3rem; color: var(--gray-border); margin-bottom: 1rem; display: block;"></i>
                <p style="color: var(--gray-text);">Insurance programs are being updated. Please check back soon.</p>
            </div>
            <?php else: ?>
            <div class="row g-4 justify-content-center">
                <?php foreach ($programs as $program): ?>
                <div class="col-lg-6">
                    <div class="insurance-card">
                        <div style="background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue)); color: var(--white); padding: 1.5rem 2rem; border-radius: 12px 12px 0 0;">
                            <h3 style="font-weight: 700; margin-bottom: 0.5rem;"><?php echo htmlspecialchars($program['name']); ?></h3>
                            <div style="display: flex; align-items: baseline; gap: 0.3rem;">
                                <span class="stat-value" style="color: var(--white);">UGX <?php echo number_format($program['premium_amount']); ?></span>
                                <span style="opacity: 0.8;">/<?php echo htmlspecialchars($program['billing_frequency'] ?? 'month'); ?></span>
                            </div>
                        </div>
                        <div style="padding: 2rem;">
                            <?php if (!empty($program['coverage_amount'])): ?>
                            <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1.5rem; padding: 1rem; background: var(--light-blue); border-radius: 8px;">
                                <i class="fas fa-shield-alt" style="color: var(--primary-blue); font-size: 1.5rem;"></i>
                                <div>
                                    <small style="color: var(--gray-text); display: block;">Coverage Amount</small>
                                    <strong style="color: var(--dark-blue); font-size: 1.1rem;">UGX <?php echo number_format($program['coverage_amount']); ?></strong>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($program['benefits'])): ?>
                            <h5 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 1rem;"><i class="fas fa-check-circle me-2" style="color: var(--primary-green);"></i>Benefits</h5>
                            <div style="color: var(--gray-text); line-height: 1.8; margin-bottom: 1.5rem;">
                                <?php echo nl2br(htmlspecialchars($program['benefits'])); ?>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($program['requirements'])): ?>
                            <h5 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 1rem;"><i class="fas fa-clipboard-list me-2" style="color: var(--primary-blue);"></i>Requirements</h5>
                            <div style="color: var(--gray-text); line-height: 1.8; margin-bottom: 1.5rem;">
                                <?php echo nl2br(htmlspecialchars($program['requirements'])); ?>
                            </div>
                            <?php endif; ?>

                            <a href="https://play.google.com/store/apps/details?id=com.dtehm.insurance" target="_blank" rel="noopener noreferrer" class="btn-green-custom" style="display: block; text-align: center; padding: 0.8rem;">
                                <i class="fab fa-google-play me-2"></i>Enroll via App
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- How It Works -->
    <section class="section-pad">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-heading">How It Works</h2>
                <p style="color: var(--gray-text);">Getting covered is easy in 4 simple steps</p>
            </div>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-circle" style="background: var(--light-blue); color: var(--primary-blue);">1</div>
                        <h5 style="color: var(--dark-blue); font-weight: 700;">Register</h5>
                        <p style="color: var(--gray-text); font-size: 0.9rem;">Join DTEHM as a member through the app or website</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-circle" style="background: var(--light-blue); color: var(--primary-blue);">2</div>
                        <h5 style="color: var(--dark-blue); font-weight: 700;">Choose a Plan</h5>
                        <p style="color: var(--gray-text); font-size: 0.9rem;">Select the insurance program that fits your needs</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-circle" style="background: var(--light-blue); color: var(--primary-blue);">3</div>
                        <h5 style="color: var(--dark-blue); font-weight: 700;">Pay Premium</h5>
                        <p style="color: var(--gray-text); font-size: 0.9rem;">Make affordable monthly premium payments via mobile money</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="step-circle" style="background: var(--light-blue); color: var(--primary-blue);">4</div>
                        <h5 style="color: var(--dark-blue); font-weight: 700;">Get Covered</h5>
                        <p style="color: var(--gray-text); font-size: 0.9rem;">Access healthcare services at partner hospitals</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section id="cta" class="section-pad-sm">
        <div class="container text-center">
            <h2 class="section-heading" style="color: var(--white);">Ready to Get Covered?</h2>
            <p style="color: rgba(255,255,255,0.9); margin-bottom: 2rem;">Join thousands of members enjoying affordable healthcare coverage.</p>
            <div class="cta-inline-btns" style="justify-content: center;">
                <a href="https://play.google.com/store/apps/details?id=com.dtehm.insurance" target="_blank" rel="noopener noreferrer" class="btn-green-custom" style="padding: 0.8rem 2rem;"><i class="fab fa-google-play me-2"></i>Get the App</a>
                <a href="contact.php" style="display: inline-block; background: transparent; color: var(--white); border: 2px solid var(--white); padding: 0.8rem 2rem; font-weight: 600; border-radius: 6px; text-decoration: none;"><i class="fas fa-phone me-2"></i>Contact Us</a>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
