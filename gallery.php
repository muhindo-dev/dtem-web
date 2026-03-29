<?php 
$currentPage = 'gallery';
include 'config.php';
include 'functions.php';

// Get settings
$siteShortName = getSetting('site_short_name', 'DTEHM');
$siteName = getSetting('site_name', 'DTEHM Health Ministries');

$pageTitle = 'Photo Gallery';
$pageDescription = 'View photos from our activities, events, and the impact we make in the community at ' . $siteShortName . '.';
include 'includes/header.php';

// Category filter
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 12;
$offset = ($page - 1) * $perPage;

// Build query
$sql = "SELECT * FROM gallery_albums WHERE status = 'active'";
if ($category) {
    $sql .= " AND category = :category";
}
$sql .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";

$stmt = $pdo->prepare($sql);
if ($category) {
    $stmt->bindParam(':category', $category);
}
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$albums = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get total count
$countSql = "SELECT COUNT(*) FROM gallery_albums WHERE status = 'active'";
if ($category) {
    $countSql .= " AND category = :category";
}
$countStmt = $pdo->prepare($countSql);
if ($category) {
    $countStmt->bindParam(':category', $category);
}
$countStmt->execute();
$totalAlbums = $countStmt->fetchColumn();
$totalPages = ceil($totalAlbums / $perPage);

// Get categories for filter
$categoriesStmt = $pdo->query("SELECT DISTINCT category FROM gallery_albums WHERE status = 'active' ORDER BY category");
$categories = $categoriesStmt->fetchAll(PDO::FETCH_COLUMN);

// Get image count for each album
foreach ($albums as &$album) {
    $countStmt = $pdo->prepare("SELECT COUNT(*) FROM gallery_images WHERE album_id = ?");
    $countStmt->execute([$album['id']]);
    $album['image_count'] = $countStmt->fetchColumn();
}
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1>Photo Gallery</h1>
        <p>See our work in action through photos and media</p>
    </div>
</div>

<!-- Category Filter -->
<section style="padding: 2rem 0; background: #f8f9fa; border-bottom: 2px solid var(--primary-blue);">
    <div class="container">
        <div class="d-flex flex-wrap gap-2 justify-content-center">
            <a href="gallery.php" class="btn btn-sm" style="border: 2px solid var(--primary-blue); background: <?php echo !$category ? 'var(--primary-yellow)' : 'transparent'; ?>; color: <?php echo !$category ? 'var(--white)' : 'var(--primary-blue)'; ?>; padding: 0.5rem 1.5rem; font-weight: 600; text-decoration: none;">
                All Albums
            </a>
            <?php foreach ($categories as $cat): ?>
            <a href="gallery.php?category=<?php echo urlencode($cat); ?>" class="btn btn-sm" style="border: 2px solid var(--primary-blue); background: <?php echo $category === $cat ? 'var(--primary-yellow)' : 'transparent'; ?>; color: <?php echo $category === $cat ? 'var(--white)' : 'var(--primary-blue)'; ?>; padding: 0.5rem 1.5rem; font-weight: 600; text-decoration: none;">
                <?php echo htmlspecialchars($cat); ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Albums Grid -->
<section style="padding: 80px 0; background: #fff;">
    <div class="container">
        <?php if (empty($albums)): ?>
            <div class="text-center" style="padding: 3rem 0;">
                <i class="far fa-images" style="font-size: 4rem; color: #ddd; margin-bottom: 1rem;"></i>
                <h3 style="color: #666;">No albums found</h3>
                <p style="color: #999;">Check back soon for new photos!</p>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($albums as $album): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-album-card" style="border: 2px solid var(--primary-blue); border-radius: 0; overflow: hidden; position: relative; min-height: 320px; cursor: pointer; transition: transform 0.3s;">
                        <a href="gallery-album.php?id=<?php echo $album['id']; ?>" style="display: block; height: 100%; text-decoration: none;">
                            <?php if ($album['cover_image']): 
                                $coverImgPath = $album['cover_image'];
                                if (strpos($coverImgPath, '/') === false) {
                                    $coverImgPath = 'gallery/' . $coverImgPath;
                                }
                            ?>
                            <img src="uploads/<?php echo htmlspecialchars($coverImgPath); ?>" alt="<?php echo htmlspecialchars($album['title']); ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;">
                            <?php endif; ?>
                            <div class="album-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.5) 50%, rgba(0,0,0,0) 100%); display: flex; flex-direction: column; justify-content: flex-end; padding: 1.75rem;">
                                <div style="background: var(--primary-yellow); color: var(--white); padding: 0.4rem 0.75rem; font-weight: 700; font-size: 0.8rem; display: inline-block; align-self: flex-start; margin-bottom: 1rem;">
                                    <?php echo htmlspecialchars($album['category']); ?>
                                </div>
                                <h3 style="color: #fff; font-size: 1.35rem; font-weight: 700; margin-bottom: 0.75rem; line-height: 1.3;">
                                    <?php echo htmlspecialchars($album['title']); ?>
                                </h3>
                                <p style="color: rgba(255,255,255,0.9); font-size: 0.95rem; margin-bottom: 1rem; line-height: 1.4;">
                                    <?php echo htmlspecialchars(substr($album['description'], 0, 80)); ?><?php echo strlen($album['description']) > 80 ? '...' : ''; ?>
                                </p>
                                <div style="display: flex; align-items: center; gap: 1rem; color: rgba(255,255,255,0.9); font-size: 0.9rem;">
                                    <span><i class="far fa-images" style="color: var(--white);"></i> <?php echo $album['image_count']; ?> photos</span>
                                    <span><i class="far fa-calendar" style="color: var(--white);"></i> <?php echo date('M d, Y', strtotime($album['created_at'])); ?></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
            <nav aria-label="Gallery pagination" style="margin-top: 3rem;">
                <ul class="pagination justify-content-center" style="gap: 0.5rem;">
                    <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="gallery.php?page=<?php echo $page - 1; ?><?php echo $category ? '&category=' . urlencode($category) : ''; ?>" style="border: 2px solid var(--primary-blue); background: transparent; color: var(--primary-blue); padding: 0.5rem 1rem; text-decoration: none;">
                            <i class="fas fa-chevron-left"></i> Previous
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <?php if ($i == $page): ?>
                        <li class="page-item active">
                            <span class="page-link" style="border: 2px solid var(--primary-blue); background: var(--primary-yellow); color: var(--white); padding: 0.5rem 1rem; font-weight: 600;">
                                <?php echo $i; ?>
                            </span>
                        </li>
                        <?php else: ?>
                        <li class="page-item">
                            <a class="page-link" href="gallery.php?page=<?php echo $i; ?><?php echo $category ? '&category=' . urlencode($category) : ''; ?>" style="border: 2px solid var(--primary-blue); background: transparent; color: var(--primary-blue); padding: 0.5rem 1rem; text-decoration: none;">
                                <?php echo $i; ?>
                            </a>
                        </li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="gallery.php?page=<?php echo $page + 1; ?><?php echo $category ? '&category=' . urlencode($category) : ''; ?>" style="border: 2px solid var(--primary-blue); background: transparent; color: var(--primary-blue); padding: 0.5rem 1rem; text-decoration: none;">
                            Next <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<style>
.gallery-album-card:hover {
    transform: translateY(-5px);
}
.gallery-album-card:hover img {
    transform: scale(1.05);
}
</style>

<?php include 'includes/footer.php'; ?>
