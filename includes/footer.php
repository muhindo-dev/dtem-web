<?php
// Load site settings if not already loaded
if (!function_exists('getSetting')) {
    require_once __DIR__ . '/../functions.php';
}

// Get commonly used settings for footer
$siteName = getSetting('site_name', 'DTEHM Health Ministries');
$siteShortName = getSetting('site_short_name', 'DTEHM');
$footerAbout = getSetting('footer_about', 'DTEHM Health Ministries promotes holistic health solutions.');
$logoIconClass = getSetting('logo_icon_class', 'fas fa-heartbeat');
$contactEmail = getSetting('contact_email', 'dtehmhealth@gmail.com');
$contactPhone = getSetting('contact_phone', '+256 782 284788');
$contactPhoneAlt = getSetting('contact_phone_alt', '+256 705 070995');
$contactAddress = getSetting('contact_address', 'Kamaiba Lower, Near SDA Primary School');
$contactCity = getSetting('contact_city', 'Kasese');
$footerText = getSetting('footer_text', 'All Rights Reserved Dr Thembo Enostus Health Ministries');
$developerName = getSetting('developer_name', 'TusomeTech');
$developerUrl = getSetting('developer_url', 'https://tusometech.com');
$whatsappNumber = getSetting('whatsapp_number');
$whatsappEnabled = getSetting('enable_whatsapp_chat') == '1';
$whatsappMessage = getSetting('whatsapp_default_message', 'Hello, I would like to know more about DTEHM Health Ministries.');
$customFooterCode = getSetting('custom_footer_code');

// Get social links
$socialLinks = getSocialLinks();
?>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <!-- About Column -->
                <div class="col-lg-4">
                    <div class="footer-section">
                        <h4><i class="<?php echo htmlspecialchars($logoIconClass); ?> me-2" style="color: #04a028;"></i><?php echo htmlspecialchars($siteShortName); ?></h4>
                        <p style="color: rgba(255,255,255,0.7); line-height: 1.8; font-size: 0.95rem;"><?php echo htmlspecialchars($footerAbout); ?></p>
                        <div class="d-flex gap-2 mt-3">
                            <?php if (!empty($socialLinks['facebook'])): ?>
                            <a href="<?php echo htmlspecialchars($socialLinks['facebook']); ?>" class="social-link" target="_blank" rel="noopener" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <?php endif; ?>
                            <?php if (!empty($socialLinks['twitter'])): ?>
                            <a href="<?php echo htmlspecialchars($socialLinks['twitter']); ?>" class="social-link" target="_blank" rel="noopener" title="Twitter/X"><i class="fab fa-twitter"></i></a>
                            <?php endif; ?>
                            <?php if (!empty($socialLinks['instagram'])): ?>
                            <a href="<?php echo htmlspecialchars($socialLinks['instagram']); ?>" class="social-link" target="_blank" rel="noopener" title="Instagram"><i class="fab fa-instagram"></i></a>
                            <?php endif; ?>
                            <?php if (!empty($socialLinks['linkedin'])): ?>
                            <a href="<?php echo htmlspecialchars($socialLinks['linkedin']); ?>" class="social-link" target="_blank" rel="noopener" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <?php endif; ?>
                            <?php if (!empty($socialLinks['youtube'])): ?>
                            <a href="<?php echo htmlspecialchars($socialLinks['youtube']); ?>" class="social-link" target="_blank" rel="noopener" title="YouTube"><i class="fab fa-youtube"></i></a>
                            <?php endif; ?>
                            <?php if (!empty($socialLinks['tiktok'])): ?>
                            <a href="<?php echo htmlspecialchars($socialLinks['tiktok']); ?>" class="social-link" target="_blank" rel="noopener" title="TikTok"><i class="fab fa-tiktok"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-section">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="shop.php">Health Products</a></li>
                            <li><a href="insurance.php">Insurance</a></li>
                            <li><a href="investment.php">Investment</a></li>
                            <li><a href="faq.php">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Get Involved -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-section">
                        <h4>Get Involved</h4>
                        <ul>
                            <li><a href="enroll.php">Join DTEHM</a></li>
                            <li><a href="donation-step1.php">Donate</a></li>
                            <li><a href="events.php">Events</a></li>
                            <li><a href="causes.php">Causes</a></li>
                            <li><a href="get-involved.php">Volunteer</a></li>
                            <li><a href="contact.php">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Contact Info -->
                <div class="col-lg-4">
                    <div class="footer-section">
                        <h4>Contact Us</h4>
                        <?php if ($contactAddress): ?>
                        <div class="footer-contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?php echo htmlspecialchars($contactAddress); ?><?php if ($contactCity): ?>, <?php echo htmlspecialchars($contactCity); ?>, Uganda<?php endif; ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if ($contactPhone): ?>
                        <div class="footer-contact-item">
                            <i class="fas fa-phone"></i>
                            <a href="<?php echo getPhoneLink($contactPhone); ?>"><?php echo htmlspecialchars($contactPhone); ?></a>
                        </div>
                        <?php endif; ?>
                        <?php if ($contactPhoneAlt): ?>
                        <div class="footer-contact-item">
                            <i class="fas fa-phone"></i>
                            <a href="<?php echo getPhoneLink($contactPhoneAlt); ?>"><?php echo htmlspecialchars($contactPhoneAlt); ?></a>
                        </div>
                        <?php endif; ?>
                        <?php if ($contactEmail): ?>
                        <div class="footer-contact-item">
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:<?php echo htmlspecialchars($contactEmail); ?>"><?php echo htmlspecialchars($contactEmail); ?></a>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Branch Offices Summary -->
                        <div style="margin-top: 1.25rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.08);">
                            <p style="color: rgba(255,255,255,0.5); font-size: 0.85rem; margin-bottom: 0.75rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Branch Offices</p>
                            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                                <span style="background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); padding: 0.25rem 0.6rem; border-radius: 4px; font-size: 0.8rem;">Kasese</span>
                                <span style="background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); padding: 0.25rem 0.6rem; border-radius: 4px; font-size: 0.8rem;">Bwera</span>
                                <span style="background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); padding: 0.25rem 0.6rem; border-radius: 4px; font-size: 0.8rem;">Rugendabara</span>
                                <span style="background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); padding: 0.25rem 0.6rem; border-radius: 4px; font-size: 0.8rem;">Kisinga</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($footerText); ?> | Developed by <a href="<?php echo htmlspecialchars($developerUrl); ?>" target="_blank" style="color: #04a028; text-decoration: none;"><?php echo htmlspecialchars($developerName); ?></a> | <a href="admin/login.php" style="color: rgba(255,255,255,0.4); text-decoration: none; font-size: 0.85rem;"><i class="fas fa-lock me-1"></i>Admin</a></p>
            </div>
        </div>
    </footer>

    <?php if ($whatsappEnabled && $whatsappNumber): ?>
    <!-- WhatsApp Floating Button -->
    <a href="<?php echo getWhatsAppLink($whatsappNumber, $whatsappMessage); ?>" class="whatsapp-float" target="_blank" rel="noopener" title="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
    <style>
    .whatsapp-float {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 56px;
        height: 56px;
        background: #25D366;
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        box-shadow: 0 4px 15px rgba(37,211,102,0.4);
        z-index: 9999;
        transition: all 0.3s ease;
    }
    .whatsapp-float:hover {
        background: #128C7E;
        color: #fff;
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(37,211,102,0.5);
    }
    </style>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        if (typeof lightbox !== 'undefined') {
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true,
                'albumLabel': 'Image %1 of %2',
                'disableScrolling': true
            });
        }
    </script>
    
    <?php if ($customFooterCode): ?>
    <?php echo $customFooterCode; ?>
    <?php endif; ?>
</body>
</html>
