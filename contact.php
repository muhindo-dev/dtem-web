<?php
$currentPage = 'contact';
$pageTitle = 'Contact Us';
include 'config.php';
include 'functions.php';

$siteName = getSetting('site_name', 'DTEHM Health Ministries');
$contactEmail = getSetting('contact_email', 'dtehmhealth@gmail.com');
$contactPhone = getSetting('contact_phone', '+256 782 284788');
$contactPhoneAlt = getSetting('contact_phone_alt', '+256 705 070995');
$contactAddress = getSetting('contact_address', 'Kamaiba Lower, Near SDA Primary School');
$contactCity = getSetting('contact_city', 'Kasese');
$officeHours = getSetting('office_hours', 'Monday - Saturday: 8:00 AM - 6:00 PM');

$pageDescription = 'Contact DTEHM Health Ministries. Reach us at our Kasese headquarters or any of our branch offices.';
include 'includes/header.php';

// Handle form submission
$successMessage = '';
$errorMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateCsrfToken()) {
        $errorMessage = 'Invalid form submission. Please try again.';
    } else {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    if (empty($name) || empty($email) || empty($message)) {
        $errorMessage = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Please enter a valid email address.';
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO contact_inquiries (name, email, phone, subject, message, status, ip_address, created_at) VALUES (?, ?, ?, ?, ?, 'new', ?, NOW())");
            $stmt->execute([$name, $email, $phone, $subject, $message, $_SERVER['REMOTE_ADDR'] ?? null]);
            $successMessage = 'Thank you for your message! We will get back to you soon.';
        } catch (PDOException $e) {
            $errorMessage = 'Sorry, there was an error sending your message. Please try again.';
            error_log("Contact form error: " . $e->getMessage());
        }
    }
    } // end CSRF else
}
?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Contact Us</h1>
            <p>Get in touch with DTEHM Health Ministries. We're here to help.</p>
        </div>
    </div>

    <!-- Contact Section -->
    <section class="section-pad">
        <div class="container">
            <div class="row g-5">
                <!-- Contact Info -->
                <div class="col-lg-5">
                    <h3 style="margin-bottom: 1.5rem;">Get in Touch</h3>
                    <p style="color: var(--gray-text); margin-bottom: 2rem; line-height: 1.7;">
                        Have questions about our products, services, or membership? We'd love to hear from you.
                    </p>
                    
                    <div class="contact-item">
                        <div class="contact-item-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <h5>Head Office</h5>
                            <p><?php echo htmlspecialchars($contactAddress); ?><br><?php echo htmlspecialchars($contactCity); ?>, Uganda</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-item-icon"><i class="fas fa-phone-alt"></i></div>
                        <div>
                            <h5>Phone</h5>
                            <p><a href="<?php echo getPhoneLink($contactPhone); ?>" style="color: var(--gray-text); text-decoration: none;"><?php echo htmlspecialchars($contactPhone); ?></a><br>
                            <a href="<?php echo getPhoneLink($contactPhoneAlt); ?>" style="color: var(--gray-text); text-decoration: none;"><?php echo htmlspecialchars($contactPhoneAlt); ?></a></p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-item-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <h5>Email</h5>
                            <p><a href="mailto:<?php echo htmlspecialchars($contactEmail); ?>" style="color: var(--gray-text); text-decoration: none;"><?php echo htmlspecialchars($contactEmail); ?></a><br>
                            <a href="mailto:nzwendeenostus@gmail.com" style="color: var(--gray-text); text-decoration: none;">nzwendeenostus@gmail.com</a></p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-item-icon"><i class="fas fa-clock"></i></div>
                        <div>
                            <h5>Office Hours</h5>
                            <p><?php echo htmlspecialchars($officeHours); ?><br>Sunday: Closed</p>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div style="background: var(--gray-light); border-radius: 12px; padding: 2.5rem;">
                        <h3 style="margin-bottom: 1.5rem;">Send us a Message</h3>
                        
                        <?php if ($successMessage): ?>
                        <div class="alert alert-custom alert-success" style="display: block;">
                            <i class="fas fa-check-circle me-2"></i><?php echo htmlspecialchars($successMessage); ?>
                        </div>
                        <?php endif; ?>
                        <?php if ($errorMessage): ?>
                        <div class="alert alert-custom alert-error" style="display: block;">
                            <i class="fas fa-exclamation-circle me-2"></i><?php echo htmlspecialchars($errorMessage); ?>
                        </div>
                        <?php endif; ?>
                        
                        <form method="POST" class="contact-form">
                            <?php echo csrfField(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="contact-name" class="visually-hidden">Your Name</label>
                                    <input type="text" id="contact-name" name="name" class="form-control" placeholder="Your Name *" required value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="contact-email" class="visually-hidden">Your Email</label>
                                    <input type="email" id="contact-email" name="email" class="form-control" placeholder="Your Email *" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="contact-phone" class="visually-hidden">Phone Number</label>
                                    <input type="tel" id="contact-phone" name="phone" class="form-control" placeholder="Phone Number" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="contact-subject" class="visually-hidden">Subject</label>
                                    <input type="text" id="contact-subject" name="subject" class="form-control" placeholder="Subject" value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>">
                                </div>
                            </div>
                            <label for="contact-message" class="visually-hidden">Your Message</label>
                            <textarea id="contact-message" name="message" class="form-control" rows="5" placeholder="Your Message *" required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                            <button type="submit" class="btn-submit mt-2">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Branch Offices -->
    <section class="section-pad" style="background: var(--gray-light);">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">OUR BRANCHES</span>
                <h2>Branch Offices</h2>
                <p class="subtitle">Visit any of our branch offices across the Kasese District</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="branch-card">
                        <div class="branch-icon"><i class="fas fa-building"></i></div>
                        <h5>Kasese (Head Office)</h5>
                        <p>Kamaiba Lower, Near SDA Primary School</p>
                        <a href="tel:+256779863165"><i class="fas fa-phone me-1"></i>+256 779 863165</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="branch-card">
                        <div class="branch-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <h5>Bwera</h5>
                        <p>Bwera Town, Kasese District</p>
                        <a href="tel:+256780378906"><i class="fas fa-phone me-1"></i>+256 780 378906</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="branch-card">
                        <div class="branch-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <h5>Rugendabara</h5>
                        <p>Rugendabara, Kasese District</p>
                        <a href="tel:+256785420194"><i class="fas fa-phone me-1"></i>+256 785 420194</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="branch-card">
                        <div class="branch-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <h5>Kisinga</h5>
                        <p>Kisinga Town, Kasese District</p>
                        <a href="tel:+256782639131"><i class="fas fa-phone me-1"></i>+256 782 639131</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
