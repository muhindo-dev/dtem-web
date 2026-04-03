<?php 
$currentPage = 'home';
$pageTitle = 'Home';
include 'config.php';
include 'functions.php';

// Get settings
$siteName = getSetting('site_name', 'DTEHM Health Ministries');
$siteShortName = getSetting('site_short_name', 'DTEHM');
$siteTagline = getSetting('site_tagline', 'Curing Lives with Ayukalash');
$siteDescription = getSetting('site_description', '');
$missionStatement = getSetting('mission_statement', '');
$visionStatement = getSetting('vision_statement', '');

$pageDescription = $siteDescription;
include 'includes/header.php';

// Fetch featured products
$stmt = $pdo->query("SELECT p.*, pc.category as category_name FROM products p LEFT JOIN product_categories pc ON p.category = pc.id WHERE p.status = 'Active' ORDER BY p.id DESC LIMIT 8");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch stats
$totalMembers = $pdo->query("SELECT COUNT(*) FROM users WHERE is_dtehm_member = 'Yes'")->fetchColumn();
$totalProducts = $pdo->query("SELECT COUNT(*) FROM products WHERE status = 'Active'")->fetchColumn();
$totalMemberships = $pdo->query("SELECT COUNT(*) FROM dtehm_memberships WHERE status = 'CONFIRMED'")->fetchColumn();

// Fetch latest news
$stmt = $pdo->query("SELECT * FROM news_posts WHERE status = 'published' ORDER BY published_at DESC LIMIT 3");
$latestNews = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch upcoming events
$stmt = $pdo->query("SELECT * FROM events WHERE status = 'upcoming' ORDER BY start_datetime ASC LIMIT 3");
$upcomingEvents = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch team members
$stmt = $pdo->query("SELECT * FROM team_members WHERE status = 'active' ORDER BY display_order ASC LIMIT 4");
$teamMembers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <!-- Hero Section -->
    <section id="hero">
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
        <div class="hero-orb hero-orb-3"></div>
        <div class="container">
            <div class="hero-content-wrapper">
                <div class="hero-badge" data-aos="fade-down" data-aos-delay="100">
                    <span class="badge-dtehm"><?php echo htmlspecialchars($siteShortName); ?> HEALTH MINISTRIES</span>
                </div>
                <h1 class="hero-title" data-aos="fade-up" data-aos-delay="200">
                    Curing Lives with<br><span class="highlight">Ayukalash</span>
                </h1>
                <p class="hero-lead" data-aos="fade-up" data-aos-delay="300">
                    Transforming the health landscape through complementary, alternative, and herbal medicine. 
                    Holistic healthcare solutions for a healthier Uganda.
                </p>
                <div class="hero-buttons" data-aos="fade-up" data-aos-delay="400">
                    <a href="https://play.google.com/store/apps/details?id=com.dtehm.insurance" target="_blank" rel="noopener noreferrer" class="btn-hero btn-hero-primary">
                        <i class="fab fa-google-play me-2"></i><span>Download App</span>
                    </a>
                    <a href="about.php" class="btn-hero btn-hero-outline">
                        <i class="fas fa-info-circle me-2"></i><span>Learn More</span>
                    </a>
                </div>
                <div class="hero-stats-grid" data-aos="fade-up" data-aos-delay="500">
                    <div class="hero-stat-item">
                        <i class="fas fa-users stat-icon"></i>
                        <span class="stat-number" data-count="<?php echo $totalMembers; ?>"><?php echo number_format($totalMembers); ?>+</span>
                        <span class="stat-label">Members</span>
                    </div>
                    <div class="hero-stat-item">
                        <i class="fas fa-leaf stat-icon"></i>
                        <span class="stat-number" data-count="<?php echo $totalProducts; ?>"><?php echo $totalProducts; ?>+</span>
                        <span class="stat-label">Products</span>
                    </div>
                    <div class="hero-stat-item">
                        <i class="fas fa-handshake stat-icon"></i>
                        <span class="stat-number" data-count="<?php echo $totalMemberships; ?>"><?php echo number_format($totalMemberships); ?>+</span>
                        <span class="stat-label">Memberships</span>
                    </div>
                    <div class="hero-stat-item">
                        <i class="fas fa-map-marker-alt stat-icon"></i>
                        <span class="stat-number" data-count="4">4</span>
                        <span class="stat-label">Branches</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Overview -->
    <section class="section-pad" style="background: var(--gray-light);">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="badge-section">OUR SERVICES</span>
                <h2>What We Offer</h2>
                <p class="subtitle">Comprehensive healthcare solutions combining traditional wisdom with modern approaches</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-card text-center">
                        <div class="service-icon mx-auto"><i class="fas fa-leaf"></i></div>
                        <h3>Health Products</h3>
                        <p>30+ natural health products from UGX 35,000. Herbal medicines, supplements, and personal care items.</p>
                        <a href="shop.php" class="btn-outline-custom mt-2" style="font-size: 0.85rem; padding: 0.5rem 1.2rem;">View Products</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-card text-center">
                        <div class="service-icon mx-auto"><i class="fas fa-shield-alt"></i></div>
                        <h3>Health Insurance</h3>
                        <p>Up to UGX 50M coverage for just UGX 16,000/month. Comprehensive health insurance for you and your family.</p>
                        <a href="insurance.php" class="btn-outline-custom mt-2" style="font-size: 0.85rem; padding: 0.5rem 1.2rem;">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-card text-center">
                        <div class="service-icon mx-auto"><i class="fas fa-chart-line"></i></div>
                        <h3>Investment</h3>
                        <p>Buy shares in healthcare and agriculture projects from UGX 100,000 per share and earn returns.</p>
                        <a href="investment.php" class="btn-outline-custom mt-2" style="font-size: 0.85rem; padding: 0.5rem 1.2rem;">Invest Now</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-card text-center">
                        <div class="service-icon mx-auto"><i class="fas fa-project-diagram"></i></div>
                        <h3>Network & Earnings</h3>
                        <p>Earn up to 32.5% commission on product sales across a 10-generation network. 8 leadership ranks with rewards.</p>
                        <a href="network.php" class="btn-outline-custom mt-2" style="font-size: 0.85rem; padding: 0.5rem 1.2rem;">Join Network</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section id="mission" class="section-pad" style="background: var(--white);">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="badge-section">WHO WE ARE</span>
                <h2>Our Mission & Vision</h2>
                <p class="subtitle">Guided by a commitment to holistic healthcare and community empowerment</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                    <div class="mission-card">
                        <div class="mission-icon"><i class="fas fa-bullseye"></i></div>
                        <h3>Our Mission</h3>
                        <p><?php echo htmlspecialchars($missionStatement); ?></p>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="mission-card">
                        <div class="mission-icon"><i class="fas fa-eye"></i></div>
                        <h3>Our Vision</h3>
                        <p><?php echo htmlspecialchars($visionStatement); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="section-pad" style="background: var(--gray-light);">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="badge-section">HEALTH PRODUCTS</span>
                <h2>Our Natural Products</h2>
                <p class="subtitle">Natural herbal medicines, supplements, and personal care products from UGX 35,000</p>
            </div>
            <div class="row g-3 g-md-4">
                <?php foreach ($products as $product): ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="product-detail.php?id=<?php echo $product['id']; ?>" style="text-decoration: none; color: inherit; display: block;">
                    <div class="product-card">
                        <div class="product-image">
                            <?php if (!empty($product['feature_photo'])): ?>
                            <img src="<?php echo htmlspecialchars(API_STORAGE_URL . $product['feature_photo']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <?php else: ?>
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: var(--light-blue);">
                                <i class="fas fa-leaf" style="font-size: 3rem; color: var(--primary-blue); opacity: 0.3;"></i>
                            </div>
                            <?php endif; ?>
                            <?php if (!empty($product['category_name'])): ?>
                            <span class="product-badge"><?php echo htmlspecialchars($product['category_name']); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="product-body">
                            <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                            <?php if (!empty($product['price_1']) && $product['price_1'] > 0): ?>
                            <div class="product-price">
                                UGX <?php echo number_format($product['price_1']); ?>
                            </div>
                            <?php endif; ?>
                            <?php if (!empty($product['description'])): ?>
                            <p class="product-desc"><?php echo htmlspecialchars(substr(strip_tags($product['description']), 0, 80)); ?>...</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-4">
                <a href="shop.php" class="btn-primary-custom">
                    <i class="fas fa-shopping-bag me-2"></i>View All Products
                </a>
            </div>
        </div>
    </section>

    <!-- Impact Stats -->
    <section id="impact">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="badge-section">OUR IMPACT</span>
                <h2>Making a Difference</h2>
                <p class="subtitle">Growing community impact through holistic healthcare and empowerment</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="impact-card">
                        <div class="impact-icon"><i class="fas fa-users"></i></div>
                        <div class="impact-number" data-count="<?php echo $totalMembers; ?>"><?php echo number_format($totalMembers); ?>+</div>
                        <div class="impact-label">Registered Members</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="impact-card">
                        <div class="impact-icon"><i class="fas fa-leaf"></i></div>
                        <div class="impact-number" data-count="<?php echo $totalProducts; ?>"><?php echo $totalProducts; ?>+</div>
                        <div class="impact-label">Health Products</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="impact-card">
                        <div class="impact-icon"><i class="fas fa-map-pin"></i></div>
                        <div class="impact-number" data-count="4">4</div>
                        <div class="impact-label">Branch Offices</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                    <div class="impact-card">
                        <div class="impact-icon"><i class="fas fa-calendar-check"></i></div>
                        <div class="impact-number" data-count="<?php echo date('Y') - 2021; ?>"><?php echo date('Y') - 2021; ?>+</div>
                        <div class="impact-label">Years of Service</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Networking & Earnings -->
    <section class="network-section section-pad">
        <div class="container">
            <div class="network-content-wrap">
                <div class="row align-items-center g-5">
                    <div class="col-lg-5" data-aos="fade-right">
                        <div class="network-heading-badge"><i class="fas fa-project-diagram"></i> EARN WITH DTEHM</div>
                        <h2 class="network-main-title">Build Your Network, <span>Grow Your Income</span></h2>
                        <p class="network-subtitle">Join our 10-generation referral network and earn commissions on every product sale. From Sponsor bonuses to leadership rewards — multiple income streams await you.</p>
                        <div class="network-highlight-grid">
                            <div class="network-highlight-card">
                                <div class="network-highlight-number green">32.5%</div>
                                <div class="network-highlight-label">Total Commission</div>
                            </div>
                            <div class="network-highlight-card">
                                <div class="network-highlight-number">10</div>
                                <div class="network-highlight-label">Generations</div>
                            </div>
                            <div class="network-highlight-card">
                                <div class="network-highlight-number green">8</div>
                                <div class="network-highlight-label">Leadership Ranks</div>
                            </div>
                        </div>
                        <div class="network-cta-section">
                            <p class="network-cta-text mb-0"><strong>Start earning</strong> with a membership from UGX 76,000</p>
                            <a href="network.php" class="btn-primary-custom" style="white-space: nowrap;">Learn More <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-7" data-aos="fade-left" data-aos-delay="200">
                        <div class="network-earnings-visual">
                            <div class="earnings-flow">
                                <div class="earnings-flow-item">
                                    <div class="earnings-flow-icon blue"><i class="fas fa-user-plus"></i></div>
                                    <div class="earnings-flow-label">Sponsor</div>
                                    <div class="earnings-flow-value">8%</div>
                                </div>
                                <div class="earnings-flow-arrow"><i class="fas fa-chevron-right"></i></div>
                                <div class="earnings-flow-item">
                                    <div class="earnings-flow-icon green"><i class="fas fa-store"></i></div>
                                    <div class="earnings-flow-label">Stockist</div>
                                    <div class="earnings-flow-value">7%</div>
                                </div>
                                <div class="earnings-flow-arrow"><i class="fas fa-chevron-right"></i></div>
                                <div class="earnings-flow-item">
                                    <div class="earnings-flow-icon blue"><i class="fas fa-sitemap"></i></div>
                                    <div class="earnings-flow-label">GN 1-10</div>
                                    <div class="earnings-flow-value">12.5%</div>
                                </div>
                                <div class="earnings-flow-arrow"><i class="fas fa-chevron-right"></i></div>
                                <div class="earnings-flow-item">
                                    <div class="earnings-flow-icon gold"><i class="fas fa-gift"></i></div>
                                    <div class="earnings-flow-label">Referral</div>
                                    <div class="earnings-flow-value">5%</div>
                                </div>
                            </div>
                            <div style="background: linear-gradient(135deg, var(--light-blue), #f0faf3); border-radius: 12px; padding: 1.25rem 1.5rem; display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                                <div style="width: 44px; height: 44px; background: var(--primary-blue); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-trophy" style="color: var(--white); font-size: 1.1rem;"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 800; color: var(--dark-blue); font-size: 1rem;">Leadership Ranks</div>
                                    <div style="color: var(--gray-text); font-size: 0.85rem;">Member &rarr; DTEHM Executive Director &mdash; unlock salary bonuses, car funds & travel rewards</div>
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.75rem;">
                                <div style="background: var(--gray-light); border-radius: 10px; padding: 1rem; text-align: center;">
                                    <div style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: var(--gray-text); font-weight: 600; margin-bottom: 0.25rem;">Min Withdrawal</div>
                                    <div style="font-weight: 800; color: var(--primary-blue); font-size: 1.1rem;">UGX 10,000</div>
                                </div>
                                <div style="background: var(--gray-light); border-radius: 10px; padding: 1rem; text-align: center;">
                                    <div style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: var(--gray-text); font-weight: 600; margin-bottom: 0.25rem;">Insurance Included</div>
                                    <div style="font-weight: 800; color: var(--primary-green); font-size: 1.1rem;">UGX 50M Cover</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="section-pad" style="background: var(--white);">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="badge-section">OUR LEADERSHIP</span>
                <h2>Meet Our Team</h2>
                <p class="subtitle">Dedicated professionals committed to transforming healthcare</p>
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
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-4">
                <a href="about.php#team" class="btn-outline-custom">
                    <i class="fas fa-users me-2"></i>View Full Team
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section-pad" style="background: var(--gray-light);">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="badge-section">TESTIMONIALS</span>
                <h2>What Our Customers Say</h2>
                <p class="subtitle">Watch real video stories from people who trust DTEHM for their health and wellness</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="video-card">
                        <div class="video-embed">
                            <iframe src="https://www.youtube.com/embed/J9YJ_6Qc4Rw" title="Customer Testimonial 1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="video-card">
                        <div class="video-embed">
                            <iframe src="https://www.youtube.com/embed/oeDoHyWh7QI" title="Customer Testimonial 2" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="video-card">
                        <div class="video-embed">
                            <iframe src="https://www.youtube.com/embed/1raoRrxTuPg" title="Customer Testimonial 3" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="testimonials.php" class="btn-outline-custom">
                    <i class="fas fa-play-circle me-2"></i>View All Testimonials
                </a>
            </div>
        </div>
    </section>

    <!-- Latest News -->
    <?php if (!empty($latestNews)): ?>
    <section id="news" class="section-pad">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">LATEST UPDATES</span>
                <h2>News & Articles</h2>
                <p class="subtitle">Stay informed about our activities and community impact</p>
            </div>
            <div class="row g-4">
                <?php foreach ($latestNews as $news): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="news-card">
                        <?php if (!empty($news['featured_image'])): 
                            $newsImgPath = $news['featured_image'];
                            if (strpos($newsImgPath, '/') === false) {
                                $newsImgPath = 'news/' . $newsImgPath;
                            }
                        ?>
                        <div class="news-image">
                            <img src="uploads/<?php echo htmlspecialchars($newsImgPath); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <?php endif; ?>
                        <div class="news-content">
                            <div class="news-meta">
                                <span><i class="far fa-calendar me-1"></i><?php echo date('M d, Y', strtotime($news['published_at'])); ?></span>
                            </div>
                            <h4><a href="news-detail.php?id=<?php echo $news['id']; ?>"><?php echo htmlspecialchars($news['title']); ?></a></h4>
                            <p style="color: var(--gray-text); font-size: 0.95rem;">
                                <?php echo htmlspecialchars(substr(strip_tags($news['content'] ?? ''), 0, 120)); ?>...
                            </p>
                            <a href="news-detail.php?id=<?php echo $news['id']; ?>" style="color: var(--primary-blue); font-weight: 600; text-decoration: none; font-size: 0.9rem;">
                                Read More <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-4">
                <a href="news.php" class="btn-outline-custom">
                    View All News <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Upcoming Events -->
    <?php if (!empty($upcomingEvents)): ?>
    <section class="section-pad" style="background: var(--gray-light);">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">UPCOMING EVENTS</span>
                <h2>Join Our Events</h2>
                <p class="subtitle">Participate in health awareness campaigns and community gatherings</p>
            </div>
            <div class="row g-4">
                <?php foreach ($upcomingEvents as $event): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card" style="padding: 0; overflow: hidden; border-radius: 12px;">
                        <?php if (!empty($event['event_image'])): ?>
                        <div style="height: 200px; overflow: hidden;">
                            <img src="uploads/<?php echo htmlspecialchars($event['event_image']); ?>" alt="<?php echo htmlspecialchars($event['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <?php endif; ?>
                        <div style="padding: 1.5rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                                <div style="background: var(--primary-blue); color: var(--white); padding: 0.5rem 0.75rem; border-radius: 8px; text-align: center; min-width: 55px;">
                                    <div style="font-size: 1.25rem; font-weight: 800; line-height: 1;"><?php echo date('d', strtotime($event['start_datetime'])); ?></div>
                                    <div style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px;"><?php echo strtoupper(date('M', strtotime($event['start_datetime']))); ?></div>
                                </div>
                                <div>
                                    <h4 style="margin: 0; font-size: 1.1rem; line-height: 1.3;"><?php echo htmlspecialchars($event['title']); ?></h4>
                                    <?php if (!empty($event['venue_name'])): ?>
                                    <p style="margin: 0; font-size: 0.85rem; color: var(--gray-text);"><i class="fas fa-map-marker-alt me-1" style="color: var(--primary-green);"></i><?php echo htmlspecialchars($event['venue_name']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <p style="color: var(--gray-text); font-size: 0.9rem; margin-bottom: 1rem;">
                                <?php echo htmlspecialchars(substr(strip_tags($event['description'] ?? ''), 0, 100)); ?>...
                            </p>
                            <a href="event-detail.php?id=<?php echo $event['id']; ?>" class="btn-outline-custom" style="font-size: 0.85rem; padding: 0.5rem 1.2rem;">
                                View Details <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-4">
                <a href="events.php" class="btn-primary-custom">
                    View All Events <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- CTA Section -->
    <section id="cta" class="section-pad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center" data-aos="zoom-in">
                    <div style="display: inline-flex; align-items: center; justify-content: center; width: 70px; height: 70px; background: rgba(4,160,40,0.15); border-radius: 20px; margin-bottom: 1.5rem;">
                        <i class="fas fa-heartbeat" style="font-size: 1.8rem; color: var(--primary-green);"></i>
                    </div>
                    <h2 class="section-heading" style="font-size: 2.5rem; color: var(--white);">Join DTEHM Today</h2>
                    <p style="font-size: 1.15rem; color: rgba(255,255,255,0.9); line-height: 1.7; margin-bottom: 2.5rem;">
                        Become a member of DTEHM Health Ministries. Access natural health products, 
                        insurance coverage, investment opportunities, and earn through our referral network.
                    </p>
                    <div class="cta-inline-btns" style="justify-content: center;">
                        <a href="https://play.google.com/store/apps/details?id=com.dtehm.insurance" target="_blank" rel="noopener noreferrer" class="btn-green-custom" style="padding: 0.9rem 2.5rem; font-size: 1rem;">
                            <i class="fab fa-google-play me-2"></i>Get the App
                        </a>
                        <a href="contact.php" style="display: inline-block; background: transparent; color: var(--white); border: 2px solid rgba(255,255,255,0.4); padding: 0.9rem 2.5rem; font-weight: 600; border-radius: 8px; text-decoration: none; transition: all 0.4s; font-size: 1rem;" onmouseover="this.style.background='var(--white)'; this.style.color='var(--primary-blue)'; this.style.borderColor='var(--white)'" onmouseout="this.style.background='transparent'; this.style.color='var(--white)'; this.style.borderColor='rgba(255,255,255,0.4)'">
                            <i class="fas fa-envelope me-2"></i>Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
