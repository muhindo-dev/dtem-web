<?php
/**
 * Dynamic Sitemap Generator
 */
header('Content-Type: application/xml; charset=utf-8');

require_once 'config.php';
require_once 'functions.php';

$baseUrl = 'https://dtehmhealth.com';

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <!-- Static Pages -->
    <url><loc><?php echo $baseUrl; ?>/</loc><changefreq>weekly</changefreq><priority>1.0</priority></url>
    <url><loc><?php echo $baseUrl; ?>/about.php</loc><changefreq>monthly</changefreq><priority>0.8</priority></url>
    <url><loc><?php echo $baseUrl; ?>/contact.php</loc><changefreq>monthly</changefreq><priority>0.7</priority></url>
    <url><loc><?php echo $baseUrl; ?>/shop.php</loc><changefreq>weekly</changefreq><priority>0.9</priority></url>
    <url><loc><?php echo $baseUrl; ?>/insurance.php</loc><changefreq>monthly</changefreq><priority>0.8</priority></url>
    <url><loc><?php echo $baseUrl; ?>/investment.php</loc><changefreq>monthly</changefreq><priority>0.8</priority></url>
    <url><loc><?php echo $baseUrl; ?>/network.php</loc><changefreq>monthly</changefreq><priority>0.7</priority></url>
    <url><loc><?php echo $baseUrl; ?>/faq.php</loc><changefreq>monthly</changefreq><priority>0.6</priority></url>
    <url><loc><?php echo $baseUrl; ?>/news.php</loc><changefreq>daily</changefreq><priority>0.8</priority></url>
    <url><loc><?php echo $baseUrl; ?>/events.php</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
    <url><loc><?php echo $baseUrl; ?>/causes.php</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
    <url><loc><?php echo $baseUrl; ?>/gallery.php</loc><changefreq>weekly</changefreq><priority>0.6</priority></url>
    <url><loc><?php echo $baseUrl; ?>/donate.php</loc><changefreq>monthly</changefreq><priority>0.7</priority></url>
    <url><loc><?php echo $baseUrl; ?>/get-involved.php</loc><changefreq>monthly</changefreq><priority>0.6</priority></url>

    <!-- Dynamic: News Posts -->
<?php
$stmt = $pdo->query("SELECT id, updated_at FROM news_posts WHERE status = 'published' ORDER BY published_at DESC");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
?>
    <url><loc><?php echo $baseUrl; ?>/news-detail.php?id=<?php echo $row['id']; ?></loc><lastmod><?php echo date('Y-m-d', strtotime($row['updated_at'])); ?></lastmod><changefreq>monthly</changefreq><priority>0.6</priority></url>
<?php endwhile; ?>

    <!-- Dynamic: Events -->
<?php
$stmt = $pdo->query("SELECT id, updated_at FROM events WHERE status = 'active' ORDER BY start_datetime DESC");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
?>
    <url><loc><?php echo $baseUrl; ?>/event-detail.php?id=<?php echo $row['id']; ?></loc><lastmod><?php echo date('Y-m-d', strtotime($row['updated_at'])); ?></lastmod><changefreq>weekly</changefreq><priority>0.5</priority></url>
<?php endwhile; ?>

    <!-- Dynamic: Causes -->
<?php
$stmt = $pdo->query("SELECT id, updated_at FROM causes WHERE status = 'active' ORDER BY created_at DESC");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
?>
    <url><loc><?php echo $baseUrl; ?>/cause-detail.php?id=<?php echo $row['id']; ?></loc><lastmod><?php echo date('Y-m-d', strtotime($row['updated_at'])); ?></lastmod><changefreq>weekly</changefreq><priority>0.5</priority></url>
<?php endwhile; ?>
</urlset>
