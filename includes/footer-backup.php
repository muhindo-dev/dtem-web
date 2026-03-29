<?php
// Load site settings if not already loaded
if (!function_exists('getSetting')) {
    require_once __DIR__ . '/../functions.php';
}

// Get commonly used settings for footer
$siteName = getSetting('site_name', 'United Love for All (ULFA)');
$siteShortName = getSetting('site_short_name', 'ULFA');
$siteDescription = getSetting('site_description', 'United Love for All is dedicated to providing comprehensive care, education, and sustainable support to orphaned and vulnerable children in Kasese District, Uganda.');
$footerAbout = getSetting('footer_about', $siteDescription);
$logoIconClass = getSetting('logo_icon_class', 'fas fa-hands-helping');
$contactEmail = getSetting('contact_email', 'ulfaorphanage@gmail.com');
$contactPhone = getSetting('contact_phone', '+256757689986');
$contactAddress = getSetting('contact_address', 'Kasese District, Uganda');
$footerText = getSetting('footer_text', 'All rights reserved.');
$developerName = getSetting('developer_name', 'Muhindo Mubaraka');
$developerUrl = getSetting('developer_url', '#');
$whatsappNumber = getSetting('whatsapp_number');
$whatsappEnabled = getSetting('enable_whatsapp_chat') == '1';
$whatsappMessage = getSetting('whatsapp_default_message', 'Hello, I would like to know more about ULFA.');
$customFooterCode = getSetting('custom_footer_code');

// Get social links
$socialLinks = getSocialLinks();
?>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-section">
                        <h4><i class="<?php echo htmlspecialchars($logoIconClass); ?> me-2"></i><?php echo htmlspecialchars($siteShortName); ?></h4>
                        <p style="color: rgba(255,255,255,0.8); line-height: 1.8;"><?php echo htmlspecialchars($footerAbout); ?></p>
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
                <div class="col-lg-2 col-md-6">
                    <div class="footer-section">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="programs.php">Programs</a></li>
                            <li><a href="stories.php">Stories</a></li>
                            <li><a href="news.php">News</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <h4>Get Involved</h4>
                        <ul>
                            <li><a href="donation-step1.php">Donate</a></li>
                            <li><a href="get-involved.php#volunteer">Volunteer</a></li>
                            <li><a href="get-involved.php#sponsor">Sponsor a Child</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <h4>Contact</h4>
                        <ul style="list-style: none; padding: 0;">
                            <?php if ($contactAddress): ?>
                            <li style="margin-bottom: 0.8rem; color: rgba(255,255,255,0.8);"><i class="fas fa-map-marker-alt" style="color: var(--primary-yellow); margin-right: 0.5rem;"></i><?php echo htmlspecialchars($contactAddress); ?></li>
                            <?php endif; ?>
                            <?php if ($contactPhone): ?>
                            <li style="margin-bottom: 0.8rem; color: rgba(255,255,255,0.8);"><i class="fas fa-phone" style="color: var(--primary-yellow); margin-right: 0.5rem;"></i><a href="<?php echo getPhoneLink($contactPhone); ?>" style="color: rgba(255,255,255,0.8); text-decoration: none;"><?php echo htmlspecialchars($contactPhone); ?></a></li>
                            <?php endif; ?>
                            <?php if ($contactEmail): ?>
                            <li style="margin-bottom: 0.8rem; color: rgba(255,255,255,0.8);"><i class="fas fa-envelope" style="color: var(--primary-yellow); margin-right: 0.5rem;"></i><a href="mailto:<?php echo htmlspecialchars($contactEmail); ?>" style="color: rgba(255,255,255,0.8); text-decoration: none;"><?php echo htmlspecialchars($contactEmail); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($siteName); ?> | <a href="admin/login.php" style="color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.85rem;"><i class="fas fa-lock me-1"></i>Admin</a></p>
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
        width: 60px;
        height: 60px;
        background: #25D366;
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        z-index: 9999;
        transition: all 0.3s ease;
    }
    .whatsapp-float:hover {
        background: #128C7E;
        color: #fff;
        transform: scale(1.1);
    }
    </style>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        // Lightbox configuration
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': 'Image %1 of %2',
            'disableScrolling': true
        });
    </script>
    
    <?php if ($customFooterCode): ?>
    <!-- Custom Footer Code -->
    <?php echo $customFooterCode; ?>
    <?php endif; ?>
</body>
</html>
