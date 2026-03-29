<?php 
$currentPage = 'about';
$pageTitle = 'About Us';
$pageDescription = 'Learn about ULFA United Love for All Orphanage Centre, our mission, vision, and the impact we make in Kasese District, Uganda.';
include 'config.php';
include 'functions.php';
include 'includes/header.php';

// Fetch team members
$stmt = $pdo->query("SELECT * FROM team_members WHERE status = 'active' ORDER BY display_order ASC, id ASC");
$teamMembers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get mission and vision from settings (with defaults)
$missionStatement = getSetting('mission_statement', 'To provide love, care, education, and sustainable support to orphaned and vulnerable children, while promoting dignity, protection, and community development in Kasese District, Uganda.');
$visionStatement = getSetting('vision_statement', 'A Uganda where all children are loved, protected, educated, and empowered to reach their full potential and contribute meaningfully to society. We envision a future where no child is left behind simply because of the circumstances of their birth.');
$siteShortName = getSetting('site_short_name', 'ULFA');
$siteName = getSetting('site_name', 'United Love for All');
$siteDescription = getSetting('site_description', 'ULFA (United Love for All) Orphanage Centre was founded in Kasese District, Uganda, to ensure that orphaned and vulnerable children do not grow up feeling forgotten or unloved.');
$foundingYear = getSetting('founding_year', '');
$contactCity = getSetting('contact_city', 'Kasese');
$contactCountry = getSetting('contact_country', 'Uganda');
$founderName = getSetting('founder_name', 'Muadhi Abubakar');
$founderTitle = getSetting('founder_title', 'Founder & Executive Director');
?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>About <?php echo htmlspecialchars($siteShortName); ?></h1>
            <p>Discover our story, mission, and the lives we're transforming</p>
        </div>
    </div>

    <!-- Mission & Vision -->
    <section id="mission">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">WHO WE ARE</span>
                <h2>Our Mission & Vision</h2>
                <p class="subtitle">Guided by love, driven by purpose</p>
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

    <!-- Our Story -->
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <span class="badge-section" style="margin-bottom: 1rem; display: inline-block;">OUR STORY</span>
                    <h2 class="mb-4">Why ULFA Orphanage Centre Was Founded</h2>
                    
                    <p style="font-size: 1.05rem; line-height: 1.9; color: var(--gray-text); margin-bottom: 1.25rem;">
                        <strong>United Love for All (ULFA)</strong> Orphanage Centre was founded in Kasese District, Uganda, because our founder knows what it means to grow up without security, support, or certainty about tomorrow.
                    </p>
                    
                    <p style="font-size: 1.05rem; line-height: 1.9; color: var(--gray-text); margin-bottom: 1.25rem;">
                        Growing up in a community where many children struggle to stay in school due to poverty, long distances, and lack of basic necessities, our founder experienced firsthand the struggles that many children still face today—<em>lack of school fees, long distances to school, hunger, and the constant fear of dropping out of education</em>.
                    </p>
                    
                    <p style="font-size: 1.05rem; line-height: 1.9; color: var(--gray-text); margin-bottom: 1.25rem;">
                        These experiences shaped a purpose: <strong>to ensure that orphaned and vulnerable children do not face these struggles alone</strong>. ULFA exists to provide love, care, education, and protection, while building sustainable solutions that help families and communities support their children with dignity.
                    </p>
                    
                    <div style="background: linear-gradient(135deg, var(--primary-yellow) 0%, #ffb300 100%); padding: 1.5rem; border-radius: 8px; margin-top: 1.5rem;">
                        <p style="font-size: 1.1rem; line-height: 1.8; color: var(--primary-black); margin: 0; font-weight: 500;">
                            <i class="fas fa-quote-left" style="margin-right: 0.5rem; opacity: 0.7;"></i>
                            When children are supported early, they grow into confident, capable adults who can transform their communities. <strong>ULFA is not just an organization—it is a promise that no child should be forgotten.</strong>
                            <i class="fas fa-quote-right" style="margin-left: 0.5rem; opacity: 0.7;"></i>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div style="background: var(--light-yellow); padding: 2.5rem; border-left: 4px solid var(--primary-yellow);">
                        <h3 class="mb-4">Our Core Beliefs</h3>
                        <ul style="list-style: none; padding: 0;">
                            <li style="margin-bottom: 1.25rem; padding-left: 2rem; position: relative;">
                                <i class="fas fa-heart" style="position: absolute; left: 0; top: 0; color: var(--primary-black); font-size: 1.1rem;"></i>
                                <strong>Love & Dignity:</strong> Every child deserves to feel loved, valued, and respected
                            </li>
                            <li style="margin-bottom: 1.25rem; padding-left: 2rem; position: relative;">
                                <i class="fas fa-shield-alt" style="position: absolute; left: 0; top: 0; color: var(--primary-black); font-size: 1.1rem;"></i>
                                <strong>Protection:</strong> Child safety and wellbeing is our highest priority
                            </li>
                            <li style="margin-bottom: 1.25rem; padding-left: 2rem; position: relative;">
                                <i class="fas fa-graduation-cap" style="position: absolute; left: 0; top: 0; color: var(--primary-black); font-size: 1.1rem;"></i>
                                <strong>Empowerment:</strong> Education transforms lives and builds futures
                            </li>
                            <li style="margin-bottom: 1.25rem; padding-left: 2rem; position: relative;">
                                <i class="fas fa-seedling" style="position: absolute; left: 0; top: 0; color: var(--primary-black); font-size: 1.1rem;"></i>
                                <strong>Sustainability:</strong> We invest in long-term solutions, not just charity
                            </li>
                            <li style="padding-left: 2rem; position: relative;">
                                <i class="fas fa-hands-helping" style="position: absolute; left: 0; top: 0; color: var(--primary-black); font-size: 1.1rem;"></i>
                                <strong>Community:</strong> Together, we can ensure no child is left behind
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact -->
    <section id="impact">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">OUR IMPACT</span>
                <h2>Transforming Lives Daily</h2>
                <p class="subtitle">Real numbers, real impact, real change</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="impact-card">
                        <div class="impact-icon"><i class="fas fa-child"></i></div>
                        <div class="impact-number">112+</div>
                        <div class="impact-label">Children Helped</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="impact-card">
                        <div class="impact-icon"><i class="fas fa-graduation-cap"></i></div>
                        <div class="impact-number">20+</div>
                        <div class="impact-label">Students Educated</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="impact-card">
                        <div class="impact-icon"><i class="fas fa-calendar-alt"></i></div>
                        <div class="impact-number">3+</div>
                        <div class="impact-label">Years of Service</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Founder's Message -->
    <section id="founder" style="background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 255, 255, 1) 100%);">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">FOUNDER'S MESSAGE</span>
                <h2>A Word From Our Founder</h2>
                <p class="subtitle">The heart and vision behind ULFA</p>
            </div>
            <div class="row align-items-center g-4">
                <div class="col-lg-4 text-center">
                    <div style="border-left: 4px solid var(--primary-yellow); padding: 1.5rem; background: #fff;">
                        <div style="width: 180px; height: 180px; border-radius: 50%; overflow: hidden; margin: 0 auto 1.5rem; border: 4px solid var(--primary-yellow);">
                            <img src="uploads/team/muadhi.jpg" alt="Muadhi Abubakar" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--primary-black); margin-bottom: 0.5rem;">Muadhi Abubakar</h3>
                        <p style="color: var(--primary-yellow); font-weight: 600; font-size: 1rem; margin: 0;">Founder & Director</p>
                        <p style="color: #666; font-size: 0.9rem; margin-top: 0.5rem;">United Love for All (ULFA) Orphanage Centre</p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div style="border-left: 4px solid var(--primary-yellow); padding-left: 2rem;">
                        <p style="font-size: 1.05rem; line-height: 1.9; color: var(--gray-text); margin-bottom: 1.25rem;">I was born and raised in a humble community in Kasese District, Uganda. Growing up, I experienced firsthand the struggles that many children still face today—lack of school fees, long distances to school, hunger, and the constant fear of dropping out of education. Education for me was not guaranteed; it was something I had to fight for every single day.</p>
                        
                        <p style="font-size: 1.05rem; line-height: 1.9; color: var(--gray-text); margin-bottom: 1.25rem;">There were times when attending school meant completing household chores first, walking long distances barefoot, and sharing limited learning materials. Yet, despite these challenges, I learned an important lesson early in life: <strong>when children are supported with love, dignity, and opportunity, their lives can change forever.</strong></p>
                        
                        <p style="font-size: 1.05rem; line-height: 1.9; color: var(--gray-text); margin-bottom: 1.25rem;">ULFA was born from that belief. This foundation exists to ensure that orphaned and vulnerable children do not grow up feeling forgotten or unloved.</p>
                        
                        <p style="font-size: 1.05rem; line-height: 1.9; color: var(--gray-text); margin-bottom: 1.25rem;">At ULFA, we believe that charity alone is not enough. We believe in <strong>empowerment, protection, and long-term solutions</strong>. That is why we support education, provide basic needs, promote child protection, and invest in sustainable projects that help communities care for their children with dignity.</p>
                        
                        <p style="font-size: 1.05rem; line-height: 1.9; color: var(--gray-text); margin-bottom: 1.25rem;">Every child we serve is not just a beneficiary—they are a future leader, a future parent, and a future contributor to society. <strong>When we invest in children, we invest in the future of our nation.</strong></p>
                        
                        <div style="background: linear-gradient(135deg, var(--primary-yellow) 0%, #ffb300 100%); padding: 1.25rem 1.5rem; border-radius: 8px; margin-bottom: 1.25rem;">
                            <p style="font-size: 1.1rem; line-height: 1.8; color: var(--primary-black); margin: 0; font-weight: 500;">
                                <i class="fas fa-quote-left" style="margin-right: 0.5rem; opacity: 0.7;"></i>
                                Together, through United Love for All (ULFA), we can ensure that no child is left behind simply because of the circumstances of their birth.
                                <i class="fas fa-quote-right" style="margin-left: 0.5rem; opacity: 0.7;"></i>
                            </p>
                        </div>
                        
                        <p style="font-size: 1.1rem; color: var(--primary-black); font-weight: 700; margin: 0;">— Muadhi Abubakar</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section id="team">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">MEET OUR TEAM</span>
                <h2>The People Behind <?php echo htmlspecialchars($siteShortName); ?></h2>
                <p class="subtitle">Dedicated individuals committed to changing lives</p>
            </div>
            <?php if (empty($teamMembers)): ?>
                <div class="text-center" style="padding: 3rem 0;">
                    <p style="color: #666;">Our team information will be available soon.</p>
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($teamMembers as $member): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="team-member-card" style="border: 2px solid var(--primary-black); border-radius: 0; overflow: hidden; background: #fff; transition: transform 0.3s;">
                            <?php if ($member['photo']): ?>
                            <div style="height: 280px; overflow: hidden; position: relative;">
                                <img src="uploads/<?php echo htmlspecialchars($member['photo']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <?php else: ?>
                            <div style="height: 280px; background: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user" style="font-size: 4rem; color: #ddd;"></i>
                            </div>
                            <?php endif; ?>
                            <div style="padding: 2rem; text-align: center;">
                                <h4 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--primary-black);">
                                    <?php echo htmlspecialchars($member['name']); ?>
                                </h4>
                                <p style="color: var(--primary-yellow); font-weight: 600; font-size: 1rem; margin-bottom: 0.25rem;">
                                    <?php echo htmlspecialchars($member['position']); ?>
                                </p>
                                <?php if ($member['department']): ?>
                                <p style="color: #999; font-size: 0.9rem; margin-bottom: 1rem;">
                                    <?php echo htmlspecialchars($member['department']); ?>
                                </p>
                                <?php endif; ?>
                                <?php if ($member['bio']): ?>
                                <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem;">
                                    <?php echo htmlspecialchars(strlen($member['bio']) > 150 ? substr($member['bio'], 0, 150) . '...' : $member['bio']); ?>
                                </p>
                                <?php endif; ?>
                                <?php if ($member['email'] || $member['phone'] || $member['linkedin'] || $member['twitter']): ?>
                                <div style="display: flex; justify-content: center; gap: 0.75rem; margin-top: 1rem; padding-top: 1rem; border-top: 2px solid #e9ecef;">
                                    <?php if ($member['email']): ?>
                                    <a href="mailto:<?php echo htmlspecialchars($member['email']); ?>" style="display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border: 2px solid var(--primary-black); background: transparent; color: var(--primary-black); text-decoration: none; transition: all 0.3s;">
                                        <i class="far fa-envelope"></i>
                                    </a>
                                    <?php endif; ?>
                                    <?php if ($member['phone']): ?>
                                    <a href="tel:<?php echo htmlspecialchars($member['phone']); ?>" style="display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border: 2px solid var(--primary-black); background: transparent; color: var(--primary-black); text-decoration: none; transition: all 0.3s;">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                    <?php endif; ?>
                                    <?php if ($member['linkedin']): ?>
                                    <a href="<?php echo htmlspecialchars($member['linkedin']); ?>" target="_blank" style="display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border: 2px solid var(--primary-black); background: transparent; color: var(--primary-black); text-decoration: none; transition: all 0.3s;">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <?php endif; ?>
                                    <?php if ($member['twitter']): ?>
                                    <a href="<?php echo htmlspecialchars($member['twitter']); ?>" target="_blank" style="display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border: 2px solid var(--primary-black); background: transparent; color: var(--primary-black); text-decoration: none; transition: all 0.3s;">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <style>
    .team-member-card:hover {
        transform: translateY(-5px);
    }
    .team-member-card a:hover {
        background: var(--primary-yellow);
        border-color: var(--primary-yellow);
    }
    </style>

    <!-- CTA -->
    <section id="cta">
        <div class="container">
            <div class="cta-content">
                <h2>Join Our Mission</h2>
                <p class="lead" style="font-size: 1.2rem; margin-bottom: 2rem;">Together, we can ensure no child is forgotten. Your support matters.</p>
                <div class="hero-buttons" style="justify-content: center;">
                    <a href="get-involved.php#donate" class="btn btn-hero btn-hero-primary"><span><i class="fas fa-heart me-2"></i>Donate</span></a>
                    <a href="contact.php" class="btn btn-hero btn-hero-outline" style="border-color: var(--primary-black); color: var(--primary-black);"><span>Contact Us</span></a>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
