<?php 
$currentPage = 'causes';
include 'config.php';
include 'functions.php';

// Get settings
$siteShortName = getSetting('site_short_name', 'DTEHM');
$siteName = getSetting('site_name', 'DTEHM Health Ministries');
$currency = getCurrency();

$pageTitle = 'Causes';
$pageDescription = 'Support our active causes and help us make a difference in the lives of vulnerable children at ' . $siteShortName . '.';
include 'includes/header.php';

// Filter
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'active';

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 9;
$offset = ($page - 1) * $perPage;

// Build query based on filter
if ($filter === 'completed') {
    $sql = "SELECT * FROM causes WHERE status = 'completed' ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
    $countSql = "SELECT COUNT(*) FROM causes WHERE status = 'completed'";
} else {
    $sql = "SELECT * FROM causes WHERE status = 'active' ORDER BY is_featured DESC, created_at DESC LIMIT :limit OFFSET :offset";
    $countSql = "SELECT COUNT(*) FROM causes WHERE status = 'active'";
}

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$causes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get total count
$totalCauses = $pdo->query($countSql)->fetchColumn();
$totalPages = ceil($totalCauses / $perPage);

// Get total raised
$totalRaisedStmt = $pdo->query("SELECT SUM(raised_amount) FROM causes WHERE status = 'active'");
$totalRaised = $totalRaisedStmt->fetchColumn();
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1>Our Causes</h1>
        <p>Support the causes that make a difference in communities</p>
    </div>
</div>

<!-- Filter Tabs -->
<section style="padding: 2rem 0; background: #f8f9fa; border-bottom: 2px solid var(--primary-blue);">
    <div class="container">
        <div class="d-flex justify-content-center gap-3">
            <a href="causes.php?filter=active" class="btn" style="border: 2px solid var(--primary-blue); background: <?php echo $filter === 'active' ? 'var(--primary-yellow)' : 'transparent'; ?>; color: <?php echo $filter === 'active' ? 'var(--white)' : 'var(--primary-blue)'; ?>; padding: 0.75rem 2rem; font-weight: 600; text-decoration: none;">
                <i class="fas fa-hand-holding-heart me-2"></i> Active Causes
            </a>
            <a href="causes.php?filter=completed" class="btn" style="border: 2px solid var(--primary-blue); background: <?php echo $filter === 'completed' ? 'var(--primary-yellow)' : 'transparent'; ?>; color: <?php echo $filter === 'completed' ? 'var(--white)' : 'var(--primary-blue)'; ?>; padding: 0.75rem 2rem; font-weight: 600; text-decoration: none;">
                <i class="fas fa-check-circle me-2"></i> Completed Causes
            </a>
        </div>
    </div>
</section>

<!-- Causes Grid -->
<section style="padding: 80px 0; background: #fff;">
    <div class="container">
        <?php if (empty($causes)): ?>
            <div class="text-center" style="padding: 3rem 0;">
                <i class="fas fa-hand-holding-heart" style="font-size: 4rem; color: #ddd; margin-bottom: 1rem;"></i>
                <h3 style="color: #666;">No <?php echo $filter; ?> causes found</h3>
                <p style="color: #999;">Check back soon for new causes!</p>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($causes as $cause): 
                    $percentage = $cause['goal_amount'] > 0 ? ($cause['raised_amount'] / $cause['goal_amount']) * 100 : 0;
                    $percentage = min($percentage, 100); // Cap at 100%
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="cause-card" style="border: 2px solid var(--primary-blue); border-radius: 0; overflow: hidden; height: 100%; display: flex; flex-direction: column; background: #fff; position: relative; transition: transform 0.3s;">
                        <?php if ($cause['is_featured']): ?>
                        <div style="position: absolute; top: 1rem; right: 1rem; z-index: 10; background: var(--primary-yellow); color: var(--white); padding: 0.5rem 1rem; border: 2px solid var(--primary-blue); font-weight: 700; font-size: 0.85rem;">
                            <i class="fas fa-star"></i> FEATURED
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($cause['cause_image'])): ?>
                        <div class="cause-image" style="height: 240px; overflow: hidden; position: relative;">
                            <img src="uploads/<?php echo htmlspecialchars($cause['cause_image']); ?>" alt="<?php echo htmlspecialchars($cause['title']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php if ($filter === 'completed'): ?>
                            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.6); display: flex; align-items: center; justify-content: center;">
                                <div style="text-align: center; color: #fff;">
                                    <i class="fas fa-check-circle" style="font-size: 3rem; margin-bottom: 0.5rem;"></i>
                                    <div style="font-size: 1.2rem; font-weight: 700;">Goal Achieved!</div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <div class="cause-content" style="padding: 1.75rem; flex: 1; display: flex; flex-direction: column;">
                            <h3 style="font-size: 1.35rem; font-weight: 600; margin-bottom: 1rem; line-height: 1.3;">
                                <a href="cause-detail.php?id=<?php echo $cause['id']; ?>" style="color: var(--primary-blue); text-decoration: none;">
                                    <?php echo htmlspecialchars($cause['title']); ?>
                                </a>
                            </h3>
                            <p style="color: #666; font-size: 0.95rem; margin-bottom: 1.75rem; flex: 1;">
                                <?php echo htmlspecialchars(substr(strip_tags($cause['description']), 0, 130)); ?>...
                            </p>
                            <div class="cause-progress">
                                <div class="progress" style="height: 12px; background: #e9ecef; border: 2px solid var(--primary-blue); border-radius: 0; margin-bottom: 1rem; overflow: hidden;">
                                    <div class="progress-bar" style="background: var(--primary-yellow); width: <?php echo $percentage; ?>%; transition: width 0.6s ease;"></div>
                                </div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem; font-size: 0.95rem;">
                                    <div>
                                        <div style="color: #999; font-size: 0.85rem; margin-bottom: 0.25rem;">Raised</div>
                                        <div style="font-weight: 700; color: var(--primary-blue); font-size: 1.1rem;"><?php echo formatCurrency($cause['raised_amount']); ?></div>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="color: #999; font-size: 0.85rem; margin-bottom: 0.25rem;">Goal</div>
                                        <div style="font-weight: 700; color: var(--primary-blue); font-size: 1.1rem;"><?php echo formatCurrency($cause['goal_amount']); ?></div>
                                    </div>
                                </div>
                                <div style="text-align: center; color: var(--primary-green); font-weight: 700; font-size: 1.1rem; margin-bottom: 1.5rem;">
                                    <?php echo number_format($percentage, 1); ?>% Funded
                                </div>
                            </div>
                            <?php if ($filter === 'completed'): ?>
                            <a href="cause-detail.php?id=<?php echo $cause['id']; ?>" class="btn btn-sm" style="border: 2px solid var(--primary-blue); background: var(--primary-yellow); color: var(--white); padding: 0.75rem 1.75rem; font-weight: 700; text-decoration: none; text-align: center; display: block; font-size: 1rem;">
                                View Details <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                            <?php else: ?>
                            <a href="donation-step1.php?cause=<?php echo $cause['id']; ?>" class="btn btn-sm" style="border: 2px solid var(--primary-blue); background: var(--primary-yellow); color: var(--white); padding: 0.75rem 1.75rem; font-weight: 700; text-decoration: none; text-align: center; display: block; font-size: 1rem;">
                                Donate <i class="fas fa-heart ms-2"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
            <nav aria-label="Causes pagination" style="margin-top: 3rem;">
                <ul class="pagination justify-content-center" style="gap: 0.5rem;">
                    <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="causes.php?filter=<?php echo $filter; ?>&page=<?php echo $page - 1; ?>" style="border: 2px solid var(--primary-blue); background: transparent; color: var(--primary-blue); padding: 0.5rem 1rem; text-decoration: none;">
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
                            <a class="page-link" href="causes.php?filter=<?php echo $filter; ?>&page=<?php echo $i; ?>" style="border: 2px solid var(--primary-blue); background: transparent; color: var(--primary-blue); padding: 0.5rem 1rem; text-decoration: none;">
                                <?php echo $i; ?>
                            </a>
                        </li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="causes.php?filter=<?php echo $filter; ?>&page=<?php echo $page + 1; ?>" style="border: 2px solid var(--primary-blue); background: transparent; color: var(--primary-blue); padding: 0.5rem 1rem; text-decoration: none;">
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

<!-- CTA -->
<section style="padding: 80px 0; background: #f8f9fa;">
    <div class="container text-center">
        <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 1rem; color: var(--primary-blue);">Every Contribution Counts</h2>
        <p style="font-size: 1.1rem; margin-bottom: 2rem; color: #666; max-width: 700px; margin-left: auto; margin-right: auto;">
            No amount is too small. Your donation directly impacts the lives of vulnerable children in our community, providing them with education, care, and hope for a brighter future.
        </p>
        <a href="get-involved.php#donate" class="btn" style="border: 2px solid var(--primary-blue); background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue)); color: #fff; padding: 1rem 2.5rem; font-weight: 700; text-decoration: none; display: inline-block; font-size: 1.1rem;">
            <i class="fas fa-heart me-2"></i> Make a Donation
        </a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
