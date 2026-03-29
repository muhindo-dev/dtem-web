<?php
/**
 * Donations Management - List View
 * 
 * Displays all donations with filtering, search, and export capabilities.
 * Integrated with Pesapal payment gateway.
 * 
 * @author DTEHM Development Team
 * @version 1.0.0
 * @since 2026-01-20
 */
require_once 'config/auth.php';
require_once 'config/crud-helper.php';
require_once __DIR__ . '/../functions.php';

requireAdmin();
checkSessionTimeout();

$currentAdmin = getCurrentAdmin();
$currentPage = 'donations';
$pageTitle = 'Donations';

// Pagination settings
$perPage = 20;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Get filters
$status = $_GET['status'] ?? '';
$search = $_GET['search'] ?? '';
$dateFrom = $_GET['date_from'] ?? '';
$dateTo = $_GET['date_to'] ?? '';
$causeId = $_GET['cause_id'] ?? '';

$pdo = getDBConnection();

// Build query
$conditions = [];
$params = [];

if ($search) {
    $conditions[] = "(d.donor_name LIKE ? OR d.donor_email LIKE ? OR d.donor_phone LIKE ? OR d.merchant_reference LIKE ? OR d.order_tracking_id LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if ($status) {
    $conditions[] = "d.payment_status = ?";
    $params[] = $status;
}

if ($dateFrom) {
    $conditions[] = "DATE(d.created_at) >= ?";
    $params[] = $dateFrom;
}

if ($dateTo) {
    $conditions[] = "DATE(d.created_at) <= ?";
    $params[] = $dateTo;
}

if ($causeId) {
    if ($causeId === 'general') {
        $conditions[] = "d.cause_id IS NULL";
    } else {
        $conditions[] = "d.cause_id = ?";
        $params[] = $causeId;
    }
}

$whereClause = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';

// Get total count
$countSql = "SELECT COUNT(*) FROM donations d $whereClause";
$stmt = $pdo->prepare($countSql);
$stmt->execute($params);
$totalRecords = $stmt->fetchColumn();

$totalPages = ceil($totalRecords / $perPage);
$page = max(1, min($page, $totalPages ?: 1));
$offset = ($page - 1) * $perPage;

// Get donations with cause info
$sql = "SELECT d.*, c.title as cause_title 
        FROM donations d 
        LEFT JOIN causes c ON d.cause_id = c.id 
        $whereClause 
        ORDER BY d.created_at DESC 
        LIMIT $perPage OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$donations = $stmt->fetchAll();

// Get statistics
$stats = [
    'total_amount' => 0,
    'completed_amount' => 0,
    'pending_count' => 0,
    'completed_count' => 0,
    'failed_count' => 0
];

$statsSql = "SELECT 
    SUM(amount) as total_amount,
    SUM(CASE WHEN payment_status = 'completed' THEN amount ELSE 0 END) as completed_amount,
    SUM(CASE WHEN payment_status = 'pending' THEN 1 ELSE 0 END) as pending_count,
    SUM(CASE WHEN payment_status = 'completed' THEN 1 ELSE 0 END) as completed_count,
    SUM(CASE WHEN payment_status = 'failed' THEN 1 ELSE 0 END) as failed_count
FROM donations";
$statsResult = $pdo->query($statsSql)->fetch();
if ($statsResult) {
    $stats = array_merge($stats, $statsResult);
}

// Get causes for filter dropdown
$causes = $pdo->query("SELECT id, title FROM causes ORDER BY title")->fetchAll();

include 'includes/header.php';
?>

<style>
.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}
.stat-card {
    background: #fff;
    border: 2px solid #1a1a1a;
    padding: 1rem;
    text-align: center;
}
.stat-card.success { border-left: 4px solid #28a745; }
.stat-card.warning { border-left: 4px solid #ffc107; }
.stat-card.danger { border-left: 4px solid #dc3545; }
.stat-card.primary { border-left: 4px solid #007bff; }
.stat-value {
    font-size: 1.75rem;
    font-weight: 800;
    color: #1a1a1a;
}
.stat-label {
    font-size: 0.8rem;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.badge-completed { background: #28a745; color: #fff; }
.badge-pending { background: #ffc107; color: #1a1a1a; }
.badge-failed { background: #dc3545; color: #fff; }
.badge-reversed { background: #6c757d; color: #fff; }
.amount-cell { font-weight: 700; font-family: monospace; }
.donor-anonymous { font-style: italic; color: #888; }
.filter-row {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    align-items: center;
}
.filter-row .form-control-sm {
    min-width: 120px;
}
.export-btn {
    margin-left: auto;
}
</style>

<div class="admin-content">
    <?php if (isset($_SESSION['alert'])): ?>
        <div class="alert alert-<?php echo $_SESSION['alert']['type']; ?>">
            <i class="fas fa-<?php echo $_SESSION['alert']['type'] == 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
            <?php echo $_SESSION['alert']['message']; ?>
        </div>
        <?php unset($_SESSION['alert']); ?>
    <?php endif; ?>
    
    <div class="content-header-compact">
        <h1><i class="fas fa-hand-holding-usd"></i> Donations</h1>
    </div>

    <!-- Statistics Row -->
    <div class="stats-row">
        <div class="stat-card success">
            <div class="stat-value"><?php echo formatCurrency($stats['completed_amount'] ?? 0); ?></div>
            <div class="stat-label">Total Collected</div>
        </div>
        <div class="stat-card primary">
            <div class="stat-value"><?php echo number_format($stats['completed_count'] ?? 0); ?></div>
            <div class="stat-label">Successful Donations</div>
        </div>
        <div class="stat-card warning">
            <div class="stat-value"><?php echo number_format($stats['pending_count'] ?? 0); ?></div>
            <div class="stat-label">Pending</div>
        </div>
        <div class="stat-card danger">
            <div class="stat-value"><?php echo number_format($stats['failed_count'] ?? 0); ?></div>
            <div class="stat-label">Failed</div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card" style="margin-bottom: 1rem; padding: 1rem;">
        <form method="GET" action="" class="filter-row">
            <input type="text" name="search" class="form-control-sm" placeholder="Search donor, email, ref..." 
                   value="<?php echo htmlspecialchars($search); ?>" style="min-width: 200px;">
            
            <select name="status" class="form-control-sm">
                <option value="">All Status</option>
                <option value="completed" <?php echo ($status == 'completed') ? 'selected' : ''; ?>>Completed</option>
                <option value="pending" <?php echo ($status == 'pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="failed" <?php echo ($status == 'failed') ? 'selected' : ''; ?>>Failed</option>
                <option value="reversed" <?php echo ($status == 'reversed') ? 'selected' : ''; ?>>Reversed</option>
            </select>
            
            <select name="cause_id" class="form-control-sm">
                <option value="">All Causes</option>
                <option value="general" <?php echo ($causeId == 'general') ? 'selected' : ''; ?>>General Fund</option>
                <?php foreach ($causes as $cause): ?>
                    <option value="<?php echo $cause['id']; ?>" <?php echo ($causeId == $cause['id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($cause['title']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <input type="date" name="date_from" class="form-control-sm" value="<?php echo $dateFrom; ?>" title="From Date">
            <input type="date" name="date_to" class="form-control-sm" value="<?php echo $dateTo; ?>" title="To Date">
            
            <button type="submit" class="btn-sm btn-secondary"><i class="fas fa-filter"></i> Filter</button>
            <a href="donations.php" class="btn-sm btn-outline"><i class="fas fa-times"></i> Clear</a>
            
            <a href="donations-export.php?<?php echo http_build_query($_GET); ?>" class="btn-sm btn-primary export-btn">
                <i class="fas fa-download"></i> Export CSV
            </a>
        </form>
    </div>

    <div class="card">
        <?php if (empty($donations)): ?>
            <div class="empty-state">
                <i class="fas fa-hand-holding-usd"></i>
                <p>No donations found</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table-compact">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th width="150">Donor</th>
                            <th width="180">Contact</th>
                            <th>Cause</th>
                            <th width="120" class="text-right">Amount</th>
                            <th width="90">Status</th>
                            <th width="100">Method</th>
                            <th width="130">Date</th>
                            <th width="80">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($donations as $donation): ?>
                            <tr>
                                <td data-label="ID">#<?php echo $donation['id']; ?></td>
                                <td data-label="Donor">
                                    <?php if ($donation['is_anonymous']): ?>
                                        <span class="donor-anonymous">Anonymous</span>
                                        <br><small class="text-muted">(<?php echo htmlspecialchars($donation['donor_name']); ?>)</small>
                                    <?php else: ?>
                                        <strong><?php echo htmlspecialchars($donation['donor_name']); ?></strong>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Contact">
                                    <a href="mailto:<?php echo htmlspecialchars($donation['donor_email']); ?>" class="email-link" style="font-size: 0.85rem;">
                                        <?php echo htmlspecialchars($donation['donor_email']); ?>
                                    </a>
                                    <?php if ($donation['donor_phone']): ?>
                                        <br><small class="text-muted"><?php echo htmlspecialchars($donation['donor_phone']); ?></small>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Cause">
                                    <?php if ($donation['cause_title']): ?>
                                        <?php echo htmlspecialchars($donation['cause_title']); ?>
                                    <?php else: ?>
                                        <span class="text-muted">General Fund</span>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Amount" class="text-right amount-cell">
                                    <?php echo formatCurrency($donation['amount']); ?>
                                </td>
                                <td data-label="Status">
                                    <span class="badge badge-<?php echo $donation['payment_status']; ?>">
                                        <?php echo ucfirst($donation['payment_status']); ?>
                                    </span>
                                </td>
                                <td data-label="Method">
                                    <?php echo $donation['payment_method'] ?: '-'; ?>
                                </td>
                                <td data-label="Date">
                                    <?php echo date('d M Y', strtotime($donation['created_at'])); ?>
                                    <br><small class="text-muted"><?php echo date('H:i', strtotime($donation['created_at'])); ?></small>
                                </td>
                                <td data-label="Actions">
                                    <a href="donations-view.php?id=<?php echo $donation['id']; ?>" class="btn-icon" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>" class="page-link">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    <?php endif; ?>
                    
                    <?php
                    $startPage = max(1, $page - 2);
                    $endPage = min($totalPages, $page + 2);
                    
                    if ($startPage > 1) {
                        echo '<a href="?' . http_build_query(array_merge($_GET, ['page' => 1])) . '" class="page-link">1</a>';
                        if ($startPage > 2) echo '<span class="page-ellipsis">...</span>';
                    }
                    
                    for ($i = $startPage; $i <= $endPage; $i++): ?>
                        <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>" 
                           class="page-link <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor;
                    
                    if ($endPage < $totalPages) {
                        if ($endPage < $totalPages - 1) echo '<span class="page-ellipsis">...</span>';
                        echo '<a href="?' . http_build_query(array_merge($_GET, ['page' => $totalPages])) . '" class="page-link">' . $totalPages . '</a>';
                    }
                    ?>
                    
                    <?php if ($page < $totalPages): ?>
                        <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>" class="page-link">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    
    <div style="margin-top: 1rem; font-size: 0.85rem; color: #666;">
        <i class="fas fa-info-circle"></i> 
        Showing <?php echo count($donations); ?> of <?php echo number_format($totalRecords); ?> donations
    </div>
</div>

<?php include 'includes/footer.php'; ?>
