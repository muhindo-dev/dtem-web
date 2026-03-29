<?php
$currentPage = 'shop';
$pageTitle = 'Health Products';
include 'config.php';
include 'functions.php';

$pageDescription = 'Browse DTEHM Health Ministries natural health products - Ayurvedic, herbal medicine, personal care, and wellness products.';
include 'includes/header.php';

// Get categories
$categories = $pdo->query("SELECT * FROM product_categories ORDER BY category")->fetchAll(PDO::FETCH_ASSOC);

// Get selected category
$selectedCategory = isset($_GET['category']) ? (int)$_GET['category'] : 0;

// Get products
if ($selectedCategory > 0) {
    $stmt = $pdo->prepare("SELECT p.*, pc.category as category_name FROM products p LEFT JOIN product_categories pc ON p.category = pc.id WHERE p.status = 'Active' AND p.category = ? ORDER BY p.name");
    $stmt->execute([$selectedCategory]);
} else {
    $stmt = $pdo->query("SELECT p.*, pc.category as category_name FROM products p LEFT JOIN product_categories pc ON p.category = pc.id WHERE p.status = 'Active' ORDER BY p.name");
}
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Health Products</h1>
            <p>Natural Ayurvedic, herbal, and personal care products for holistic wellness</p>
        </div>
    </div>

    <!-- Products Section -->
    <section class="section-pad">
        <div class="container">
            <!-- Category Filter -->
            <div class="category-filter-row mb-4">
                <a href="shop.php" class="btn-outline-custom me-1 mb-2 <?php echo $selectedCategory == 0 ? 'btn-primary-custom' : ''; ?>" style="font-size: 0.85rem; padding: 0.4rem 1rem;">All Products</a>
                <?php foreach ($categories as $cat): ?>
                <a href="shop.php?category=<?php echo $cat['id']; ?>" class="btn-outline-custom me-1 mb-2 <?php echo $selectedCategory == $cat['id'] ? 'btn-primary-custom' : ''; ?>" style="font-size: 0.85rem; padding: 0.4rem 1rem;">
                    <?php echo htmlspecialchars($cat['category']); ?>
                </a>
                <?php endforeach; ?>
            </div>
            
            <p class="text-center mb-4" style="color: var(--gray-text);">
                Showing <?php echo count($products); ?> product<?php echo count($products) != 1 ? 's' : ''; ?>
            </p>

            <?php if (empty($products)): ?>
            <div class="text-center py-5">
                <i class="fas fa-leaf" style="font-size: 3rem; color: var(--gray-border); margin-bottom: 1rem; display: block;"></i>
                <p style="color: var(--gray-text);">No products found in this category.</p>
            </div>
            <?php else: ?>
            <div class="row g-4">
                <?php foreach ($products as $product): ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="product-detail.php?id=<?php echo $product['id']; ?>" style="text-decoration: none;">
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
                            <p class="product-desc"><?php echo htmlspecialchars(substr(strip_tags($product['description']), 0, 100)); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA -->
    <section id="cta" class="section-pad-sm">
        <div class="container text-center">
            <h2 class="section-heading" style="color: var(--white);">Want to Order Products?</h2>
            <p style="color: rgba(255,255,255,0.9); margin-bottom: 2rem;">Download our mobile app or contact us directly to place your order.</p>
            <div class="cta-inline-btns" style="justify-content: center;">
                <a href="https://play.google.com/store/apps/details?id=com.dtehm.insurance" target="_blank" rel="noopener noreferrer" class="btn-green-custom" style="padding: 0.8rem 2rem;"><i class="fab fa-google-play me-2"></i>Get the App</a>
                <a href="contact.php" style="display: inline-block; background: transparent; color: var(--white); border: 2px solid var(--white); padding: 0.8rem 2rem; font-weight: 600; border-radius: 6px; text-decoration: none;"><i class="fas fa-phone me-2"></i>Contact Us</a>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
