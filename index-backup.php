<?php 
$currentPage = 'home';
$pageTitle = 'Home';
include 'config.php';
include 'functions.php';

// Get settings for homepage
$siteName = getSetting('site_name', 'United Love for All (ULFA)');
$siteShortName = getSetting('site_short_name', 'ULFA');
$siteTagline = getSetting('site_tagline', 'United Love for All');
$siteDescription = getSetting('site_description', 'United Love for All (ULFA) provides love, care, education, and sustainable support to orphaned and vulnerable children in Kasese District, Uganda.');
$contactCity = getSetting('contact_city', 'Kasese');
$contactCountry = getSetting('contact_country', 'Uganda');
$missionStatement = getSetting('mission_statement', '');

$pageDescription = $siteDescription;
include 'includes/header.php';

// Fetch latest news
$stmt = $pdo->query("SELECT * FROM news_posts WHERE status = 'published' ORDER BY published_at DESC LIMIT 3");
$latestNews = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch upcoming events
$stmt = $pdo->query("SELECT * FROM events WHERE status = 'upcoming' AND start_datetime >= NOW() ORDER BY start_datetime ASC LIMIT 3");
$upcomingEvents = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch featured causes
$stmt = $pdo->query("SELECT * FROM causes WHERE status = 'active' AND is_featured = 1 ORDER BY created_at DESC LIMIT 3");
$featuredCauses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch gallery images for homepage lightbox
$stmt = $pdo->query("SELECT gi.*, ga.title as album_title 
    FROM gallery_images gi 
    JOIN gallery_albums ga ON gi.album_id = ga.id 
    WHERE ga.status = 'active' 
    ORDER BY gi.created_at DESC 
    LIMIT 10");
$galleryItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <!-- Hero Section with Background -->
    <section id="hero" style="position: relative; min-height: 85vh; display: flex; align-items: center; background: linear-gradient(135deg, rgba(0, 0, 0, 0.80) 0%, rgba(0, 0, 0, 0.70) 100%), url('uploads/hero-background.jpg') center/cover; overflow: hidden;">
        <div class="container" style="position: relative; z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <div style="display: inline-block; padding: 0.5rem 1.25rem; background: var(--primary-yellow); color: var(--primary-black); font-weight: 700; font-size: 0.875rem; letter-spacing: 1px; margin-bottom: 1.5rem;">
                        <?php echo htmlspecialchars(strtoupper($siteShortName)); ?>
                    </div>
                    <h1 style="font-size: clamp(2.5rem, 5vw, 4.5rem); font-weight: 900; color: #fff; line-height: 1.1; margin-bottom: 1.5rem; text-transform: uppercase; letter-spacing: -1px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                        No Child Should<br>Be Forgotten
                    </h1>
                    <p style="font-size: 1.25rem; color: rgba(255,255,255,0.95); max-width: 650px; margin: 0 auto 2.5rem; line-height: 1.6; font-weight: 500; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                        Providing love, care, education, and sustainable support to orphaned and vulnerable children in <?php echo htmlspecialchars($contactCity); ?> District, <?php echo htmlspecialchars($contactCountry); ?>
                    </p>
                    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                        <a href="donation-step1.php" style="display: inline-block; padding: 1.25rem 2.5rem; background: var(--primary-black); color: #fff; border: 3px solid var(--primary-black); font-weight: 700; font-size: 1rem; text-decoration: none; transition: all 0.3s; letter-spacing: 0.5px;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='8px 8px 0 rgba(0,0,0,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="fas fa-heart" style="margin-right: 0.5rem;"></i> DONATE
                        </a>
                        <a href="about.php#founder" style="display: inline-block; padding: 1.25rem 2.5rem; background: var(--primary-yellow); color: var(--primary-black); border: 3px solid var(--primary-yellow); font-weight: 700; font-size: 1rem; text-decoration: none; transition: all 0.3s; letter-spacing: 0.5px;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='8px 8px 0 rgba(255,193,7,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i> OUR STORY
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Overview -->
    <section id="mission" style="padding: 5rem 0; background: #fff;">
        <div class="container">
            <div class="text-center" style="margin-bottom: 3rem;">
                <div style="display: inline-block; padding: 0.4rem 1rem; background: var(--primary-yellow); color: var(--primary-black); font-weight: 700; font-size: 0.875rem; letter-spacing: 1px; margin-bottom: 1rem;">
                    WHO WE ARE
                </div>
                <h2 style="font-size: 2.5rem; font-weight: 800; color: var(--primary-black); margin-bottom: 0.75rem;">Our Mission & Vision</h2>
                <p style="font-size: 1.1rem; color: #666; max-width: 700px; margin: 0 auto;">Empowerment, protection, and long-term solutions — not just charity</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div style="border-left: 4px solid var(--primary-yellow); padding: 2rem; height: 100%; background: #fafafa;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 50px; height: 50px; background: var(--primary-yellow); color: var(--primary-black); font-size: 1.5rem; margin-bottom: 1.25rem;">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3 style="font-size: 1.4rem; font-weight: 700; margin-bottom: 1rem; color: var(--primary-black);">Our Mission</h3>
                        <p style="font-size: 1rem; line-height: 1.7; color: #666; margin: 0;">To provide love, care, education, and sustainable support to orphaned and vulnerable children while promoting dignity, protection, and community development in <?php echo htmlspecialchars($contactCity); ?> District.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div style="border-left: 4px solid var(--primary-yellow); padding: 2rem; height: 100%; background: #fafafa;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 50px; height: 50px; background: var(--primary-yellow); color: var(--primary-black); font-size: 1.5rem; margin-bottom: 1.25rem;">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3 style="font-size: 1.4rem; font-weight: 700; margin-bottom: 1rem; color: var(--primary-black);">Our Vision</h3>
                        <p style="font-size: 1rem; line-height: 1.7; color: #666; margin: 0;">A Uganda where no child is left behind simply because of the circumstances of their birth — where every child is loved, protected, educated, and empowered to reach their full potential.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Section - Our Impact -->
    <section id="video-impact" style="position: relative; padding: 6rem 0; background: linear-gradient(135deg, rgba(0, 0, 0, 0.80) 0%, rgba(0, 0, 0, 0.75) 100%), url('uploads/parallax-children.jpg') center/cover fixed;">
        <div class="container">
            <!-- Section Header -->
            <div class="text-center" style="margin-bottom: 4rem;">
                <div style="display: inline-block; padding: 0.4rem 1rem; background: var(--primary-yellow); color: var(--primary-black); font-weight: 700; font-size: 0.875rem; letter-spacing: 1px; margin-bottom: 1rem;">
                    SEE OUR IMPACT
                </div>
                <h2 style="font-size: 3rem; font-weight: 900; color: #fff; margin-bottom: 1rem; line-height: 1.2;">Changing Lives in Kasese District</h2>
                <p style="font-size: 1.15rem; color: rgba(255,255,255,0.85); max-width: 700px; margin: 0 auto;">Watch how your support transforms the lives of vulnerable children through education, care, and community development.</p>
            </div>

            <!-- Video and Stats -->
            <div class="row align-items-center g-4">
                <!-- Video Column -->
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <div style="position: relative; border: 3px solid var(--primary-yellow); background: #000; cursor: pointer; transition: transform 0.3s;" onclick="openVideoModal()" onmouseover="this.style.transform='translateY(-8px)'" onmouseout="this.style.transform='translateY(0)'">
                        <div style="position: relative; padding-bottom: 56.25%; overflow: hidden;">
                            <img src="https://img.youtube.com/vi/7zLncvKIgag/maxresdefault.jpg" alt="Watch Our Story" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; transition: all 0.3s;">
                                <div style="width: 90px; height: 90px; background: var(--primary-yellow); color: var(--primary-black); display: flex; align-items: center; justify-content: center; font-size: 2.25rem; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                    <i class="fas fa-play" style="margin-left: 6px;"></i>
                                </div>
                            </div>
                        </div>
                        <div style="padding: 1.5rem; background: var(--primary-black); border-top: 3px solid var(--primary-yellow);">
                            <p style="color: #fff; font-weight: 700; margin: 0; font-size: 1.05rem; letter-spacing: 0.3px;">
                                <i class="fas fa-play-circle" style="color: var(--primary-yellow); margin-right: 0.75rem; font-size: 1.25rem;"></i>
                                Watch: Our Impact in the Community
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Stats Column -->
                <div class="col-lg-5">
                    <div class="row g-3">
                        <div class="col-12">
                            <div style="border: 3px solid var(--primary-yellow); padding: 2rem; text-align: center; background: rgba(255,193,7,0.05); transition: all 0.3s;" onmouseover="this.style.background='rgba(255,193,7,0.1)'; this.style.transform='translateX(8px)'" onmouseout="this.style.background='rgba(255,193,7,0.05)'; this.style.transform='translateX(0)'">
                                <div style="font-size: 3.5rem; font-weight: 900; color: var(--primary-yellow); margin-bottom: 0.5rem; line-height: 1;">112+</div>
                                <div style="color: #fff; font-size: 1.1rem; font-weight: 700; letter-spacing: 1px;">CHILDREN HELPED</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div style="border: 3px solid var(--primary-yellow); padding: 1.5rem; text-align: center; background: rgba(255,193,7,0.05); transition: all 0.3s;" onmouseover="this.style.background='rgba(255,193,7,0.1)'; this.style.transform='translateY(-5px)'" onmouseout="this.style.background='rgba(255,193,7,0.05)'; this.style.transform='translateY(0)'">
                                <div style="font-size: 2.75rem; font-weight: 900; color: var(--primary-yellow); margin-bottom: 0.5rem; line-height: 1;">20+</div>
                                <div style="color: #fff; font-size: 0.9rem; font-weight: 700; letter-spacing: 0.5px;">STUDENTS EDUCATED</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div style="border: 3px solid var(--primary-yellow); padding: 1.75rem; text-align: center; background: rgba(255,193,7,0.05); transition: all 0.3s;" onmouseover="this.style.background='rgba(255,193,7,0.1)'; this.style.transform='translateX(8px)'" onmouseout="this.style.background='rgba(255,193,7,0.05)'; this.style.transform='translateX(0)'">
                                <div style="font-size: 3rem; font-weight: 900; color: var(--primary-yellow); margin-bottom: 0.5rem; line-height: 1;">3+</div>
                                <div style="color: #fff; font-size: 1rem; font-weight: 700; letter-spacing: 1px;">YEARS OF SERVICE</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Modal -->
    <div id="videoModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.95); z-index: 99999; align-items: center; justify-content: center; padding: 2rem;" onclick="closeVideoModal()">
        <div style="position: relative; width: 100%; max-width: 1200px;" onclick="event.stopPropagation()">
            <button onclick="closeVideoModal()" style="position: absolute; top: -50px; right: 0; background: var(--primary-yellow); color: var(--primary-black); border: none; width: 45px; height: 45px; cursor: pointer; font-size: 1.5rem; font-weight: 700; z-index: 10;">
                ×
            </button>
            <div style="position: relative; padding-bottom: 56.25%; background: #000;">
                <iframe id="videoIframe" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <script>
    function openVideoModal() {
        const modal = document.getElementById('videoModal');
        const iframe = document.getElementById('videoIframe');
        iframe.src = 'https://www.youtube.com/embed/7zLncvKIgag?autoplay=1&rel=0';
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    function closeVideoModal() {
        const modal = document.getElementById('videoModal');
        const iframe = document.getElementById('videoIframe');
        iframe.src = '';
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeVideoModal();
        }
    });
    </script>

    <!-- Latest News Section -->
    <section id="latest-news" style="position: relative; padding: 5rem 0; background: linear-gradient(180deg, rgba(255,193,7,0.05) 0%, #fff 100%);">
        <div class="container">
            <div class="text-center" style="margin-bottom: 3rem;">
                <div style="display: inline-block; padding: 0.4rem 1rem; background: var(--primary-yellow); color: var(--primary-black); font-weight: 700; font-size: 0.875rem; letter-spacing: 1px; margin-bottom: 1rem;">
                    LATEST UPDATES
                </div>
                <h2 style="font-size: 2.5rem; font-weight: 800; color: var(--primary-black); margin-bottom: 0.75rem;">News & Articles</h2>
                <p style="font-size: 1.1rem; color: #666; max-width: 700px; margin: 0 auto;">Stay informed about our activities, success stories, and community impact</p>
            </div>
            <div class="row g-3">
                <?php 
                $first = true;
                foreach ($latestNews as $news): 
                ?>
                <?php if ($first): ?>
                <!-- Featured Large Card -->
                <div class="col-lg-6">
                    <a href="news-detail.php?id=<?php echo $news['id']; ?>" style="text-decoration: none; display: block;">
                        <div style="border: 3px solid var(--primary-black); background: #fff; height: 100%; overflow: hidden; position: relative; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                            <?php if (!empty($news['featured_image'])): 
                                $newsImgPath = $news['featured_image'];
                                if (strpos($newsImgPath, '/') === false) {
                                    $newsImgPath = 'news/' . $newsImgPath;
                                }
                            ?>
                            <div style="height: 400px; overflow: hidden; position: relative;">
                                <img src="uploads/<?php echo htmlspecialchars($newsImgPath); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                <div style="position: absolute; top: 1rem; left: 1rem; background: var(--primary-yellow); color: var(--primary-black); padding: 0.4rem 0.8rem; font-weight: 700; font-size: 0.75rem; letter-spacing: 1px;">
                                    FEATURED
                                </div>
                            </div>
                            <?php endif; ?>
                            <div style="padding: 2rem;">
                                <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1rem; font-size: 0.875rem; color: #666; font-weight: 600;">
                                    <span><i class="far fa-calendar" style="color: var(--primary-yellow); margin-right: 0.35rem;"></i><?php echo date('M d, Y', strtotime($news['published_at'])); ?></span>
                                    <?php if (!empty($news['category'])): ?>
                                    <span style="background: var(--primary-black); color: #fff; padding: 0.25rem 0.6rem; font-size: 0.75rem; letter-spacing: 0.5px;"><?php echo strtoupper(htmlspecialchars($news['category'])); ?></span>
                                    <?php endif; ?>
                                </div>
                                <h3 style="font-size: 1.75rem; font-weight: 700; margin-bottom: 1rem; line-height: 1.3; color: var(--primary-black);">
                                    <?php echo htmlspecialchars($news['title']); ?>
                                </h3>
                                <p style="color: #666; font-size: 1rem; line-height: 1.6; margin: 0;">
                                    <?php echo htmlspecialchars(substr(strip_tags($news['content'] ?? ''), 0, 180)); ?>...
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php 
                $first = false;
                continue;
                endif; 
                ?>
                
                <!-- Small Cards -->
                <div class="col-lg-3 col-md-6">
                    <a href="news-detail.php?id=<?php echo $news['id']; ?>" style="text-decoration: none; display: block; height: 100%;">
                        <div style="border: 2px solid var(--primary-black); background: #fff; height: 100%; overflow: hidden; display: flex; flex-direction: column; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
                            <?php if (!empty($news['featured_image'])): 
                                $smallNewsImgPath = $news['featured_image'];
                                if (strpos($smallNewsImgPath, '/') === false) {
                                    $smallNewsImgPath = 'news/' . $smallNewsImgPath;
                                }
                            ?>
                            <div style="height: 180px; overflow: hidden;">
                                <img src="uploads/<?php echo htmlspecialchars($smallNewsImgPath); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <?php endif; ?>
                            <div style="padding: 1.25rem; flex: 1; display: flex; flex-direction: column;">
                                <div style="margin-bottom: 0.75rem; font-size: 0.75rem; color: #666; font-weight: 600;">
                                    <i class="far fa-calendar" style="color: var(--primary-yellow); margin-right: 0.35rem;"></i><?php echo date('M d, Y', strtotime($news['published_at'])); ?>
                                </div>
                                <h4 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.75rem; line-height: 1.3; color: var(--primary-black); flex: 1;">
                                    <?php echo htmlspecialchars($news['title']); ?>
                                </h4>
                                <div style="color: var(--primary-yellow); font-size: 0.875rem; font-weight: 700;">
                                    READ MORE <i class="fas fa-arrow-right" style="margin-left: 0.35rem;"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center" style="margin-top: 3rem;">
                <a href="news.php" style="display: inline-block; background: var(--primary-yellow); color: var(--primary-black); padding: 0.875rem 2.5rem; font-weight: 700; text-decoration: none; border: 3px solid var(--primary-black); font-size: 0.95rem; letter-spacing: 0.5px; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='4px 4px 0 var(--primary-black)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    VIEW ALL NEWS <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Upcoming Events Section -->
    <section id="upcoming-events" style="position: relative; padding: 5rem 0; background: linear-gradient(135deg, rgba(0,0,0,0.80) 0%, rgba(0,0,0,0.75) 100%), url('https://images.unsplash.com/photo-1511578314322-379afb476865?w=1920') center/cover fixed;">
        <div class="container">
            <div class="text-center" style="margin-bottom: 3rem;">
                <div style="display: inline-block; padding: 0.4rem 1rem; background: var(--primary-yellow); color: var(--primary-black); font-weight: 700; font-size: 0.875rem; letter-spacing: 1px; margin-bottom: 1rem;">
                    HAPPENING SOON
                </div>
                <h2 style="font-size: 2.5rem; font-weight: 800; color: #fff; margin-bottom: 0.75rem;">Upcoming Events</h2>
                <p style="font-size: 1.1rem; color: rgba(255,255,255,0.85); max-width: 700px; margin: 0 auto;">Join us in our community activities and make a difference</p>
            </div>
            <div class="row g-3">
                <?php foreach ($upcomingEvents as $event): ?>
                <div class="col-lg-4 col-md-6">
                    <a href="event-detail.php?id=<?php echo $event['id']; ?>" style="text-decoration: none; display: block;">
                        <div style="border: 3px solid var(--primary-yellow); background: #fff; height: 100%; overflow: hidden; display: flex; flex-direction: column; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 30px rgba(255,193,7,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <?php if (!empty($event['featured_image'])): 
                                $eventImgPath = $event['featured_image'];
                                if (strpos($eventImgPath, '/') === false) {
                                    $eventImgPath = 'events/' . $eventImgPath;
                                }
                            ?>
                            <div style="height: 220px; overflow: hidden; position: relative;">
                                <img src="uploads/<?php echo htmlspecialchars($eventImgPath); ?>" alt="<?php echo htmlspecialchars($event['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                <div style="position: absolute; top: 1.25rem; right: 1.25rem; background: var(--primary-yellow); color: var(--primary-black); padding: 0.75rem 1rem; border: 2px solid var(--primary-black); text-align: center; min-width: 75px;">
                                    <div style="font-size: 1.75rem; font-weight: 900; line-height: 1;"><?php echo date('d', strtotime($event['start_datetime'])); ?></div>
                                    <div style="font-size: 0.75rem; font-weight: 700; letter-spacing: 1px; margin-top: 0.15rem;"><?php echo strtoupper(date('M', strtotime($event['start_datetime']))); ?></div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div style="padding: 1.75rem; flex: 1; display: flex; flex-direction: column;">
                                <h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 1.25rem; line-height: 1.3; color: var(--primary-black);">
                                    <?php echo htmlspecialchars($event['title']); ?>
                                </h3>
                                <div style="display: flex; flex-direction: column; gap: 0.875rem; margin-bottom: 1.25rem; color: #666; font-size: 0.95rem; font-weight: 600;">
                                    <div style="display: flex; align-items: center;">
                                        <div style="width: 35px; height: 35px; background: var(--primary-yellow); color: var(--primary-black); display: flex; align-items: center; justify-content: center; margin-right: 0.75rem; font-size: 0.9rem;">
                                            <i class="far fa-clock"></i>
                                        </div>
                                        <span><?php echo date('l, g:i A', strtotime($event['start_datetime'])); ?></span>
                                    </div>
                                    <?php if (!empty($event['venue'])): ?>
                                    <div style="display: flex; align-items: center;">
                                        <div style="width: 35px; height: 35px; background: var(--primary-yellow); color: var(--primary-black); display: flex; align-items: center; justify-content: center; margin-right: 0.75rem; font-size: 0.9rem;">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <span><?php echo htmlspecialchars($event['venue']); ?></span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem; flex: 1;">
                                    <?php echo htmlspecialchars(substr(strip_tags($event['description'] ?? ''), 0, 110)); ?>...
                                </p>
                                <div style="display: inline-flex; align-items: center; background: var(--primary-black); color: #fff; padding: 0.75rem 1.5rem; align-self: flex-start; font-weight: 700; font-size: 0.875rem;">
                                    VIEW DETAILS <i class="fas fa-arrow-right" style="margin-left: 0.75rem;"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center" style="margin-top: 3rem;">
                <a href="events.php" style="display: inline-block; background: transparent; color: #fff; padding: 0.875rem 2.5rem; font-weight: 700; text-decoration: none; border: 3px solid #fff; font-size: 0.95rem; letter-spacing: 0.5px; transition: all 0.3s;" onmouseover="this.style.background='#fff'; this.style.color='var(--primary-black)'" onmouseout="this.style.background='transparent'; this.style.color='#fff'">
                    VIEW ALL EVENTS <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Causes Section -->
    <section id="featured-causes" style="padding: 5rem 0; background: #fff;">
        <div class="container">
            <div class="text-center" style="margin-bottom: 3rem;">
                <div style="display: inline-block; padding: 0.4rem 1rem; background: var(--primary-yellow); color: var(--primary-black); font-weight: 700; font-size: 0.875rem; letter-spacing: 1px; margin-bottom: 1rem;">
                    MAKE AN IMPACT
                </div>
                <h2 style="font-size: 2.5rem; font-weight: 800; color: var(--primary-black); margin-bottom: 0.75rem;">Active Fundraising Causes</h2>
                <p style="font-size: 1.1rem; color: #666; max-width: 700px; margin: 0 auto;">Every donation brings hope and transforms lives</p>
            </div>
            <div class="row g-3">
                <?php foreach ($featuredCauses as $cause): 
                    $percentage = $cause['goal_amount'] > 0 ? ($cause['raised_amount'] / $cause['goal_amount']) * 100 : 0;
                ?>
                <div class="col-lg-4 col-md-6">
                    <div style="border: 3px solid var(--primary-black); background: #fff; height: 100%; overflow: hidden; display: flex; flex-direction: column; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='8px 8px 0 var(--primary-yellow)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <?php if (!empty($cause['featured_image'])): 
                            $causeImgPath = $cause['featured_image'];
                            if (strpos($causeImgPath, '/') === false) {
                                $causeImgPath = 'causes/' . $causeImgPath;
                            }
                        ?>
                        <div style="height: 250px; overflow: hidden; position: relative;">
                            <img src="uploads/<?php echo htmlspecialchars($causeImgPath); ?>" alt="<?php echo htmlspecialchars($cause['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.85), transparent); padding: 1.5rem 1.25rem 1rem;">
                                <div style="display: inline-block; background: var(--primary-yellow); color: var(--primary-black); padding: 0.35rem 0.75rem; font-weight: 800; font-size: 0.75rem; letter-spacing: 1px; margin-bottom: 0.5rem;">
                                    <?php echo round($percentage); ?>% FUNDED
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div style="padding: 1.75rem; flex: 1; display: flex; flex-direction: column;">
                            <h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 1rem; line-height: 1.3; color: var(--primary-black);">
                                <a href="cause-detail.php?id=<?php echo $cause['id']; ?>" style="color: var(--primary-black); text-decoration: none;">
                                    <?php echo htmlspecialchars($cause['title']); ?>
                                </a>
                            </h3>
                            <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem; flex: 1;">
                                <?php echo htmlspecialchars(substr(strip_tags($cause['description'] ?? ''), 0, 100)); ?>...
                            </p>
                            
                            <!-- Progress Bar -->
                            <div style="margin-bottom: 1.5rem;">
                                <div style="height: 12px; background: #e9ecef; border: 2px solid var(--primary-black); position: relative; overflow: hidden;">
                                    <div style="background: var(--primary-yellow); width: <?php echo $percentage; ?>%; height: 100%; transition: width 0.3s;"></div>
                                </div>
                                <div style="display: flex; justify-content: space-between; margin-top: 1rem; gap: 1rem;">
                                    <div style="flex: 1;">
                                        <div style="font-size: 0.75rem; color: #999; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.25rem;">Raised</div>
                                        <div style="font-size: 1.1rem; font-weight: 800; color: var(--primary-black);"><?php echo formatCurrency($cause['raised_amount']); ?></div>
                                    </div>
                                    <div style="flex: 1; text-align: right;">
                                        <div style="font-size: 0.75rem; color: #999; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.25rem;">Goal</div>
                                        <div style="font-size: 1.1rem; font-weight: 800; color: var(--primary-black);"><?php echo formatCurrency($cause['goal_amount']); ?></div>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="donation-step1.php?cause=<?php echo $cause['id']; ?>" style="display: block; background: var(--primary-yellow); color: var(--primary-black); padding: 0.875rem 1.5rem; font-weight: 700; text-decoration: none; border: 3px solid var(--primary-black); text-align: center; font-size: 0.95rem; letter-spacing: 0.5px; transition: all 0.3s;" onmouseover="this.style.background='var(--primary-black)'; this.style.color='#fff'" onmouseout="this.style.background='var(--primary-yellow)'; this.style.color='var(--primary-black)'">
                                DONATE <i class="fas fa-heart" style="margin-left: 0.5rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center" style="margin-top: 3rem;">
                <a href="causes.php" style="display: inline-block; background: var(--primary-black); color: #fff; padding: 0.875rem 2.5rem; font-weight: 700; text-decoration: none; border: 3px solid var(--primary-black); font-size: 0.95rem; letter-spacing: 0.5px; transition: all 0.3s;" onmouseover="this.style.background='transparent'; this.style.color='var(--primary-black)'" onmouseout="this.style.background='var(--primary-black)'; this.style.color='#fff'">
                    VIEW ALL CAUSES <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="cta" style="position: relative; padding: 6rem 0; background: linear-gradient(135deg, rgba(255,193,7,0.85) 0%, rgba(255,193,7,0.80) 100%), url('https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=1920') center/cover fixed;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <div style="display: inline-block; padding: 0.4rem 1rem; background: var(--primary-black); color: #fff; font-weight: 700; font-size: 0.875rem; letter-spacing: 1px; margin-bottom: 1.5rem;">
                        GET INVOLVED
                    </div>
                    <h2 style="font-size: 3rem; font-weight: 900; color: var(--primary-black); margin-bottom: 1.5rem; line-height: 1.2;">Transform Lives With Us</h2>
                    <p style="font-size: 1.2rem; color: var(--primary-black); line-height: 1.7; margin-bottom: 3rem; max-width: 750px; margin-left: auto; margin-right: auto;">Every child deserves love, education, and a chance at a better future. Your support makes real change in Kasese District.</p>
                    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                        <a href="donation-step1.php" style="display: inline-block; background: var(--primary-black); color: #fff; padding: 1rem 3rem; font-weight: 700; text-decoration: none; border: 3px solid var(--primary-black); font-size: 1rem; letter-spacing: 0.5px; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='8px 8px 0 rgba(0,0,0,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="fas fa-heart" style="margin-right: 0.5rem;"></i> DONATE
                        </a>
                        <a href="get-involved.php#volunteer" style="display: inline-block; background: transparent; color: var(--primary-black); padding: 1rem 3rem; font-weight: 700; text-decoration: none; border: 3px solid var(--primary-black); font-size: 1rem; letter-spacing: 0.5px; transition: all 0.3s;" onmouseover="this.style.background='var(--primary-black)'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='var(--primary-black)'">
                            <i class="fas fa-hands-helping" style="margin-right: 0.5rem;"></i> BECOME A VOLUNTEER
                        </a>
                        <a href="contact.php" style="display: inline-block; background: transparent; color: var(--primary-black); padding: 1rem 3rem; font-weight: 700; text-decoration: none; border: 3px solid var(--primary-black); font-size: 1rem; letter-spacing: 0.5px; transition: all 0.3s;" onmouseover="this.style.background='var(--primary-black)'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='var(--primary-black)'">
                            <i class="fas fa-envelope" style="margin-right: 0.5rem;"></i> CONTACT US
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
