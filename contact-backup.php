<?php 
$currentPage = 'contact';
$pageTitle = 'Contact Us';
$pageDescription = 'Get in touch with ULFA. We\'re here to answer your questions and help you get involved.';
include 'includes/header.php'; 

// Get contact settings
$contactAddress = getSetting('contact_address', 'P.O. Box 113004, Mpondwe');
$contactCity = getSetting('contact_city', 'Kasese');
$contactCountry = getSetting('contact_country', 'Uganda');
$contactPhone = getSetting('contact_phone', '+256757689986');
$contactPhoneAlt = getSetting('contact_phone_alt');
$contactEmail = getSetting('contact_email', 'ulfaorphanage@gmail.com');
$siteAddress = getSetting('site_address', 'Mpondwe Lhubiriha Town Council, Kasese District, Uganda');
$officeHours = getSetting('office_hours', 'Monday - Friday: 8:00 AM - 5:00 PM');
$officeHoursWeekend = getSetting('office_hours_weekend', 'Saturday: 9:00 AM - 2:00 PM');
$googleMapsEmbed = getSetting('google_maps_embed');
$siteShortName = getSetting('site_short_name', 'ULFA');
$siteName = getSetting('site_name', 'United Love for All');

// Validate Google Maps embed - only allow safe iframe from Google
function sanitizeGoogleMapsEmbed($embed) {
    if (empty($embed)) return '';
    // Check if it contains a valid Google Maps iframe
    if (preg_match('/<iframe[^>]+src=["\']https:\/\/(www\.)?google\.com\/maps\/embed[^"\']*["\'][^>]*>.*?<\/iframe>/is', $embed, $match)) {
        return $match[0];
    }
    return '';
}
$googleMapsEmbed = sanitizeGoogleMapsEmbed($googleMapsEmbed);
?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Contact Us</h1>
            <p>Have questions or want to support our mission? We'd love to connect with you.</p>
        </div>
    </div>

    <!-- Contact Section -->
    <section>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="contact-item">
                        <div class="contact-item-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <h5>Visit Us</h5>
                            <p><?php echo nl2br(htmlspecialchars($contactAddress)); ?></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <h5>Call Us</h5>
                            <p>
                                <a href="<?php echo getPhoneLink($contactPhone); ?>" style="color: inherit; text-decoration: none;">Main: <?php echo htmlspecialchars($contactPhone); ?></a>
                                <?php if ($contactPhoneAlt): ?>
                                <br><a href="<?php echo getPhoneLink($contactPhoneAlt); ?>" style="color: inherit; text-decoration: none;">Mobile: <?php echo htmlspecialchars($contactPhoneAlt); ?></a>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <h5>Email Us</h5>
                            <p><a href="mailto:<?php echo htmlspecialchars($contactEmail); ?>" style="color: inherit; text-decoration: none;"><?php echo htmlspecialchars($contactEmail); ?></a></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon"><i class="fas fa-clock"></i></div>
                        <div>
                            <h5>Office Hours</h5>
                            <p>
                                <?php echo htmlspecialchars($officeHours); ?>
                                <?php if ($officeHoursWeekend): ?>
                                <br><?php echo htmlspecialchars($officeHoursWeekend); ?>
                                <?php endif; ?>
                                <br>Sunday: Closed
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div style="background: var(--white); padding: 3rem; border: 3px solid var(--primary-black);">
                        <h2 class="mb-4">Send Us a Message</h2>
                        <div id="contactAlert"></div>
                        <form id="contactForm" class="contact-form">
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
                                        <option value="">Select Subject *</option>
                                        <option value="donation">Make a Donation</option>
                                        <option value="volunteer">Become a Volunteer</option>
                                        <option value="sponsor">Sponsor a Child</option>
                                        <option value="general">General Inquiry</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <textarea name="message" class="form-control" rows="6" placeholder="Your Message *" required></textarea>
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

    <!-- Map Section -->
    <section style="background: var(--gray-light);">
        <div class="container">
            <div class="section-title">
                <span class="badge-section">FIND US</span>
                <h2>Our Location</h2>
                <p class="subtitle">Visit us at our centre in <?php echo htmlspecialchars($contactCity); ?></p>
            </div>
            <?php if ($googleMapsEmbed): ?>
            <div style="background: var(--white); padding: 1rem; border: 3px solid var(--primary-black);">
                <?php echo $googleMapsEmbed; ?>
            </div>
            <?php else: ?>
            <div style="background: var(--white); padding: 3rem; border: 3px solid var(--primary-black); text-align: center;">
                <i class="fas fa-map-marked-alt" style="font-size: 5rem; color: var(--primary-yellow); margin-bottom: 2rem;"></i>
                <h3 class="mb-3"><?php echo htmlspecialchars($siteShortName); ?></h3>
                <p style="font-size: 1.1rem; color: var(--gray-text); max-width: 600px; margin: 0 auto;">
                    <?php echo nl2br(htmlspecialchars($contactAddress)); ?>
                </p>
                <div class="mt-4">
                    <a href="https://maps.google.com/maps?q=<?php echo urlencode($contactAddress); ?>" target="_blank" class="btn btn-hero btn-hero-primary"><span><i class="fas fa-map-marker-alt me-2"></i>Get Directions</span></a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- FAQ Section -->
    <section>
        <div class="container">
            <div class="section-title">
                <span class="badge-section">FAQ</span>
                <h2>Frequently Asked Questions</h2>
                <p class="subtitle">Quick answers to common questions</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="program-card">
                        <h4 style="color: var(--primary-yellow); margin-bottom: 1rem;"><i class="fas fa-question-circle me-2"></i>How can I donate?</h4>
                        <p>You can donate through our website contact form, bank transfer, or mobile money. Visit our <a href="get-involved.php#donate" style="color: var(--primary-yellow);">Get Involved</a> page for more details.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="program-card">
                        <h4 style="color: var(--primary-yellow); margin-bottom: 1rem;"><i class="fas fa-question-circle me-2"></i>Can I visit the orphanage?</h4>
                        <p>Yes! We welcome visitors. Please contact us in advance to schedule your visit and ensure we can provide you with a proper tour.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="program-card">
                        <h4 style="color: var(--primary-yellow); margin-bottom: 1rem;"><i class="fas fa-question-circle me-2"></i>How do I become a volunteer?</h4>
                        <p>Fill out our contact form selecting "Become a Volunteer" or email us directly. We'll guide you through our volunteer application and training process.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="program-card">
                        <h4 style="color: var(--primary-yellow); margin-bottom: 1rem;"><i class="fas fa-question-circle me-2"></i>Is child sponsorship available?</h4>
                        <p>Absolutely! Our child sponsorship program allows you to directly support a specific child's education, health, and wellbeing. <a href="get-involved.php#sponsor" style="color: var(--primary-yellow);">Learn more</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section id="cta">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Make a Difference?</h2>
                <p class="lead" style="font-size: 1.2rem; margin-bottom: 2rem;">Your journey to transforming lives starts here</p>
                <div class="hero-buttons" style="justify-content: center;">
                    <a href="get-involved.php#donate" class="btn btn-hero btn-hero-primary"><span><i class="fas fa-heart me-2"></i>Donate</span></a>
                    <a href="get-involved.php#volunteer" class="btn btn-hero btn-hero-outline" style="border-color: var(--primary-black); color: var(--primary-black);"><span>Volunteer Today</span></a>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
