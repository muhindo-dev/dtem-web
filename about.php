<?php
$currentPage = 'about';
$pageTitle = 'About Us';
include 'config.php';
include 'functions.php';

$siteName = getSetting('site_name', 'DTEHM Health Ministries');
$siteShortName = getSetting('site_short_name', 'DTEHM');
$missionStatement = getSetting('mission_statement', '');
$visionStatement = getSetting('vision_statement', '');
$foundingYear = getSetting('founding_year', '2021');

$pageDescription = 'Learn about DTEHM Health Ministries - our mission, vision, leadership team, and branch offices across Uganda.';
include 'includes/header.php';

// Fetch team members
$stmt = $pdo->query("SELECT * FROM team_members WHERE status = 'active' ORDER BY display_order ASC");
$teamMembers = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalMembers = $pdo->query("SELECT COUNT(*) FROM users WHERE is_dtehm_member = 1")->fetchColumn();
$totalProducts = $pdo->query("SELECT COUNT(*) FROM products WHERE status = 'Active'")->fetchColumn();
?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>About <?php echo htmlspecialchars($siteShortName); ?></h1>
            <p>Transforming healthcare through holistic solutions since <?php echo htmlspecialchars($foundingYear); ?></p>
        </div>
    </div>

    <!-- About Overview -->
    <section class="section-pad">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="badge-section" style="display: inline-block; margin-bottom: 1rem;">ABOUT DTEHM</span>
                    <h2 class="section-heading" style="margin-bottom: 1.5rem;">Dr Thembo Enostus Health Ministries</h2>
                    <p style="color: var(--gray-text); line-height: 1.8; font-size: 1.05rem; margin-bottom: 1.5rem;">
                        DTEHM Health Ministries is committed to transforming the health landscape through complementary, alternative, and herbal medicine. We specialize in holistic healthcare solutions including Ayurveda, naturopathy, and personal skin care products.
                    </p>
                    <p style="color: var(--gray-text); line-height: 1.8; font-size: 1.05rem; margin-bottom: 1.5rem;">
                        Founded in <?php echo htmlspecialchars($foundingYear); ?> by Dr. Thembo Enostus Nzwende, our organization has grown to serve communities across the Kasese District through multiple branch offices, offering accessible healthcare products and services.
                    </p>
                    <p style="color: var(--gray-text); line-height: 1.8; font-size: 1.05rem;">
                        Beyond healthcare, we provide investment opportunities, health insurance coverage, and a network marketing platform that empowers members to achieve financial independence while promoting health and wellness.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="content-block" style="text-align: center;">
                        <i class="fas fa-heartbeat" style="font-size: 3rem; color: var(--primary-blue); margin-bottom: 1.5rem; display: block;"></i>
                        <div class="row g-3">
                            <div class="col-6">
                                <div style="background: var(--white); border-radius: 12px; padding: 1.5rem;">
                                    <div class="stat-value"><?php echo date('Y') - (int)$foundingYear; ?>+</div>
                                    <div style="font-size: 0.85rem; color: var(--gray-text); font-weight: 600;">Years of Service</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div style="background: var(--white); border-radius: 12px; padding: 1.5rem;">
                                    <div class="stat-value"><?php echo number_format($totalMembers); ?>+</div>
                                    <div style="font-size: 0.85rem; color: var(--gray-text); font-weight: 600;">Members</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div style="background: var(--white); border-radius: 12px; padding: 1.5rem;">
                                    <div class="stat-value"><?php echo $totalProducts; ?>+</div>
                                    <div style="font-size: 0.85rem; color: var(--gray-text); font-weight: 600;">Products</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div style="background: var(--white); border-radius: 12px; padding: 1.5rem;">
                                    <div class="stat-value">4</div>
                                    <div style="font-size: 0.85rem; color: var(--gray-text); font-weight: 600;">Branches</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="section-pad" style="background: var(--gray-light);">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">OUR PURPOSE</span>
                <h2>Mission & Vision</h2>
            </div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="mission-card">
                        <div class="mission-icon"><i class="fas fa-bullseye"></i></div>
                        <h3>Our Mission</h3>
                        <p><?php echo htmlspecialchars($missionStatement); ?></p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mission-card">
                        <div class="mission-icon"><i class="fas fa-eye"></i></div>
                        <h3>Our Vision</h3>
                        <p><?php echo htmlspecialchars($visionStatement); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="section-pad">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">WHAT DRIVES US</span>
                <h2>Our Core Values</h2>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="service-card text-center">
                        <div class="service-icon mx-auto"><i class="fas fa-hand-holding-medical"></i></div>
                        <h3>Holistic Care</h3>
                        <p>Treating the whole person through complementary and alternative medicine, addressing body, mind, and spirit.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card text-center">
                        <div class="service-icon mx-auto"><i class="fas fa-users"></i></div>
                        <h3>Community First</h3>
                        <p>Empowering communities through accessible healthcare, financial opportunities, and mutual support.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card text-center">
                        <div class="service-icon mx-auto"><i class="fas fa-seedling"></i></div>
                        <h3>Natural Solutions</h3>
                        <p>Harnessing the power of nature through Ayurveda, herbal treatments, and naturopathy.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card text-center">
                        <div class="service-icon mx-auto"><i class="fas fa-shield-alt"></i></div>
                        <h3>Trust & Integrity</h3>
                        <p>Operating with transparency and accountability in all our health and business dealings.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card text-center">
                        <div class="service-icon mx-auto"><i class="fas fa-lightbulb"></i></div>
                        <h3>Innovation</h3>
                        <p>Continuously improving our products and services through research and technology.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card text-center">
                        <div class="service-icon mx-auto"><i class="fas fa-globe-africa"></i></div>
                        <h3>Accessibility</h3>
                        <p>Making quality healthcare products and services available and affordable to everyone.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="section-pad" style="background: var(--gray-light);">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">OUR LEADERSHIP</span>
                <h2>Meet Our Team</h2>
                <p class="subtitle">Dedicated professionals driving our mission forward</p>
            </div>
            <div class="row g-4 justify-content-center">
                <?php foreach ($teamMembers as $member): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="team-card">
                        <div class="team-photo">
                            <?php if (!empty($member['photo'])): ?>
                            <img src="uploads/team/<?php echo htmlspecialchars($member['photo']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>">
                            <?php else: ?>
                            <i class="fas fa-user-circle"></i>
                            <?php endif; ?>
                        </div>
                        <div class="team-info">
                            <h4><?php echo htmlspecialchars($member['name']); ?></h4>
                            <p><?php echo htmlspecialchars($member['position']); ?></p>
                            <?php if (!empty($member['bio'])): ?>
                            <p style="color: var(--gray-text); font-size: 0.85rem; margin-top: 0.5rem; font-weight: 400; line-height: 1.6;">
                                <?php echo htmlspecialchars(substr($member['bio'], 0, 150)); ?>...
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Branch Offices -->
    <section id="branches" class="section-pad">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">OUR PRESENCE</span>
                <h2>Branch Offices</h2>
                <p class="subtitle">Serving communities across the Kasese District</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="branch-card">
                        <div class="branch-icon"><i class="fas fa-building"></i></div>
                        <h5>Kasese Branch</h5>
                        <p>Head Office<br>Kamaiba Lower, Near SDA Primary School</p>
                        <a href="tel:+256779863165" class="mt-2 d-inline-block"><i class="fas fa-phone me-1"></i>+256 779 863165</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="branch-card">
                        <div class="branch-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <h5>Bwera Branch</h5>
                        <p>Bwera Town<br>Kasese District</p>
                        <a href="tel:+256780378906" class="mt-2 d-inline-block"><i class="fas fa-phone me-1"></i>+256 780 378906</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="branch-card">
                        <div class="branch-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <h5>Rugendabara Branch</h5>
                        <p>Rugendabara<br>Kasese District</p>
                        <a href="tel:+256785420194" class="mt-2 d-inline-block"><i class="fas fa-phone me-1"></i>+256 785 420194</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="branch-card">
                        <div class="branch-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <h5>Kisinga Branch</h5>
                        <p>Kisinga Town<br>Kasese District</p>
                        <a href="tel:+256782639131" class="mt-2 d-inline-block"><i class="fas fa-phone me-1"></i>+256 782 639131</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section id="cta" class="section-pad-sm">
        <div class="container text-center">
            <h2 class="section-heading" style="color: var(--white);">Ready to Transform Your Health?</h2>
            <p style="color: rgba(255,255,255,0.9); font-size: 1.1rem; margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">Join DTEHM Health Ministries and access holistic healthcare solutions, investment opportunities, and a supportive community.</p>
            <div class="cta-inline-btns" style="justify-content: center;">
                <a href="enroll.php" class="btn-green-custom" style="padding: 0.8rem 2rem;"><i class="fas fa-user-plus me-2"></i>Join DTEHM</a>
                <a href="contact.php" style="display: inline-block; background: transparent; color: var(--white); border: 2px solid var(--white); padding: 0.8rem 2rem; font-weight: 600; border-radius: 6px; text-decoration: none;"><i class="fas fa-envelope me-2"></i>Contact Us</a>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
