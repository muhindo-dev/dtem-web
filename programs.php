<?php 
$currentPage = 'programs';
include 'config.php';
include 'functions.php';

// Get settings
$siteShortName = getSetting('site_short_name', 'DTEHM');
$siteName = getSetting('site_name', 'DTEHM Health Ministries');
$siteDescription = getSetting('site_description', '');

$pageTitle = 'Our Programs';
$pageDescription = 'Explore ' . $siteShortName . ' comprehensive programs supporting orphaned children through education, welfare, development, agriculture, and community engagement.';
include 'includes/header.php'; 
?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Our Programs</h1>
            <p>Explore DTEHM services and programs</p>
        </div>
    </div>

    <!-- Programs -->
    <section>
        <div class="container">
            <div class="section-title">
                <span class="badge-section">WHAT WE DO</span>
                <h2>Investing in Children, Investing in the Future</h2>
                <p class="subtitle">When children are supported early, they grow into confident, capable adults who transform their communities</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="program-card">
                        <div class="program-icon"><i class="fas fa-graduation-cap"></i></div>
                        <h3>Education Support</h3>
                        <p>Education was not guaranteed for many children in Kasese — it is something they have to fight for every day. We ensure every child has access to quality education, school supplies, and academic support so they never have to drop out.</p>
                        <ul style="margin-top: 1.5rem; padding-left: 1.5rem;">
                            <li>School fees and supplies</li>
                            <li>Uniforms and books</li>
                            <li>Academic tutoring</li>
                            <li>Career guidance</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="program-card">
                        <div class="program-icon"><i class="fas fa-shield-alt"></i></div>
                        <h3>Child Protection</h3>
                        <p>We promote child protection and ensure every child feels safe, loved, and valued. Our programs address the needs of orphaned and vulnerable children who might otherwise grow up feeling forgotten.</p>
                        <ul style="margin-top: 1.5rem; padding-left: 1.5rem;">
                            <li>Safe environment</li>
                            <li>Psychological support</li>
                            <li>Child welfare monitoring</li>
                            <li>Community awareness</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="program-card">
                        <div class="program-icon"><i class="fas fa-utensils"></i></div>
                        <h3>Basic Needs</h3>
                        <p>Many children face hunger and lack basic necessities. We provide nutritious meals, healthcare, clothing, and shelter so children can focus on learning and growing rather than survival.</p>
                        <ul style="margin-top: 1.5rem; padding-left: 1.5rem;">
                            <li>Daily nutritious meals</li>
                            <li>Healthcare access</li>
                            <li>Clothing and personal care</li>
                            <li>Clean water & sanitation</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="program-card">
                        <div class="program-icon"><i class="fas fa-home"></i></div>
                        <h3>Orphanage Care</h3>
                        <p>We provide a loving home environment where children feel secure and cared for. Our facilities are designed to give children the family environment they deserve.</p>
                        <ul style="margin-top: 1.5rem; padding-left: 1.5rem;">
                            <li>Safe housing facilities</li>
                            <li>Family-style care</li>
                            <li>Personal development</li>
                            <li>Life skills training</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="program-card">
                        <div class="program-icon"><i class="fas fa-seedling"></i></div>
                        <h3>Sustainable Projects</h3>
                        <p>We believe charity alone is not enough. We invest in sustainable agriculture projects that help communities care for their children with dignity and create long-term food security.</p>
                        <ul style="margin-top: 1.5rem; padding-left: 1.5rem;">
                            <li>Farming training</li>
                            <li>Food production</li>
                            <li>Income generation</li>
                            <li>Community development</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="program-card">
                        <div class="program-icon"><i class="fas fa-users"></i></div>
                        <h3>Community & Family Support</h3>
                        <p>Strong communities raise strong children. We work alongside families and local leaders to create support systems that last — because every child needs a village.</p>
                        <ul style="margin-top: 1.5rem; padding-left: 1.5rem;">
                            <li>Family counseling</li>
                            <li>Health & wellness support</li>
                            <li>Parent education programs</li>
                            <li>Community partnerships</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section id="cta">
        <div class="container">
            <div class="cta-content">
                <h2>Stand With Our Children</h2>
                <p class="lead" style="font-size: 1.2rem; margin-bottom: 2rem;">Every child deserves a chance. Your support helps us provide love, protection, and opportunity to children who need it most.</p>
                <div class="hero-buttons" style="justify-content: center;">
                    <a href="get-involved.php#donate" class="btn btn-hero btn-hero-primary"><span><i class="fas fa-heart me-2"></i>Give Today</span></a>
                    <a href="get-involved.php#volunteer" class="btn btn-hero btn-hero-outline" style="border-color: var(--primary-black); color: var(--primary-black);"><span>Get Involved</span></a>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
