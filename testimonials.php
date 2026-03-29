<?php
$currentPage = 'testimonials';
$pageTitle = 'Testimonials';
include 'config.php';
include 'functions.php';

$siteShortName = getSetting('site_short_name', 'DTEHM');
$siteName = getSetting('site_name', 'DTEHM Health Ministries');

$pageDescription = 'Watch real video testimonials from people who have experienced the benefits of ' . $siteShortName . ' natural health products and services.';
include 'includes/header.php';

$videoTestimonials = [
    ['id' => 'J9YJ_6Qc4Rw', 'title' => 'Customer Testimonial'],
    ['id' => 'oeDoHyWh7QI', 'title' => 'Customer Testimonial'],
    ['id' => '1raoRrxTuPg', 'title' => 'Customer Testimonial'],
    ['id' => 'lX-WPpK06us', 'title' => 'Customer Testimonial'],
    ['id' => 'isqe-RGwr-0', 'title' => 'Customer Testimonial'],
    ['id' => '086bFv1LPoY', 'title' => 'Customer Testimonial'],
    ['id' => 'tyW61YkTm3c', 'title' => 'Customer Testimonial'],
];
?>

<!-- Testimonials Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "DTEHM Health Ministries Testimonials",
    "description": "<?php echo htmlspecialchars($pageDescription); ?>",
    "mainEntity": {
        "@type": "ItemList",
        "itemListElement": [
<?php foreach ($videoTestimonials as $index => $video): ?>
            {
                "@type": "VideoObject",
                "position": <?php echo $index + 1; ?>,
                "name": "<?php echo htmlspecialchars($video['title']); ?> <?php echo $index + 1; ?> - DTEHM Health Ministries",
                "description": "Customer testimonial for DTEHM Health Ministries natural health products and services",
                "thumbnailUrl": "https://img.youtube.com/vi/<?php echo htmlspecialchars($video['id']); ?>/maxresdefault.jpg",
                "uploadDate": "2025-01-01",
                "contentUrl": "https://www.youtube.com/watch?v=<?php echo htmlspecialchars($video['id']); ?>",
                "embedUrl": "https://www.youtube.com/embed/<?php echo htmlspecialchars($video['id']); ?>"
            }<?php echo $index < count($videoTestimonials) - 1 ? ',' : ''; ?>
<?php endforeach; ?>
        ]
    }
}
</script>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Video Testimonials</h1>
            <p>Watch real stories from people who trust <?php echo htmlspecialchars($siteShortName); ?> for their health and wellness</p>
        </div>
    </div>

    <!-- Video Testimonials -->
    <section class="section-pad">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge-pill" style="background: var(--light-blue); color: var(--primary-blue); margin-bottom: 1rem;">REAL STORIES</span>
                <h2 class="section-heading">Hear From Our Customers</h2>
                <p style="color: var(--gray-text);">Watch video testimonials from people who have experienced the benefits of <?php echo htmlspecialchars($siteShortName); ?> products</p>
            </div>

            <div class="row g-4">
                <?php foreach ($videoTestimonials as $index => $video): ?>
                <div class="col-lg-6 col-md-6">
                    <div class="video-card">
                        <div class="video-embed">
                            <iframe src="https://www.youtube.com/embed/<?php echo htmlspecialchars($video['id']); ?>" title="<?php echo htmlspecialchars($video['title']); ?> <?php echo $index + 1; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="section-pad-sm" style="background: var(--light-blue);">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-lg-3 col-6">
                    <div>
                        <h3 class="stat-value">5,000+</h3>
                        <p style="color: var(--gray-text); font-weight: 600; margin: 0;">Happy Customers</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div>
                        <h3 class="stat-value">30+</h3>
                        <p style="color: var(--gray-text); font-weight: 600; margin: 0;">Health Products</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div>
                        <h3 class="stat-value">50+</h3>
                        <p style="color: var(--gray-text); font-weight: 600; margin: 0;">Stockists Nationwide</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div>
                        <h3 class="stat-value">4.8</h3>
                        <p style="color: var(--gray-text); font-weight: 600; margin: 0;">Average Rating</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Become a Stockist CTA -->
    <section class="section-pad">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="badge-pill" style="background: var(--accent-light); color: var(--primary-green); margin-bottom: 1rem;">JOIN OUR NETWORK</span>
                    <h2 class="section-heading">Become a DTEHM Stockist</h2>
                    <p style="color: var(--gray-text); line-height: 1.8; margin-bottom: 1.5rem;">
                        Join hundreds of successful stockists who are building income while helping their communities access quality natural health products. Our network marketing program offers attractive commissions and full support.
                    </p>
                    <ul style="list-style: none; padding: 0; margin-bottom: 1.5rem;">
                        <li style="padding: 0.3rem 0; color: var(--gray-text);"><i class="fas fa-check-circle me-2" style="color: var(--primary-green);"></i>Earn from direct sales and network commissions</li>
                        <li style="padding: 0.3rem 0; color: var(--gray-text);"><i class="fas fa-check-circle me-2" style="color: var(--primary-green);"></i>Full product training and marketing support</li>
                        <li style="padding: 0.3rem 0; color: var(--gray-text);"><i class="fas fa-check-circle me-2" style="color: var(--primary-green);"></i>Flexible working — build at your own pace</li>
                        <li style="padding: 0.3rem 0; color: var(--gray-text);"><i class="fas fa-check-circle me-2" style="color: var(--primary-green);"></i>Mobile app for order tracking and management</li>
                    </ul>
                    <a href="network.php" class="btn-primary-custom" style="padding: 0.8rem 2rem;"><i class="fas fa-users me-2"></i>Learn About Our Network</a>
                </div>
                <div class="col-lg-6">
                    <div class="content-block" style="background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue)); color: #fff; border: none;">
                        <h4 style="font-weight: 700; margin-bottom: 1.5rem;"><i class="fas fa-quote-left me-2" style="opacity: 0.5;"></i>Stockist Spotlight</h4>
                        <p style="font-size: 1.05rem; line-height: 1.8; opacity: 0.95; margin-bottom: 1.5rem;">
                            "Joining DTEHM as a stockist was one of the best decisions I've made. Not only am I earning a reliable income, but I'm also helping people in my community improve their health. The products sell themselves because they actually work."
                        </p>
                        <div style="display: flex; align-items: center; gap: 0.8rem;">
                            <div class="icon-circle-md" style="background: rgba(255,255,255,0.2); font-weight: 700;">R</div>
                            <div>
                                <strong>Ronald Tumusiime</strong><br>
                                <span style="opacity: 0.8; font-size: 0.9rem;">Stockist since 2023, Kampala</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section id="cta" class="section-pad-sm">
        <div class="container text-center">
            <h2 class="section-heading" style="color: var(--white);">Ready to Start Your Health Journey?</h2>
            <p style="color: rgba(255,255,255,0.9); margin-bottom: 2rem;">Explore our range of natural health products and experience the difference.</p>
            <a href="shop.php" class="btn-green-custom" style="padding: 0.8rem 2rem;"><i class="fas fa-store me-2"></i>Browse Products</a>
            <a href="contact.php" style="display: inline-block; background: transparent; color: var(--white); border: 2px solid var(--white); padding: 0.8rem 2rem; font-weight: 600; border-radius: 6px; text-decoration: none; margin-left: 0.5rem;"><i class="fas fa-phone me-2"></i>Talk to Us</a>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
