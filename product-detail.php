<?php
$currentPage = 'shop';
$pageTitle = 'Product Details';
include 'config.php';
include 'functions.php';

// Get product ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: shop.php');
    exit;
}

// Get product with category
$stmt = $pdo->prepare("SELECT p.*, pc.category as category_name FROM products p LEFT JOIN product_categories pc ON p.category = pc.id WHERE p.id = ? AND p.status = 'Active'");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header('Location: shop.php');
    exit;
}

$pageTitle = htmlspecialchars($product['name']);
$pageDescription = 'Buy ' . htmlspecialchars($product['name']) . ' from DTEHM Health Ministries - natural Ayurvedic health products.';

// Get additional product images
$imgStmt = $pdo->prepare("SELECT * FROM product_images WHERE product = ? AND status = 1 ORDER BY feature_photo DESC, id");
$imgStmt->execute([$id]);
$productImages = $imgStmt->fetchAll(PDO::FETCH_ASSOC);

// Get related products (same category, exclude current)
$relatedStmt = $pdo->prepare("SELECT p.*, pc.category as category_name FROM products p LEFT JOIN product_categories pc ON p.category = pc.id WHERE p.category = ? AND p.id != ? AND p.status = 'Active' ORDER BY RAND() LIMIT 4");
$relatedStmt->execute([$product['category'], $id]);
$relatedProducts = $relatedStmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';

// Product Structured Data
$productImage = !empty($product['feature_photo']) ? 'https://dtehmhealth.com/' . $product['feature_photo'] : '';
$currency = getCurrency();
?>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "<?php echo htmlspecialchars($product['name']); ?>",
    "description": "<?php echo htmlspecialchars(substr(strip_tags($product['description'] ?? ''), 0, 200)); ?>",
    "image": "<?php echo $productImage; ?>",
    "brand": {
        "@type": "Brand",
        "name": "DTEHM Health Ministries"
    },
    "offers": {
        "@type": "Offer",
        "price": "<?php echo $product['price']; ?>",
        "priceCurrency": "<?php echo htmlspecialchars($currency['code'] ?? 'UGX'); ?>",
        "availability": "https://schema.org/InStock",
        "seller": {
            "@type": "Organization",
            "name": "DTEHM Health Ministries"
        }
    }
}
</script>

    <!-- Page Header -->
    <div class="page-header" style="padding: 100px 0 1.5rem;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol style="display: flex; gap: 0.5rem; list-style: none; padding: 0; margin: 0; font-size: 0.9rem;">
                    <li><a href="index.php" style="color: rgba(255,255,255,0.7); text-decoration: none;">Home</a></li>
                    <li style="color: rgba(255,255,255,0.5);">/</li>
                    <li><a href="shop.php" style="color: rgba(255,255,255,0.7); text-decoration: none;">Health Products</a></li>
                    <li style="color: rgba(255,255,255,0.5);">/</li>
                    <li style="color: var(--white);"><?php echo htmlspecialchars($product['name']); ?></li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Product Detail -->
    <section class="section-pad">
        <div class="container">
            <div class="row g-5">
                <!-- Product Image -->
                <div class="col-lg-5">
                    <div class="detail-sticky" style="background: var(--light-blue); border-radius: 12px; overflow: hidden;">
                        <?php if (!empty($product['feature_photo'])): ?>
                        <img src="<?php echo htmlspecialchars($product['feature_photo']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width: 100%; height: auto; display: block;">
                        <?php else: ?>
                        <div class="hero-img-placeholder">
                            <i class="fas fa-leaf" style="font-size: 3rem; color: var(--primary-blue); opacity: 0.2;"></i>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($productImages)): ?>
                        <div style="display: flex; gap: 0.5rem; padding: 0.75rem; overflow-x: auto;">
                            <?php foreach ($productImages as $img): ?>
                            <img src="uploads/products/<?php echo htmlspecialchars($img['photo']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?> - Product Image" class="product-thumb">
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-7">
                    <?php if (!empty($product['category_name'])): ?>
                    <span class="badge-pill" style="background: var(--light-blue); color: var(--primary-blue); margin-bottom: 0.8rem;">
                        <?php echo htmlspecialchars($product['category_name']); ?>
                    </span>
                    <?php endif; ?>

                    <h1 class="section-heading" style="margin-bottom: 0.5rem;">
                        <?php echo htmlspecialchars($product['name']); ?>
                    </h1>

                    <?php if (!empty($product['metric'])): ?>
                    <p style="color: var(--gray-text); font-size: 0.95rem; margin-bottom: 1rem;">
                        <i class="fas fa-tag me-1"></i> <?php echo htmlspecialchars($product['metric']); ?>
                    </p>
                    <?php endif; ?>

                    <?php if (!empty($product['price_1']) && $product['price_1'] > 0): ?>
                    <div class="stat-value" style="color: var(--primary-green); margin-bottom: 1.5rem;">
                        UGX <?php echo number_format($product['price_1']); ?>
                        <?php if (!empty($product['points']) && $product['points'] > 0): ?>
                        <span style="font-size: 0.85rem; font-weight: 500; color: var(--gray-text); display: block; margin-top: 0.2rem;">
                            <i class="fas fa-star" style="color: #f0ad4e;"></i> <?php echo $product['points']; ?> points
                        </span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Stock Status -->
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                        <?php if (strtolower($product['in_stock'] ?? 'Yes') === 'yes'): ?>
                        <span style="display: inline-flex; align-items: center; gap: 0.3rem; background: var(--accent-light); color: var(--primary-green); padding: 0.4rem 0.8rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">
                            <i class="fas fa-check-circle"></i> In Stock
                        </span>
                        <?php else: ?>
                        <span style="display: inline-flex; align-items: center; gap: 0.3rem; background: #fdf0f0; color: #dc3545; padding: 0.4rem 0.8rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">
                            <i class="fas fa-times-circle"></i> Out of Stock
                        </span>
                        <?php endif; ?>

                        <?php if (!empty($product['local_id'])): ?>
                        <span style="color: var(--gray-text); font-size: 0.8rem;">SKU: <?php echo htmlspecialchars($product['local_id']); ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Description -->
                    <?php if (!empty($product['description'])): ?>
                    <div style="margin-bottom: 2rem;">
                        <h4 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 0.8rem;">Description</h4>
                        <div style="color: var(--gray-text); line-height: 1.8;">
                            <?php echo $product['description']; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Summary -->
                    <?php if (!empty($product['summary'])): ?>
                    <div style="margin-bottom: 2rem;">
                        <h4 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 0.8rem;">Summary</h4>
                        <p style="color: var(--gray-text); line-height: 1.8;"><?php echo htmlspecialchars($product['summary']); ?></p>
                    </div>
                    <?php endif; ?>

                    <!-- Order Actions -->
                    <div style="display: flex; flex-wrap: wrap; gap: 0.8rem; margin-bottom: 2rem;">
                        <a href="contact.php" class="btn-green-custom" style="padding: 0.8rem 2rem;">
                            <i class="fas fa-shopping-cart me-2"></i>Order Now
                        </a>
                        <a href="tel:+256782284788" class="btn-outline-custom" style="padding: 0.8rem 2rem;">
                            <i class="fas fa-phone me-2"></i>Call to Order
                        </a>
                    </div>

                    <!-- Product Meta -->
                    <div style="background: var(--gray-light); border-radius: 12px; padding: 1.5rem;">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div style="display: flex; align-items: center; gap: 0.8rem;">
                                    <i class="fas fa-truck" style="color: var(--primary-blue); font-size: 1.2rem;"></i>
                                    <div>
                                        <strong style="color: var(--dark-blue); font-size: 0.85rem;">Delivery Available</strong>
                                        <p style="margin: 0; color: var(--gray-text); font-size: 0.8rem;">Contact us for delivery options</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div style="display: flex; align-items: center; gap: 0.8rem;">
                                    <i class="fas fa-leaf" style="color: var(--primary-green); font-size: 1.2rem;"></i>
                                    <div>
                                        <strong style="color: var(--dark-blue); font-size: 0.85rem;">100% Natural</strong>
                                        <p style="margin: 0; color: var(--gray-text); font-size: 0.8rem;">Ayurvedic & herbal formulation</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div style="display: flex; align-items: center; gap: 0.8rem;">
                                    <i class="fas fa-store" style="color: var(--primary-blue); font-size: 1.2rem;"></i>
                                    <div>
                                        <strong style="color: var(--dark-blue); font-size: 0.85rem;">Available at Stockists</strong>
                                        <p style="margin: 0; color: var(--gray-text); font-size: 0.8rem;">Find your nearest stockist</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div style="display: flex; align-items: center; gap: 0.8rem;">
                                    <i class="fas fa-mobile-alt" style="color: var(--primary-green); font-size: 1.2rem;"></i>
                                    <div>
                                        <strong style="color: var(--dark-blue); font-size: 0.85rem;">Order via App</strong>
                                        <p style="margin: 0; color: var(--gray-text); font-size: 0.8rem;">Download DTEHM mobile app</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    <?php if (!empty($relatedProducts)): ?>
    <section class="section-pad-sm" style="background: var(--light-gray);">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="section-heading">Related Products</h2>
                <p style="color: var(--gray-text);">You may also be interested in</p>
            </div>
            <div class="row g-4">
                <?php foreach ($relatedProducts as $rp): ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="product-detail.php?id=<?php echo $rp['id']; ?>" style="text-decoration: none;">
                        <div class="product-card">
                            <div class="product-image">
                                <?php if (!empty($rp['feature_photo'])): ?>
                                <img src="<?php echo htmlspecialchars($rp['feature_photo']); ?>" alt="<?php echo htmlspecialchars($rp['name']); ?>">
                                <?php else: ?>
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: var(--light-blue);">
                                    <i class="fas fa-leaf" style="font-size: 3rem; color: var(--primary-blue); opacity: 0.3;"></i>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="product-body">
                                <h4><?php echo htmlspecialchars($rp['name']); ?></h4>
                                <?php if (!empty($rp['price_1']) && $rp['price_1'] > 0): ?>
                                <div class="product-price">UGX <?php echo number_format($rp['price_1']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- CTA -->
    <section id="cta" class="section-pad-sm">
        <div class="container text-center">
            <h2 class="section-heading" style="color: var(--white);">Browse All Products</h2>
            <p style="color: rgba(255,255,255,0.9); margin-bottom: 2rem;">Explore our full range of natural Ayurvedic health products.</p>
            <a href="shop.php" class="btn-green-custom" style="padding: 0.8rem 2rem;"><i class="fas fa-store me-2"></i>View All Products</a>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
