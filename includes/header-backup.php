<?php
// Load site settings if not already loaded
if (!function_exists('getSetting')) {
    require_once __DIR__ . '/../functions.php';
}

// Get commonly used settings
$siteName = getSetting('site_name', 'United Love for All (ULFA)');
$siteShortName = getSetting('site_short_name', 'ULFA');
$siteTagline = getSetting('site_tagline', 'United Love for All');
$siteDescription = getSetting('site_description', 'United Love for All (ULFA) provides love, care, education, and sustainable support to orphaned and vulnerable children in Kasese District, Uganda.');
$siteLogo = getSiteLogo();
$siteFavicon = getSiteFavicon();
$logoIconClass = getSetting('logo_icon_class', 'fas fa-hands-helping');
$metaTitle = getSetting('meta_title', $siteName);
$metaKeywords = getSetting('meta_keywords', 'orphanage, charity, Uganda, children, ULFA');
$googleAnalyticsId = getSetting('google_analytics_id');
$enableAnalytics = getSetting('enable_google_analytics') == '1';
$customHeadCode = getSetting('custom_head_code');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' - ' . $siteShortName : $metaTitle; ?></title>
    <meta name="description" content="<?php echo htmlspecialchars(isset($pageDescription) ? $pageDescription : $siteDescription); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($metaKeywords); ?>">
    
    <!-- Favicon -->
    <?php if ($siteFavicon): 
        $faviconExt = strtolower(pathinfo($siteFavicon, PATHINFO_EXTENSION));
        $faviconType = ($faviconExt === 'ico') ? 'image/x-icon' : 'image/' . $faviconExt;
        // Use absolute path from site root
        $faviconPath = '/' . ltrim($siteFavicon, '/');
    ?>
    <link rel="icon" type="<?php echo $faviconType; ?>" href="<?php echo $faviconPath; ?>">
    <link rel="shortcut icon" type="<?php echo $faviconType; ?>" href="<?php echo $faviconPath; ?>">
    <link rel="apple-touch-icon" href="<?php echo $faviconPath; ?>">
    <?php endif; ?>
    
    <!-- Open Graph / Social Media -->
    <meta property="og:title" content="<?php echo htmlspecialchars(getSetting('og_title', $siteName)); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars(getSetting('og_description', $siteDescription)); ?>">
    <meta property="og:type" content="website">
    <?php if ($ogImage = getSetting('og_image')): ?>
    <meta property="og:image" content="<?php echo rtrim(dirname($_SERVER['REQUEST_URI']), '/'); ?>/uploads/<?php echo $ogImage; ?>">
    <?php endif; ?>
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars(getSetting('og_title', $siteName)); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars(getSetting('og_description', $siteDescription)); ?>">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <?php if ($enableAnalytics && $googleAnalyticsId): ?>
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo htmlspecialchars($googleAnalyticsId); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo htmlspecialchars($googleAnalyticsId); ?>');
    </script>
    <?php endif; ?>
    
    <?php if ($customHeadCode): ?>
    <!-- Custom Head Code -->
    <?php echo $customHeadCode; ?>
    <?php endif; ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <?php if ($siteLogo): ?>
                <img src="<?php echo $siteLogo; ?>" alt="<?php echo htmlspecialchars($siteShortName); ?>" class="brand-logo">
                <?php else: ?>
                <i class="<?php echo htmlspecialchars($logoIconClass); ?>"></i>
                <?php endif; ?>
                <span>
                    <span class="brand-main"><?php echo htmlspecialchars($siteShortName); ?></span>
                    <span class="brand-sub"><?php echo htmlspecialchars($siteTagline); ?></span>
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link <?php echo $currentPage == 'home' ? 'active' : ''; ?>" href="index.php">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo in_array($currentPage, ['about', 'stories', 'news']) ? 'active' : ''; ?>" href="#" role="button">About Us<span class="dropdown-icon"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="about.php"><i class="fas fa-bullseye"></i>Mission & Vision</a></li>
                            <li><a class="dropdown-item" href="about.php#impact"><i class="fas fa-chart-line"></i>Our Impact</a></li>
                            <li><a class="dropdown-item" href="about.php#team"><i class="fas fa-users"></i>Our Team</a></li>
                            <li><a class="dropdown-item" href="stories.php"><i class="fas fa-comments"></i>Stories</a></li>
                            <li><a class="dropdown-item" href="news.php"><i class="fas fa-newspaper"></i>News & Articles</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $currentPage == 'programs' ? 'active' : ''; ?>" href="#" role="button">Our Programs<span class="dropdown-icon"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="programs.php"><i class="fas fa-graduation-cap"></i>Education Support</a></li>
                            <li><a class="dropdown-item" href="programs.php#child-welfare"><i class="fas fa-child"></i>Child Welfare</a></li>
                            <li><a class="dropdown-item" href="programs.php#orphanage"><i class="fas fa-home"></i>Orphanage Development</a></li>
                            <li><a class="dropdown-item" href="programs.php#agriculture"><i class="fas fa-seedling"></i>Agriculture Projects</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo in_array($currentPage, ['events', 'causes', 'gallery']) ? 'active' : ''; ?>" href="#" role="button">Our Work<span class="dropdown-icon"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="events.php"><i class="far fa-calendar"></i>Events & Activities</a></li>
                            <li><a class="dropdown-item" href="causes.php"><i class="fas fa-hand-holding-heart"></i>Active Causes</a></li>
                            <li><a class="dropdown-item" href="gallery.php"><i class="far fa-images"></i>Photo Gallery</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo in_array($currentPage, ['get-involved', 'donate']) ? 'active' : ''; ?>" href="#" role="button">Get Involved<span class="dropdown-icon"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="donation-step1.php"><i class="fas fa-donate"></i>Donate</a></li>
                            <li><a class="dropdown-item" href="get-involved.php#volunteer"><i class="fas fa-hand-holding-heart"></i>Volunteer</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link <?php echo $currentPage == 'contact' ? 'active' : ''; ?>" href="contact.php">Contact</a></li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-donate" href="donation-step1.php"><i class="fas fa-heart me-2"></i>Donate</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
