<?php
/**
 * Donations Management - View Single Donation
 * 
 * Displays detailed information about a specific donation including
 * Pesapal transaction details and ability to manually verify status.
 * 
 * @author DTEHM Development Team
 * @version 1.0.0
 * @since 2026-01-20
 */
require_once 'config/auth.php';
require_once 'config/crud-helper.php';
require_once '../includes/PesapalHelper.php';
require_once __DIR__ . '/../functions.php';

requireAdmin();
checkSessionTimeout();

$currentAdmin = getCurrentAdmin();
$currentPage = 'donations';
$pageTitle = 'View Donation';

$id = $_GET['id'] ?? 0;
if (!$id) {
    header('Location: donations.php');
    exit;
}

$pdo = getDBConnection();

// Get donation with cause info
$stmt = $pdo->prepare("
    SELECT d.*, c.title as cause_title, c.id as cause_id_ref
    FROM donations d 
    LEFT JOIN causes c ON d.cause_id = c.id 
    WHERE d.id = ?
");
$stmt->execute([$id]);
$donation = $stmt->fetch();

if (!$donation) {
    $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Donation not found.'];
    header('Location: donations.php');
    exit;
}

// Handle manual status verification
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify_status'])) {
    // Get Pesapal settings
    $settingsStmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings WHERE setting_key LIKE 'pesapal_%'");
    $pesapal_settings = [];
    while ($row = $settingsStmt->fetch()) {
        $pesapal_settings[$row['setting_key']] = $row['setting_value'];
    }
    
    if (!empty($pesapal_settings['pesapal_consumer_key']) && 
        !empty($pesapal_settings['pesapal_consumer_secret']) &&
        !empty($donation['order_tracking_id'])) {
        
        try {
            $pesapal = new PesapalHelper(
                $pesapal_settings['pesapal_consumer_key'],
                $pesapal_settings['pesapal_consumer_secret'],
                $pesapal_settings['pesapal_environment'] ?? 'live',
                $pesapal_settings['pesapal_ipn_id'] ?? ''
            );
            
            $status_result = $pesapal->getTransactionStatus($donation['order_tracking_id']);
            
            if ($status_result['success']) {
                $new_status = $status_result['status'];
                $payment_method = $status_result['data']['payment_method'] ?? null;
                $confirmation_code = $status_result['data']['confirmation_code'] ?? null;
                
                // Update donation
                $updateStmt = $pdo->prepare("
                    UPDATE donations SET 
                        payment_status = ?,
                        payment_method = COALESCE(?, payment_method),
                        confirmation_code = COALESCE(?, confirmation_code),
                        completed_at = CASE WHEN ? = 'completed' AND completed_at IS NULL THEN NOW() ELSE completed_at END,
                        updated_at = NOW()
                    WHERE id = ?
                ");
                $updateStmt->execute([$new_status, $payment_method, $confirmation_code, $new_status, $id]);
                
                // Update cause raised_amount if completed
                if ($new_status === 'completed' && $donation['payment_status'] !== 'completed' && $donation['cause_id']) {
                    $pdo->prepare("UPDATE causes SET raised_amount = raised_amount + ? WHERE id = ?")
                        ->execute([$donation['amount'], $donation['cause_id']]);
                }
                
                $_SESSION['alert'] = ['type' => 'success', 'message' => 'Status verified: ' . ucfirst($new_status)];
                header("Location: donations-view.php?id=$id");
                exit;
            } else {
                $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Verification failed: ' . ($status_result['error'] ?? 'Unknown error')];
            }
        } catch (Exception $e) {
            $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Error: ' . $e->getMessage()];
        }
    } else {
        $_SESSION['alert'] = ['type' => 'warning', 'message' => 'Cannot verify: Missing Pesapal configuration or tracking ID.'];
    }
    
    header("Location: donations-view.php?id=$id");
    exit;
}

include 'includes/header.php';
?>

<style>
.donation-detail {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 1.5rem;
}
@media (max-width: 900px) {
    .donation-detail { grid-template-columns: 1fr; }
}
.detail-card {
    background: #fff;
    border: 2px solid #1a1a1a;
    padding: 0;
}
.detail-card-header {
    background: #1a1a1a;
    color: #fff;
    padding: 1rem;
    font-weight: 700;
}
.detail-card-body {
    padding: 1.5rem;
}
.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 0.75rem 0;
    border-bottom: 1px solid #eee;
}
.detail-row:last-child { border-bottom: none; }
.detail-label {
    color: #666;
    font-size: 0.9rem;
}
.detail-value {
    font-weight: 600;
    text-align: right;
}
.status-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    font-weight: 700;
    font-size: 0.9rem;
}
.status-completed { background: #d4edda; color: #155724; }
.status-pending { background: #fff3cd; color: #856404; }
.status-failed { background: #f8d7da; color: #721c24; }
.status-reversed { background: #e2e3e5; color: #383d41; }
.amount-highlight {
    font-size: 2rem;
    font-weight: 800;
    color: #1a1a1a;
}
.message-box {
    background: #f8f9fa;
    padding: 1rem;
    border-left: 4px solid #ffc107;
    margin-top: 1rem;
    font-style: italic;
}
.action-buttons {
    display: flex;
    gap: 0.5rem;
    margin-top: 1.5rem;
}
.timeline {
    margin-top: 1rem;
}
.timeline-item {
    display: flex;
    gap: 1rem;
    padding: 0.75rem 0;
    border-bottom: 1px dashed #ddd;
}
.timeline-item:last-child { border-bottom: none; }
.timeline-icon {
    width: 32px;
    height: 32px;
    background: #ffc107;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.timeline-content {
    flex: 1;
}
.timeline-time {
    font-size: 0.8rem;
    color: #888;
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
        <h1>
            <a href="donations.php" class="btn-back"><i class="fas fa-arrow-left"></i></a>
            Donation #<?php echo $donation['id']; ?>
        </h1>
        <div class="header-actions">
            <span class="status-badge status-<?php echo $donation['payment_status']; ?>">
                <?php echo strtoupper($donation['payment_status']); ?>
            </span>
        </div>
    </div>

    <div class="donation-detail">
        <!-- Main Details -->
        <div>
            <div class="detail-card">
                <div class="detail-card-header">
                    <i class="fas fa-user"></i> Donor Information
                </div>
                <div class="detail-card-body">
                    <div class="detail-row">
                        <span class="detail-label">Name</span>
                        <span class="detail-value">
                            <?php echo htmlspecialchars($donation['donor_name']); ?>
                            <?php if ($donation['is_anonymous']): ?>
                                <span class="badge badge-secondary">Anonymous</span>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Email</span>
                        <span class="detail-value">
                            <a href="mailto:<?php echo htmlspecialchars($donation['donor_email']); ?>">
                                <?php echo htmlspecialchars($donation['donor_email']); ?>
                            </a>
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Phone</span>
                        <span class="detail-value"><?php echo htmlspecialchars($donation['donor_phone'] ?: '-'); ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">IP Address</span>
                        <span class="detail-value"><?php echo htmlspecialchars($donation['ip_address'] ?: '-'); ?></span>
                    </div>
                    
                    <?php if ($donation['message']): ?>
                        <div class="message-box">
                            <strong>Message:</strong><br>
                            <?php echo nl2br(htmlspecialchars($donation['message'])); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="detail-card" style="margin-top: 1.5rem;">
                <div class="detail-card-header">
                    <i class="fas fa-credit-card"></i> Payment Details
                </div>
                <div class="detail-card-body">
                    <div class="detail-row">
                        <span class="detail-label">Merchant Reference</span>
                        <span class="detail-value" style="font-family: monospace;">
                            <?php echo htmlspecialchars($donation['merchant_reference']); ?>
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Pesapal Tracking ID</span>
                        <span class="detail-value" style="font-family: monospace; font-size: 0.85rem;">
                            <?php echo htmlspecialchars($donation['order_tracking_id'] ?: '-'); ?>
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Payment Method</span>
                        <span class="detail-value"><?php echo htmlspecialchars($donation['payment_method'] ?: '-'); ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Confirmation Code</span>
                        <span class="detail-value" style="font-family: monospace;">
                            <?php echo htmlspecialchars($donation['confirmation_code'] ?: '-'); ?>
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Currency</span>
                        <span class="detail-value"><?php echo htmlspecialchars($donation['currency']); ?></span>
                    </div>
                </div>
            </div>

            <!-- Timeline -->
            <div class="detail-card" style="margin-top: 1.5rem;">
                <div class="detail-card-header">
                    <i class="fas fa-history"></i> Timeline
                </div>
                <div class="detail-card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-icon"><i class="fas fa-plus"></i></div>
                            <div class="timeline-content">
                                <strong>Donation Initiated</strong>
                                <div class="timeline-time"><?php echo date('d M Y, H:i:s', strtotime($donation['created_at'])); ?></div>
                            </div>
                        </div>
                        <?php if ($donation['completed_at']): ?>
                            <div class="timeline-item">
                                <div class="timeline-icon" style="background: #28a745;"><i class="fas fa-check" style="color:#fff;"></i></div>
                                <div class="timeline-content">
                                    <strong>Payment Completed</strong>
                                    <div class="timeline-time"><?php echo date('d M Y, H:i:s', strtotime($donation['completed_at'])); ?></div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($donation['updated_at'] && $donation['updated_at'] !== $donation['created_at']): ?>
                            <div class="timeline-item">
                                <div class="timeline-icon" style="background: #17a2b8;"><i class="fas fa-sync" style="color:#fff;"></i></div>
                                <div class="timeline-content">
                                    <strong>Last Updated</strong>
                                    <div class="timeline-time"><?php echo date('d M Y, H:i:s', strtotime($donation['updated_at'])); ?></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <div class="detail-card">
                <div class="detail-card-header">
                    <i class="fas fa-hand-holding-usd"></i> Amount
                </div>
                <div class="detail-card-body" style="text-align: center;">
                    <div class="amount-highlight">
                        <?php echo formatCurrency($donation['amount']); ?>
                    </div>
                    <div style="margin-top: 0.5rem; color: #666;">
                        <?php if ($donation['cause_title']): ?>
                            For: <strong><?php echo htmlspecialchars($donation['cause_title']); ?></strong>
                        <?php else: ?>
                            <em>General Fund</em>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="detail-card" style="margin-top: 1.5rem;">
                <div class="detail-card-header">
                    <i class="fas fa-cog"></i> Actions
                </div>
                <div class="detail-card-body">
                    <?php if ($donation['payment_status'] === 'pending' && $donation['order_tracking_id']): ?>
                        <form method="POST" style="margin-bottom: 1rem;">
                            <button type="submit" name="verify_status" class="btn-primary" style="width: 100%;">
                                <i class="fas fa-sync"></i> Verify Payment Status
                            </button>
                        </form>
                        <p style="font-size: 0.8rem; color: #666; margin-bottom: 1rem;">
                            Check Pesapal for the latest payment status.
                        </p>
                    <?php endif; ?>
                    
                    <a href="mailto:<?php echo htmlspecialchars($donation['donor_email']); ?>?subject=Thank%20you%20for%20your%20donation%20to%20DTEHM" 
                       class="btn-secondary" style="width: 100%; display: block; text-align: center; margin-bottom: 0.5rem;">
                        <i class="fas fa-envelope"></i> Email Donor
                    </a>
                    
                    <a href="donations.php" class="btn-outline" style="width: 100%; display: block; text-align: center;">
                        <i class="fas fa-arrow-left"></i> Back to Donations
                    </a>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="detail-card" style="margin-top: 1.5rem;">
                <div class="detail-card-header">
                    <i class="fas fa-chart-pie"></i> Donor Stats
                </div>
                <div class="detail-card-body">
                    <?php
                    // Get donor's total donations
                    $donorStats = $pdo->prepare("
                        SELECT COUNT(*) as total_donations, SUM(amount) as total_amount
                        FROM donations 
                        WHERE donor_email = ? AND payment_status = 'completed'
                    ");
                    $donorStats->execute([$donation['donor_email']]);
                    $stats = $donorStats->fetch();
                    ?>
                    <div class="detail-row">
                        <span class="detail-label">Total Donations</span>
                        <span class="detail-value"><?php echo $stats['total_donations'] ?? 0; ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Total Contributed</span>
                        <span class="detail-value"><?php echo formatCurrency($stats['total_amount'] ?? 0); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
