<?php 
$currentPage = 'gallery';
$pageTitle = 'Album';
include 'config.php';
include 'functions.php';

// Get settings
$siteShortName = getSetting('site_short_name', 'DTEHM');

// Get album
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM gallery_albums WHERE id = ? AND status = 'active'");
$stmt->execute([$id]);
$album = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$album) {
    header('Location: gallery.php');
    exit;
}

$pageTitle = $album['title'] . ' - ' . $siteShortName;
$pageDescription = substr($album['description'], 0, 160);

// Get images for this album
$imagesStmt = $pdo->prepare("SELECT * FROM gallery_images WHERE album_id = ? ORDER BY sort_order ASC, id ASC");
$imagesStmt->execute([$id]);
$images = $imagesStmt->fetchAll(PDO::FETCH_ASSOC);

// Fix image paths for display
foreach ($images as &$image) {
    if (strpos($image['image_path'], '/') === false) {
        $image['image_path'] = 'uploads/gallery/' . $image['image_path'];
    } elseif (strpos($image['image_path'], 'uploads/') !== 0) {
        $image['image_path'] = 'uploads/' . $image['image_path'];
    }
}
unset($image);

include 'includes/header.php';
?>

<!-- Page Header -->
<section style="padding: 120px 0 60px; background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));">
    <div class="container">
        <div class="text-center">
            <div style="margin-bottom: 1rem;">
                <a href="gallery.php" style="color: var(--white); text-decoration: none; font-weight: 600;">
                    <i class="fas fa-arrow-left"></i> Back to Gallery
                </a>
            </div>
            <div style="margin-bottom: 1rem;">
                <span style="display: inline-block; padding: 0.5rem 1rem; background: var(--primary-yellow); color: var(--primary-black); font-weight: 600; font-size: 0.9rem;">
                    <?php echo htmlspecialchars($album['category']); ?>
                </span>
            </div>
            <h1 style="color: #fff; font-size: 2.75rem; font-weight: 800; margin-bottom: 1rem; max-width: 900px; margin-left: auto; margin-right: auto; line-height: 1.2;">
                <?php echo htmlspecialchars($album['title']); ?>
            </h1>
            <p style="color: rgba(255,255,255,0.8); font-size: 1.1rem; max-width: 700px; margin: 0 auto;">
                <?php echo htmlspecialchars($album['description']); ?>
            </p>
            <div style="color: rgba(255,255,255,0.7); font-size: 0.95rem; margin-top: 1rem;">
                <i class="far fa-images"></i> <?php echo count($images); ?> photos
                <span style="margin: 0 0.5rem;">•</span>
                <i class="far fa-calendar"></i> <?php echo date('F j, Y', strtotime($album['created_at'])); ?>
            </div>
        </div>
    </div>
</section>

<!-- Images Grid -->
<section style="padding: 80px 0; background: #fff;">
    <div class="container">
        <?php if (empty($images)): ?>
            <div class="text-center" style="padding: 3rem 0;">
                <i class="far fa-image" style="font-size: 4rem; color: #ddd; margin-bottom: 1rem;"></i>
                <h3 style="color: #666;">No photos in this album</h3>
                <p style="color: #999;">Check back soon for updates!</p>
            </div>
        <?php else: ?>
            <div class="row g-3">
                <?php foreach ($images as $index => $image): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-image-card" onclick="openLightbox(<?php echo $index; ?>)" style="border: 2px solid var(--primary-blue); border-radius: 0; overflow: hidden; cursor: pointer; position: relative; height: 280px; transition: transform 0.3s;">
                        <img src="<?php echo htmlspecialchars($image['image_path']); ?>" alt="<?php echo htmlspecialchars($image['caption'] ?: $album['title']); ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;">
                        <?php if ($image['caption']): ?>
                        <div class="image-caption" style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); padding: 1.5rem 1rem 1rem; color: #fff; font-size: 0.9rem; opacity: 0; transition: opacity 0.3s;">
                            <?php echo htmlspecialchars($image['caption']); ?>
                        </div>
                        <?php endif; ?>
                        <div class="image-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255, 193, 7, 0.9); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s;">
                            <i class="fas fa-search-plus" style="font-size: 2rem; color: var(--primary-black);"></i>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Lightbox -->
<div id="lightbox" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.95); z-index: 9999; overflow: auto;">
    <div style="position: relative; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem;">
        <!-- Close Button -->
        <button onclick="closeLightbox()" style="position: fixed; top: 2rem; right: 2rem; background: var(--primary-yellow); color: var(--primary-black); border: 2px solid var(--primary-yellow); width: 50px; height: 50px; font-size: 1.5rem; cursor: pointer; z-index: 10000; display: flex; align-items: center; justify-content: center; font-weight: 700;">
            <i class="fas fa-times"></i>
        </button>

        <!-- Previous Button -->
        <button onclick="previousImage()" style="position: fixed; left: 2rem; top: 50%; transform: translateY(-50%); background: var(--primary-yellow); color: var(--primary-black); border: 2px solid var(--primary-yellow); width: 50px; height: 50px; font-size: 1.5rem; cursor: pointer; z-index: 10000; display: flex; align-items: center; justify-content: center; font-weight: 700;">
            <i class="fas fa-chevron-left"></i>
        </button>

        <!-- Next Button -->
        <button onclick="nextImage()" style="position: fixed; right: 2rem; top: 50%; transform: translateY(-50%); background: var(--primary-yellow); color: var(--primary-black); border: 2px solid var(--primary-yellow); width: 50px; height: 50px; font-size: 1.5rem; cursor: pointer; z-index: 10000; display: flex; align-items: center; justify-content: center; font-weight: 700;">
            <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Image Container -->
        <div style="max-width: 1200px; width: 100%; text-align: center;">
            <img id="lightbox-image" src="" alt="" style="max-width: 100%; max-height: 80vh; border: 3px solid var(--primary-yellow); margin-bottom: 1.5rem; display: inline-block;">
            <div id="lightbox-caption" style="color: #fff; font-size: 1.1rem; margin-top: 1rem; padding: 0 2rem;"></div>
            <div style="color: rgba(255,255,255,0.7); font-size: 0.95rem; margin-top: 0.5rem;">
                <span id="lightbox-counter"></span>
            </div>
        </div>
    </div>
</div>

<style>
.gallery-image-card:hover {
    transform: translateY(-3px);
}
.gallery-image-card:hover img {
    transform: scale(1.1);
}
.gallery-image-card:hover .image-overlay {
    opacity: 1;
}
.gallery-image-card:hover .image-caption {
    opacity: 1;
}
</style>

<script>
const images = <?php echo json_encode($images); ?>;
let currentImageIndex = 0;

function openLightbox(index) {
    currentImageIndex = index;
    showImage();
    document.getElementById('lightbox').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function showImage() {
    const image = images[currentImageIndex];
    document.getElementById('lightbox-image').src = image.image_path;
    document.getElementById('lightbox-image').alt = image.caption || '<?php echo addslashes($album['title']); ?>';
    document.getElementById('lightbox-caption').textContent = image.caption || '';
    document.getElementById('lightbox-counter').textContent = `${currentImageIndex + 1} / ${images.length}`;
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % images.length;
    showImage();
}

function previousImage() {
    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
    showImage();
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    if (document.getElementById('lightbox').style.display === 'block') {
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'ArrowLeft') previousImage();
        if (e.key === 'Escape') closeLightbox();
    }
});

// Close on background click
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLightbox();
    }
});
</script>

<!-- CTA -->
<section style="padding: 80px 0; background: var(--primary-yellow);">
    <div class="container text-center">
        <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 1rem; color: var(--white);">Explore More Albums</h2>
        <p style="font-size: 1.1rem; margin-bottom: 2rem; color: var(--white);">
            See more photos from our activities and events
        </p>
        <a href="gallery.php" class="btn" style="border: 2px solid var(--primary-blue); background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue)); color: #fff; padding: 0.75rem 2rem; font-weight: 600; text-decoration: none;">
            <i class="far fa-images me-2"></i> View All Albums
        </a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
