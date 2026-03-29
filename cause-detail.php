<?php 
$currentPage = 'causes';
$pageTitle = 'Cause Details';
include 'config.php';
include 'functions.php';

// Get settings
$siteShortName = getSetting('site_short_name', 'DTEHM');
$currency = getCurrency();

// Get cause
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM causes WHERE id = ?");
$stmt->execute([$id]);
$cause = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cause) {
    header('Location: causes.php');
    exit;
}

$pageTitle = $cause['title'] . ' - ' . $siteShortName;
$pageDescription = substr(strip_tags($cause['description']), 0, 160);

$percentage = $cause['goal_amount'] > 0 ? ($cause['raised_amount'] / $cause['goal_amount']) * 100 : 0;
$percentage = min($percentage, 100);
$remaining = max(0, $cause['goal_amount'] - $cause['raised_amount']);

// Get related causes (same category, excluding current)
$relatedStmt = $pdo->prepare("SELECT * FROM causes WHERE status = 'active' AND id != ? ORDER BY is_featured DESC, created_at DESC LIMIT 3");
$relatedStmt->execute([$id]);
$relatedCauses = $relatedStmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';

// Cause Structured Data
$causeImage = !empty($cause['featured_image']) ? 'https://dtehmhealth.com/uploads/' . $cause['featured_image'] : '';
?>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FundraisingCampaign",
    "name": "<?php echo htmlspecialchars($cause['title']); ?>",
    "description": "<?php echo htmlspecialchars($pageDescription); ?>",
    "image": "<?php echo $causeImage; ?>",
    "url": "<?php echo 'https://dtehmhealth.com/cause-detail.php?id=' . $cause['id']; ?>",
    "goal": {
        "@type": "MonetaryAmount",
        "currency": "UGX",
        "value": "<?php echo $cause['goal_amount']; ?>"
    },
    "raised": {
        "@type": "MonetaryAmount",
        "currency": "UGX",
        "value": "<?php echo $cause['raised_amount']; ?>"
    },
    "organizer": {
        "@type": "Organization",
        "name": "DTEHM Health Ministries",
        "url": "https://dtehmhealth.com"
    }
}
</script>

<!-- Page Header -->
<section style="padding: 140px 0 80px; background: linear-gradient(135deg, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.9) 100%), url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1920') center/cover fixed;">
    <div class="container">
        <div class="text-center">
            <div style="margin-bottom: 1.5rem;">
                <a href="causes.php" style="color: var(--white); text-decoration: none; font-weight: 700; font-size: 0.95rem; letter-spacing: 0.5px; transition: all 0.3s;" onmouseover="this.style.transform='translateX(-5px)'; this.style.color='#fff'" onmouseout="this.style.transform='translateX(0)'; this.style.color='var(--primary-yellow)'">
                    <i class="fas fa-arrow-left" style="margin-right: 0.5rem;"></i> BACK TO CAUSES
                </a>
            </div>
            <?php if ($cause['is_featured']): ?>
            <div style="margin-bottom: 1.5rem;">
                <span style="display: inline-block; padding: 0.5rem 1.25rem; background: var(--primary-yellow); color: var(--primary-black); font-weight: 700; font-size: 0.875rem; letter-spacing: 1px; border: 3px solid var(--primary-yellow);">
                    <i class="fas fa-star"></i> FEATURED CAUSE
                </span>
            </div>
            <?php endif; ?>
            <?php if ($cause['status'] === 'completed'): ?>
            <div style="margin-bottom: 1.5rem;">
                <span style="display: inline-block; padding: 0.5rem 1.25rem; background: #28a745; color: #fff; font-weight: 700; font-size: 0.875rem; letter-spacing: 1px; border: 3px solid #28a745;">
                    <i class="fas fa-check-circle"></i> GOAL ACHIEVED
                </span>
            </div>
            <?php endif; ?>
            <h1 style="color: #fff; font-size: clamp(2rem, 4vw, 3.5rem); font-weight: 900; margin-bottom: 0; max-width: 900px; margin-left: auto; margin-right: auto; line-height: 1.2;">
                <?php echo htmlspecialchars($cause['title']); ?>
            </h1>
        </div>
    </div>
</section>

<!-- Cause Content -->
<section style="padding: 5rem 0; background: #fff;">
    <div class="container">
        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <?php if ($cause['featured_image']): ?>
                <div style="margin-bottom: 3rem; border: 2px solid var(--primary-blue); overflow: hidden;">
                    <img src="<?php echo htmlspecialchars($cause['featured_image']); ?>" alt="<?php echo htmlspecialchars($cause['title']); ?>" style="width: 100%; height: auto; display: block;">
                </div>
                <?php endif; ?>
                
                <div style="margin-bottom: 2rem;">
                    <div style="display: inline-block; padding: 0.4rem 1rem; background: var(--primary-yellow); color: var(--primary-black); font-weight: 700; font-size: 0.875rem; letter-spacing: 1px; margin-bottom: 1rem;">
                        ABOUT THIS CAUSE
                    </div>
                    <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 1.5rem; color: var(--primary-black);">Making A Difference</h2>
                </div>
                <div style="font-size: 1.05rem; line-height: 1.9; color: #444; margin-bottom: 3rem;">
                    <?php echo $cause['description']; ?>
                </div>

                <!-- Impact Section -->
                <div style="border: 2px solid var(--primary-blue); padding: 3rem; background: linear-gradient(135deg, rgba(255,193,7,0.08) 0%, rgba(255,193,7,0.03) 100%); margin-bottom: 2rem;">
                    <div style="text-align: center; margin-bottom: 1.5rem;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 70px; height: 70px; background: var(--primary-yellow); color: var(--primary-black); font-size: 2rem; margin-bottom: 1rem;">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3 style="font-size: 1.75rem; font-weight: 800; color: var(--primary-black);">Your Impact Matters</h3>
                    </div>
                    <p style="font-size: 1.1rem; line-height: 1.8; color: #555; text-align: center; margin-bottom: 0;">
                        Every donation brings us closer to achieving this goal and making a lasting difference in the lives of vulnerable children. Your support provides education, healthcare, nutrition, and a safe environment for children who need it most.
                    </p>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div style="position: sticky; top: 100px;">
                    <!-- Fundraising Progress Card -->
                    <div style="border: 2px solid var(--primary-blue); padding: 2.5rem; background: #fff; margin-bottom: 2rem; box-shadow: 0 4px 0 var(--primary-black);">
                        <div style="margin-bottom: 2rem;">
                            <div style="font-size: 0.875rem; font-weight: 700; color: #666; letter-spacing: 1px; margin-bottom: 1rem; text-align: center;">FUNDRAISING PROGRESS</div>
                            <div class="progress" style="height: 18px; background: #e9ecef; border: 2px solid var(--primary-blue); margin-bottom: 1.5rem; overflow: hidden;">
                                <div class="progress-bar" style="background: var(--primary-yellow); width: <?php echo $percentage; ?>%; transition: width 0.6s ease;"></div>
                            </div>
                        </div>
                        
                        <div style="text-align: center; margin-bottom: 2rem; padding: 1.5rem; background: rgba(255,193,7,0.1);">
                            <div style="font-size: 3.5rem; font-weight: 900; color: var(--primary-black); margin-bottom: 0.25rem; line-height: 1;">
                                <?php echo number_format($percentage, 1); ?>%
                            </div>
                            <div style="color: #666; font-weight: 700; font-size: 0.95rem; letter-spacing: 0.5px;">FUNDED</div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; padding-bottom: 1.5rem; margin-bottom: 1.5rem; border-bottom: 3px solid #e9ecef;">
                            <div style="text-align: center;">
                                <div style="color: #999; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem;">Raised</div>
                                <div style="font-weight: 800; color: var(--primary-black); font-size: 1.15rem;"><?php echo formatCurrency($cause['raised_amount']); ?></div>
                            </div>
                            <div style="text-align: center;">
                                <div style="color: #999; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem;">Goal</div>
                                <div style="font-weight: 800; color: var(--primary-black); font-size: 1.15rem;"><?php echo formatCurrency($cause['goal_amount']); ?></div>
                            </div>
                        </div>

                        <?php if ($cause['status'] === 'active'): ?>
                        <div style="text-align: center; margin-bottom: 2rem; padding: 1.25rem; background: rgba(255,193,7,0.1); border: 2px dashed var(--primary-yellow);">
                            <div style="color: #666; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem;">Still Needed</div>
                            <div style="font-weight: 900; color: var(--primary-black); font-size: 1.75rem;"><?php echo formatCurrency($remaining); ?></div>
                        </div>

                        <a href="donation-step1.php?cause=<?php echo $cause['id']; ?>" class="btn" style="width: 100%; border: 2px solid var(--primary-blue); background: var(--primary-yellow); color: var(--primary-black); padding: 1.25rem; font-weight: 700; text-align: center; text-decoration: none; display: block; font-size: 1.1rem; margin-bottom: 1rem; letter-spacing: 0.5px; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='6px 6px 0 var(--primary-black)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="fas fa-heart" style="margin-right: 0.5rem;"></i> DONATE
                        </a>

                        <div style="text-align: center; color: #666; font-size: 0.875rem; font-weight: 600;">
                            <i class="fas fa-shield-alt" style="color: var(--white); margin-right: 0.35rem;"></i> Secure donation processing
                        </div>
                        <?php else: ?>
                        <div style="text-align: center; padding: 2rem; background: #d4edda; border: 3px solid #28a745; color: #155724;">
                            <i class="fas fa-check-circle" style="font-size: 3rem; margin-bottom: 1rem; color: #28a745;"></i>
                            <div style="font-weight: 800; font-size: 1.3rem; margin-bottom: 0.5rem;">Goal Achieved!</div>
                            <div style="font-size: 0.95rem; font-weight: 600;">Thank you for your support</div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Share Card -->
                    <div style="border: 2px solid var(--primary-blue); padding: 2.5rem; background: linear-gradient(135deg, rgba(255,193,7,0.08) 0%, rgba(255,193,7,0.03) 100%);">
                        <h4 style="font-size: 1.25rem; font-weight: 800; margin-bottom: 1rem; color: var(--primary-black);">Share This Cause</h4>
                        <p style="font-size: 0.95rem; color: #666; margin-bottom: 1.5rem; font-weight: 500;">Help us reach more people and achieve our goal faster</p>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" style="display: flex; align-items: center; justify-content: center; height: 50px; border: 2px solid var(--primary-blue); background: #fff; color: var(--primary-black); text-decoration: none; font-weight: 700; font-size: 0.875rem; transition: all 0.3s;" onmouseover="this.style.background='var(--primary-black)'; this.style.color='#fff'" onmouseout="this.style.background='#fff'; this.style.color='var(--primary-black)'">
                                <i class="fab fa-facebook-f" style="margin-right: 0.5rem;"></i> Share
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode('Support: ' . $cause['title']); ?>" target="_blank" style="display: flex; align-items: center; justify-content: center; height: 50px; border: 2px solid var(--primary-blue); background: #fff; color: var(--primary-black); text-decoration: none; font-weight: 700; font-size: 0.875rem; transition: all 0.3s;" onmouseover="this.style.background='var(--primary-black)'; this.style.color='#fff'" onmouseout="this.style.background='#fff'; this.style.color='var(--primary-black)'">
                                <i class="fab fa-twitter" style="margin-right: 0.5rem;"></i> Tweet
                            </a>
                            <a href="whatsapp://send?text=<?php echo urlencode('Support this cause: ' . $cause['title'] . ' - ' . 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" style="grid-column: 1 / -1; display: flex; align-items: center; justify-content: center; height: 50px; border: 2px solid var(--primary-blue); background: #fff; color: var(--primary-black); text-decoration: none; font-weight: 700; font-size: 0.875rem; transition: all 0.3s;" onmouseover="this.style.background='var(--primary-black)'; this.style.color='#fff'" onmouseout="this.style.background='#fff'; this.style.color='var(--primary-black)'">
                                <i class="fab fa-whatsapp" style="margin-right: 0.5rem;"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Causes -->
<?php if (!empty($relatedCauses) && $cause['status'] === 'active'): ?>
<section style="padding: 5rem 0; background: linear-gradient(180deg, rgba(255,193,7,0.05) 0%, #fff 100%);">
    <div class="container">
        <div class="text-center" style="margin-bottom: 3.5rem;">
            <div style="display: inline-block; padding: 0.4rem 1rem; background: var(--primary-yellow); color: var(--primary-black); font-weight: 700; font-size: 0.875rem; letter-spacing: 1px; margin-bottom: 1rem;">
                MORE WAYS TO HELP
            </div>
            <h2 style="font-size: 2.5rem; font-weight: 800; color: var(--primary-black); margin-bottom: 0.75rem;">Other Causes to Support</h2>
            <p style="color: #666; font-size: 1.1rem;">Explore more opportunities to make a difference</p>
        </div>
        <div class="row g-4">
            <?php foreach ($relatedCauses as $related): 
                $relPercentage = $related['goal_amount'] > 0 ? ($related['raised_amount'] / $related['goal_amount']) * 100 : 0;
                $relPercentage = min($relPercentage, 100);
            ?>
            <div class="col-lg-4 col-md-6">
                <div style="border: 2px solid var(--primary-blue); overflow: hidden; height: 100%; display: flex; flex-direction: column; background: #fff; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='8px 8px 0 var(--primary-yellow)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <?php if ($related['featured_image']): ?>
                    <div style="height: 220px; overflow: hidden; position: relative;">
                        <img src="<?php echo htmlspecialchars($related['featured_image']); ?>" alt="<?php echo htmlspecialchars($related['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <div style="position: absolute; bottom: 1rem; left: 1rem; background: var(--primary-yellow); color: var(--primary-black); padding: 0.4rem 0.8rem; font-weight: 800; font-size: 0.85rem; letter-spacing: 0.5px;">
                            <?php echo number_format($relPercentage, 1); ?>% FUNDED
                        </div>
                    </div>
                    <?php endif; ?>
                    <div style="padding: 2rem; flex: 1; display: flex; flex-direction: column;">
                        <h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 1rem; line-height: 1.3;">
                            <a href="cause-detail.php?id=<?php echo $related['id']; ?>" style="color: var(--primary-black); text-decoration: none;">
                                <?php echo htmlspecialchars($related['title']); ?>
                            </a>
                        </h3>
                        <p style="color: #666; font-size: 0.95rem; margin-bottom: 1.5rem; flex: 1; line-height: 1.6;">
                            <?php echo htmlspecialchars(substr(strip_tags($related['description']), 0, 110)); ?>...
                        </p>
                        <div style="margin-bottom: 1.5rem;">
                            <div class="progress" style="height: 12px; background: #e9ecef; border: 2px solid var(--primary-blue); margin-bottom: 1rem;">
                                <div class="progress-bar" style="background: var(--primary-yellow); width: <?php echo $relPercentage; ?>%;"></div>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 0.85rem;">
                                <div>
                                    <div style="color: #999; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.25rem;">Raised</div>
                                    <div style="font-weight: 800; color: var(--primary-black);"><?php echo formatCurrency($related['raised_amount']); ?></div>
                                </div>
                                <div style="text-align: right;">
                                    <div style="color: #999; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.25rem;">Goal</div>
                                    <div style="font-weight: 800; color: var(--primary-black);"><?php echo formatCurrency($related['goal_amount']); ?></div>
                                </div>
                            </div>
                        </div>
                        <a href="cause-detail.php?id=<?php echo $related['id']; ?>" style="border: 2px solid var(--primary-blue); background: var(--primary-yellow); color: var(--primary-black); padding: 0.75rem 1.5rem; text-decoration: none; text-align: center; display: block; font-weight: 700; font-size: 0.9rem; letter-spacing: 0.5px; transition: all 0.3s;" onmouseover="this.style.background='var(--primary-black)'; this.style.color='#fff'" onmouseout="this.style.background='var(--primary-yellow)'; this.style.color='var(--primary-black)'">
                            VIEW DETAILS <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA -->
<section style="padding: 6rem 0; background: linear-gradient(135deg, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.9) 100%), url('https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=1920') center/cover fixed;">
    <div class="container text-center">
        <div style="display: inline-block; padding: 0.4rem 1rem; background: var(--primary-yellow); color: var(--primary-black); font-weight: 700; font-size: 0.875rem; letter-spacing: 1px; margin-bottom: 1.5rem;">
            GET INVOLVED
        </div>
        <h2 style="font-size: 3rem; font-weight: 900; margin-bottom: 1.5rem; color: #fff; line-height: 1.2;">Transform Lives Today</h2>
        <p style="font-size: 1.2rem; margin-bottom: 3rem; color: rgba(255,255,255,0.85); max-width: 750px; margin-left: auto; margin-right: auto; line-height: 1.7;">
            Your generosity creates lasting change. Join us in providing hope, education, and care to vulnerable children in Kasese District.
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="causes.php" style="border: 3px solid #fff; background: transparent; color: #fff; padding: 1rem 3rem; font-weight: 700; text-decoration: none; font-size: 1rem; letter-spacing: 0.5px; transition: all 0.3s;" onmouseover="this.style.background='#fff'; this.style.color='var(--primary-black)'" onmouseout="this.style.background='transparent'; this.style.color='#fff'">
                <i class="fas fa-hand-holding-heart" style="margin-right: 0.5rem;"></i> VIEW ALL CAUSES
            </a>
            <a href="get-involved.php" style="border: 3px solid var(--primary-yellow); background: var(--primary-yellow); color: var(--primary-black); padding: 1rem 3rem; font-weight: 700; text-decoration: none; font-size: 1rem; letter-spacing: 0.5px; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='8px 8px 0 rgba(255,193,7,0.5)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                <i class="fas fa-users" style="margin-right: 0.5rem;"></i> GET INVOLVED
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
