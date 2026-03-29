<?php 
$currentPage = 'get-involved';
include 'config.php';
include 'functions.php';

// Get settings
$siteShortName = getSetting('site_short_name', 'DTEHM');
$siteName = getSetting('site_name', 'DTEHM Health Ministries');
$contactCity = getSetting('contact_city', 'Kasese');
$contactCountry = getSetting('contact_country', 'Uganda');
$contactPhone = getSetting('contact_phone', '+256757689986');
$contactEmail = getSetting('contact_email', 'dtehmhealth@gmail.com');
$contactAddress = getSetting('site_address', 'Mpondwe Lhubiriha Town Council, Kasese District, Uganda');

$pageTitle = 'Get Involved';
$pageDescription = 'Join ' . $siteShortName . ' mission to transform lives. Donate, volunteer, or partner with us to support orphaned children in ' . $contactCountry . '.';
include 'includes/header.php'; 
?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Get Involved</h1>
            <p>Join our mission and make a difference in your community</p>
        </div>
    </div>

    <!-- Get Involved Options -->
    <section id="get-involved">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">JOIN US</span>
                <h2>Stand With The Children</h2>
                <p class="subtitle">Your support gives children hope, restores dignity to families, and builds stronger communities</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="involvement-card" id="donate">
                        <div class="involvement-icon"><i class="fas fa-heart"></i></div>
                        <h4>Donate</h4>
                        <p>Every child deserves love, education, and a chance at a better future. Your financial support provides food, education, healthcare, and protection to vulnerable children.</p>
                        <div style="margin: 1.5rem 0;">
                            <h5 style="color: var(--white); margin-bottom: 1rem;">Your Donation Provides:</h5>
                            <ul style="text-align: left;">
                                <li>Education support (fees, books, uniforms)</li>
                                <li>Daily nutritious meals</li>
                                <li>Healthcare and protection</li>
                                <li>Safe shelter and care</li>
                            </ul>
                        </div>
                        <a href="donation-step1.php" class="btn-involvement">Donate</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="involvement-card" id="volunteer">
                        <div class="involvement-icon"><i class="fas fa-hand-holding-heart"></i></div>
                        <h4>Volunteer</h4>
                        <p>Share your time, skills, and passion with children who need support. When children are supported early, they grow into confident, capable adults who transform their communities.</p>
                        <div style="margin: 1.5rem 0;">
                            <h5 style="color: var(--white); margin-bottom: 1rem;">Volunteer Opportunities:</h5>
                            <ul style="text-align: left;">
                                <li>Teaching & tutoring</li>
                                <li>Child care support</li>
                                <li>Skills training</li>
                                <li>Community outreach</li>
                            </ul>
                        </div>
                        <a href="#contact-section" class="btn-involvement">Apply to Volunteer</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sponsor a Child -->
    <section id="sponsor">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="mb-4">Sponsor a Child</h2>
                    <p style="font-size: 1.1rem; line-height: 1.8; color: var(--gray-text);">Child sponsorship is one of the most direct and personal ways to make a difference. Your monthly support provides a child with education, healthcare, nutrition, and a safe home environment.</p>
                    <div style="background: var(--light-yellow); padding: 2rem; border: 2px solid var(--primary-blue); margin: 2rem 0;">
                        <h4 class="mb-3">What Your Sponsorship Provides:</h4>
                        <ul style="font-size: 1.05rem; line-height: 2;">
                            <li><i class="fas fa-check" style="color: var(--white); margin-right: 0.5rem;"></i>Full education support (fees, books, uniforms)</li>
                            <li><i class="fas fa-check" style="color: var(--white); margin-right: 0.5rem;"></i>Three nutritious meals daily</li>
                            <li><i class="fas fa-check" style="color: var(--white); margin-right: 0.5rem;"></i>Regular healthcare and medical care</li>
                            <li><i class="fas fa-check" style="color: var(--white); margin-right: 0.5rem;"></i>Safe housing and personal care</li>
                            <li><i class="fas fa-check" style="color: var(--white); margin-right: 0.5rem;"></i>Recreational activities and life skills training</li>
                        </ul>
                    </div>
                    <a href="#contact-section" class="btn btn-hero btn-hero-primary"><span>Sponsor a Child Today</span></a>
                </div>
                <div class="col-lg-6">
                    <div class="program-card">
                        <h3 class="text-center mb-4">Sponsorship Levels</h3>
                        <div style="border-bottom: 2px solid var(--gray-border); padding-bottom: 1.5rem; margin-bottom: 1.5rem;">
                            <h4 style="color: var(--white);">$50/month</h4>
                            <p><strong>Basic Support</strong><br>Education, meals, and basic healthcare</p>
                        </div>
                        <div style="border-bottom: 2px solid var(--gray-border); padding-bottom: 1.5rem; margin-bottom: 1.5rem;">
                            <h4 style="color: var(--white);">$100/month</h4>
                            <p><strong>Full Support</strong><br>Complete care including housing and specialized programs</p>
                        </div>
                        <div>
                            <h4 style="color: var(--white);">$200/month</h4>
                            <p><strong>Premium Support</strong><br>Comprehensive care plus advanced education and skills training</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section for Forms -->
    <section id="contact-section">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">GET IN TOUCH</span>
                <h2>Ready to Make a Difference?</h2>
                <p class="subtitle">Contact us to donate, volunteer, or partner with DTEHM</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="contact-item">
                        <div class="contact-item-icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <h5>Call Us</h5>
                            <p style="margin: 0;"><?php echo htmlspecialchars($contactPhone); ?></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <h5>Email Us</h5>
                            <p style="margin: 0;"><?php echo htmlspecialchars($contactEmail); ?></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <h5>Visit Us</h5>
                            <p style="margin: 0;"><?php echo htmlspecialchars($contactAddress); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="contact-form">
                        <div id="contactAlert"></div>
                        <form id="contactForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name *" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Your Email *" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="tel" name="phone" class="form-control" placeholder="Your Phone *" required>
                                </div>
                                <div class="col-md-6">
                                    <select name="subject" class="form-control" required>
                                        <option value="">Select Interest *</option>
                                        <option value="donation">Make a Donation</option>
                                        <option value="volunteer">Become a Volunteer</option>
                                        <option value="sponsor">Sponsor a Child</option>
                                        <option value="general">General Inquiry</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <textarea name="message" class="form-control" rows="5" placeholder="Your Message *" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" id="submitBtn" class="btn-submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
