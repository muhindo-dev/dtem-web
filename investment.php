<?php
$currentPage = 'investment';
$pageTitle = 'Investment Opportunities';
include 'config.php';
include 'functions.php';

$pageDescription = 'Invest in DTEHM Health Ministries projects - buy shares and earn returns while supporting healthcare in Uganda.';
include 'includes/header.php';

// Get projects
$projects = $pdo->query("SELECT * FROM projects WHERE status IN ('ongoing','completed') ORDER BY title")->fetchAll(PDO::FETCH_ASSOC);
?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Investment Opportunities</h1>
            <p>Invest in healthcare projects and grow your wealth while impacting communities</p>
        </div>
    </div>

    <!-- Investment Overview -->
    <section class="section-pad">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <h2 class="section-heading">Invest in Health, Invest in Life</h2>
                    <p style="color: var(--gray-text); line-height: 1.8;">
                        DTEHM Health Ministries offers investment opportunities through shares in various healthcare 
                        and wellness projects. By investing, you support the growth of communities while earning 
                        returns on your investment.
                    </p>
                    <div class="mt-4">
                        <div style="display: flex; align-items: start; gap: 1rem; margin-bottom: 1.2rem;">
                            <div class="icon-circle-md" style="background: var(--light-blue);">
                                <i class="fas fa-chart-line" style="color: var(--primary-blue);"></i>
                            </div>
                            <div>
                                <strong style="color: var(--dark-blue);">Share-Based Investment</strong>
                                <p style="font-size: 0.9rem; color: var(--gray-text); margin: 0;">Buy shares in projects and earn returns as they grow</p>
                            </div>
                        </div>
                        <div style="display: flex; align-items: start; gap: 1rem; margin-bottom: 1.2rem;">
                            <div class="icon-circle-md" style="background: var(--light-blue);">
                                <i class="fas fa-hand-holding-usd" style="color: var(--primary-blue);"></i>
                            </div>
                            <div>
                                <strong style="color: var(--dark-blue);">Affordable Entry</strong>
                                <p style="font-size: 0.9rem; color: var(--gray-text); margin: 0;">Start investing with shares from UGX 100,000</p>
                            </div>
                        </div>
                        <div style="display: flex; align-items: start; gap: 1rem;">
                            <div class="icon-circle-md" style="background: var(--light-blue);">
                                <i class="fas fa-heartbeat" style="color: var(--primary-blue);"></i>
                            </div>
                            <div>
                                <strong style="color: var(--dark-blue);">Social Impact</strong>
                                <p style="font-size: 0.9rem; color: var(--gray-text); margin: 0;">Your investment directly improves healthcare access</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="content-block" style="position: relative; text-align: center;">
                        <i class="fas fa-chart-pie" style="font-size: 3rem; color: var(--primary-blue); opacity: 0.15; position: absolute; top: 1rem; right: 2rem;"></i>
                        <i class="fas fa-seedling" style="font-size: 3rem; color: var(--primary-green); margin-bottom: 1.5rem;"></i>
                        <h3 style="color: var(--dark-blue); font-weight: 700;">Grow With Us</h3>
                        <p style="color: var(--gray-text);">DTEHM projects create sustainable healthcare solutions. Your shares contribute to building a healthier and more prosperous society.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Available Projects -->
    <section class="section-pad-sm" style="background: var(--light-gray);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-heading">Available Projects</h2>
                <p style="color: var(--gray-text);">Browse our investment opportunities and buy shares</p>
            </div>

            <?php if (empty($projects)): ?>
            <div class="text-center py-5">
                <i class="fas fa-briefcase" style="font-size: 3rem; color: var(--gray-border); margin-bottom: 1rem; display: block;"></i>
                <p style="color: var(--gray-text);">Investment projects are being prepared. Please check back soon.</p>
            </div>
            <?php else: ?>
            <div class="row g-4">
                <?php foreach ($projects as $project): 
                    $sharesSold = (int)($project['shares_sold'] ?? 0);
                    $totalShares = (int)($project['total_shares'] ?? 1);
                    $progressPercent = $totalShares > 0 ? round(($sharesSold / $totalShares) * 100) : 0;
                    $sharesAvailable = $totalShares - $sharesSold;
                ?>
                <div class="col-lg-6">
                    <div class="service-card" style="padding: 0; overflow: hidden;">
                        <div style="background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue)); padding: 1.5rem 2rem; color: var(--white);">
                            <h3 style="font-weight: 700; margin-bottom: 0.3rem; font-size: 1.3rem;"><?php echo htmlspecialchars($project['title']); ?></h3>
                            <span style="opacity: 0.8; font-size: 0.85rem;">Investment Project</span>
                        </div>
                        <div style="padding: 2rem;">
                            <?php if (!empty($project['description'])): ?>
                            <p style="color: var(--gray-text); margin-bottom: 1.5rem; line-height: 1.7;"><?php echo htmlspecialchars(substr(strip_tags($project['description']), 0, 200)); ?></p>
                            <?php endif; ?>

                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <div style="background: var(--light-blue); border-radius: 8px; padding: 0.8rem 1rem; text-align: center;">
                                        <small style="color: var(--gray-text); display: block;">Share Price</small>
                                        <strong style="color: var(--primary-blue); font-size: 1.1rem;">UGX <?php echo number_format($project['share_price'] ?? 0); ?></strong>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div style="background: var(--light-blue); border-radius: 8px; padding: 0.8rem 1rem; text-align: center;">
                                        <small style="color: var(--gray-text); display: block;">Total Shares</small>
                                        <strong style="color: var(--primary-blue); font-size: 1.1rem;"><?php echo number_format($totalShares); ?></strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div style="margin-bottom: 1rem;">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 0.3rem;">
                                    <small style="color: var(--gray-text);"><?php echo number_format($sharesSold); ?> sold</small>
                                    <small style="color: var(--gray-text);"><?php echo number_format($sharesAvailable); ?> available</small>
                                </div>
                                <div class="progress-bar-custom">
                                    <div class="progress-bar-fill" style="width: <?php echo $progressPercent; ?>%;"></div>
                                </div>
                                <small style="color: var(--gray-text);"><?php echo $progressPercent; ?>% funded</small>
                            </div>

                            <a href="https://play.google.com/store/apps/details?id=com.dtehm.insurance" target="_blank" rel="noopener noreferrer" class="btn-primary-custom" style="display: block; text-align: center; padding: 0.8rem;">
                                <i class="fab fa-google-play me-2"></i>Invest via App
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA -->
    <section id="cta" class="section-pad-sm">
        <div class="container text-center">
            <h2 class="section-heading" style="color: var(--white);">Start Your Investment Journey</h2>
            <p style="color: rgba(255,255,255,0.9); margin-bottom: 2rem;">Join DTEHM and start investing in projects that grow your wealth and impact communities.</p>
            <div class="cta-inline-btns" style="justify-content: center;">
                <a href="https://play.google.com/store/apps/details?id=com.dtehm.insurance" target="_blank" rel="noopener noreferrer" class="btn-green-custom" style="padding: 0.8rem 2rem;"><i class="fab fa-google-play me-2"></i>Get the App</a>
                <a href="contact.php" style="display: inline-block; background: transparent; color: var(--white); border: 2px solid var(--white); padding: 0.8rem 2rem; font-weight: 600; border-radius: 6px; text-decoration: none;"><i class="fas fa-phone me-2"></i>Contact Us</a>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
