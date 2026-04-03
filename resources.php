<?php
$currentPage = 'resources';
$pageTitle = 'Health Resources';
include 'config.php';
include 'functions.php';

$pageDescription = 'Health tips, educational materials, and wellness resources from DTEHM Health Ministries.';
include 'includes/header.php';
?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Health Resources</h1>
            <p>Educational materials and wellness tips for a healthier life</p>
        </div>
    </div>

    <!-- Ayukalash Introduction -->
    <section class="section-pad">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="badge-pill" style="background: var(--light-blue); color: var(--primary-blue); margin-bottom: 1rem;">What is Ayukalash?</span>
                    <h2 class="section-heading">The Science of Life</h2>
                    <p style="color: var(--gray-text); line-height: 1.8; margin-bottom: 1rem;">
                        Ayukalash is a holistic healing system rooted in ancient traditions of natural medicine. The word "Ayukalash" represents the knowledge of life and wellness. It is based on the belief that health and wellness depend on a delicate balance between the mind, body, and spirit.
                    </p>
                    <p style="color: var(--gray-text); line-height: 1.8;">
                        DTEHM Health Ministries brings the power of Ayukalash and herbal medicine to communities in Uganda, offering natural health solutions that complement modern medical care.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="content-block" style="background: var(--light-blue); border: none; box-shadow: none;">
                        <h4 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 1.5rem;"><i class="fas fa-leaf me-2" style="color: var(--primary-green);"></i>Core Principles</h4>
                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            <div style="display: flex; align-items: start; gap: 0.8rem;">
                                <div class="icon-circle-sm" style="background: var(--primary-blue); color: var(--white); font-weight: 700;">1</div>
                                <div>
                                    <strong style="color: var(--dark-blue);">Prevention Over Cure</strong>
                                    <p style="color: var(--gray-text); font-size: 0.9rem; margin: 0;">Focus on maintaining health rather than just treating disease</p>
                                </div>
                            </div>
                            <div style="display: flex; align-items: start; gap: 0.8rem;">
                                <div class="icon-circle-sm" style="background: var(--primary-blue); color: var(--white); font-weight: 700;">2</div>
                                <div>
                                    <strong style="color: var(--dark-blue);">Holistic Approach</strong>
                                    <p style="color: var(--gray-text); font-size: 0.9rem; margin: 0;">Treating the whole person — mind, body, and spirit</p>
                                </div>
                            </div>
                            <div style="display: flex; align-items: start; gap: 0.8rem;">
                                <div class="icon-circle-sm" style="background: var(--primary-blue); color: var(--white); font-weight: 700;">3</div>
                                <div>
                                    <strong style="color: var(--dark-blue);">Natural Remedies</strong>
                                    <p style="color: var(--gray-text); font-size: 0.9rem; margin: 0;">Using herbs, minerals, and natural substances for healing</p>
                                </div>
                            </div>
                            <div style="display: flex; align-items: start; gap: 0.8rem;">
                                <div class="icon-circle-sm" style="background: var(--primary-blue); color: var(--white); font-weight: 700;">4</div>
                                <div>
                                    <strong style="color: var(--dark-blue);">Individual Care</strong>
                                    <p style="color: var(--gray-text); font-size: 0.9rem; margin: 0;">Personalized treatment based on each person's unique constitution</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Health Tips -->
    <section class="section-pad-sm" style="background: var(--light-gray);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-heading">Daily Health Tips</h2>
                <p style="color: var(--gray-text);">Simple practices for better health and wellness</p>
            </div>
            <div class="row g-4">
                <?php
                $tips = [
                    ['icon' => 'fa-glass-water', 'title' => 'Stay Hydrated', 'text' => 'Drink warm water throughout the day. In Ayukalash, warm water helps digestion and detoxification. Aim for at least 8 glasses daily.'],
                    ['icon' => 'fa-bed', 'title' => 'Quality Sleep', 'text' => 'Go to bed before 10 PM and wake up before 6 AM. Consistent sleep patterns strengthen immunity and restore the body naturally.'],
                    ['icon' => 'fa-carrot', 'title' => 'Eat Seasonal & Local', 'text' => 'Choose fresh, locally grown fruits and vegetables. Seasonal foods are naturally suited to your body\'s needs during different times of year.'],
                    ['icon' => 'fa-person-walking', 'title' => 'Daily Movement', 'text' => 'Walk for at least 30 minutes daily. Regular physical movement improves circulation, digestion, and mental clarity.'],
                    ['icon' => 'fa-spa', 'title' => 'Manage Stress', 'text' => 'Practice deep breathing or meditation daily. Stress weakens immunity and disrupts the body\'s natural healing abilities.'],
                    ['icon' => 'fa-seedling', 'title' => 'Herbal Support', 'text' => 'Incorporate natural herbs like ginger, turmeric, and tulsi into your daily routine for immune support and overall wellness.'],
                ];
                foreach ($tips as $tip):
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="icon-circle-md" style="background: var(--light-blue); margin-bottom: 1rem;">
                            <i class="fas <?php echo $tip['icon']; ?>" style="color: var(--primary-blue);"></i>
                        </div>
                        <h4 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 0.5rem;"><?php echo $tip['title']; ?></h4>
                        <p style="color: var(--gray-text); font-size: 0.9rem; line-height: 1.7; margin: 0;"><?php echo $tip['text']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Product Categories Guide -->
    <section class="section-pad">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-heading">Our Product Categories</h2>
                <p style="color: var(--gray-text);">Understanding the range of natural health solutions we offer</p>
            </div>
            <div class="row g-4">
                <?php
                $categories = [
                    ['icon' => 'fa-heartbeat', 'title' => 'Heart & Circulation', 'text' => 'Products supporting cardiovascular health including Heart Care Tonic and circulation support supplements.', 'examples' => 'Heart Care Tonic, Six-C'],
                    ['icon' => 'fa-stomach', 'title' => 'Digestive Health', 'text' => 'Natural solutions for digestive comfort, acid relief, and liver support using traditional herbal formulations.', 'examples' => 'Acidinol Syrup, Livex Syrup, Colicarmin'],
                    ['icon' => 'fa-bone', 'title' => 'Bone & Joint Care', 'text' => 'Support for bones, joints, and mobility with calcium-rich supplements and anti-inflammatory herbal preparations.', 'examples' => 'Bone & Joint Care, Calcurosin Syrup'],
                    ['icon' => 'fa-shield-alt', 'title' => 'Immunity & Wellness', 'text' => 'Daily immune support and overall wellness products to help your body fight infections and stay strong.', 'examples' => 'Daily Health Immune, Force Vital, Infection Capsules'],
                    ['icon' => 'fa-female', 'title' => 'Women\'s Health', 'text' => 'Specialized products for women\'s reproductive health, hormonal balance, and gynecological wellness.', 'examples' => 'Ovarin Syrup/Capsule, Gynocare Capsule'],
                    ['icon' => 'fa-eye', 'title' => 'Eye & Skin Care', 'text' => 'Natural eye health supplements and skincare products using Ayurvedic and herbal ingredients.', 'examples' => 'Ayukalash Eye Health, Rhue, Rhue Rub'],
                ];
                foreach ($categories as $cat):
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card" style="height: 100%;">
                        <div class="icon-circle-md" style="background: var(--accent-light); margin-bottom: 1rem;">
                            <i class="fas <?php echo $cat['icon']; ?>" style="color: var(--primary-green);"></i>
                        </div>
                        <h4 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 0.5rem;"><?php echo $cat['title']; ?></h4>
                        <p style="color: var(--gray-text); font-size: 0.9rem; line-height: 1.7; margin-bottom: 0.8rem;"><?php echo $cat['text']; ?></p>
                        <p style="font-size: 0.8rem; color: var(--primary-blue); margin: 0;"><strong>Examples:</strong> <?php echo $cat['examples']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-4">
                <a href="shop.php" class="btn-primary-custom" style="padding: 0.8rem 2rem;"><i class="fas fa-store me-2"></i>Browse All Products</a>
            </div>
        </div>
    </section>

    <!-- Important Disclaimer -->
    <section class="section-pad-sm" style="background: var(--light-blue);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <i class="fas fa-info-circle" style="font-size: 2rem; color: var(--primary-blue); margin-bottom: 1rem;"></i>
                    <h4 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 0.8rem;">Health Disclaimer</h4>
                    <p style="color: var(--gray-text); font-size: 0.9rem; line-height: 1.8;">
                        The information provided on this page is for educational purposes only and is not intended as medical advice. 
                        DTEHM products are complementary and alternative health solutions. Always consult a qualified healthcare 
                        professional before starting any new health program or supplement, especially if you have existing medical 
                        conditions or are taking medication.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section id="cta" class="section-pad-sm">
        <div class="container text-center">
            <h2 class="section-heading" style="color: var(--white);">Have Questions About Our Products?</h2>
            <p style="color: rgba(255,255,255,0.9); margin-bottom: 2rem;">Our team is happy to help you find the right health solutions.</p>
            <div class="cta-inline-btns">
                <a href="contact.php" class="btn-green-custom" style="padding: 0.8rem 2rem;"><i class="fas fa-envelope me-2"></i>Contact Us</a>
                <a href="shop.php" class="btn-outline-custom" style="padding: 0.8rem 2rem; color: var(--white); border-color: var(--white);"><i class="fas fa-store me-2"></i>View Products</a>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
