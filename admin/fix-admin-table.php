<?php
/**
 * Fix admin_users table - Add missing columns
 */
require_once 'config/auth.php';

// Require login
requireLogin();

$pdo = getDBConnection();
$messages = [];

try {
    // Check if avatar column exists
    $stmt = $pdo->query("SHOW COLUMNS FROM admin_users LIKE 'avatar'");
    if (!$stmt->fetch()) {
        // Add avatar column
        $pdo->exec("ALTER TABLE admin_users ADD COLUMN avatar VARCHAR(255) DEFAULT NULL AFTER status");
        $messages[] = "Added 'avatar' column to admin_users table.";
    } else {
        $messages[] = "'avatar' column already exists.";
    }
    
    // Check if role column exists
    $stmt = $pdo->query("SHOW COLUMNS FROM admin_users LIKE 'role'");
    if (!$stmt->fetch()) {
        // Add role column
        $pdo->exec("ALTER TABLE admin_users ADD COLUMN role ENUM('super_admin', 'admin', 'editor') DEFAULT 'admin' AFTER status");
        $messages[] = "Added 'role' column to admin_users table.";
    } else {
        $messages[] = "'role' column already exists.";
    }
    
    // Check if last_login column exists
    $stmt = $pdo->query("SHOW COLUMNS FROM admin_users LIKE 'last_login'");
    if (!$stmt->fetch()) {
        // Add last_login column
        $pdo->exec("ALTER TABLE admin_users ADD COLUMN last_login DATETIME DEFAULT NULL");
        $messages[] = "Added 'last_login' column to admin_users table.";
    } else {
        $messages[] = "'last_login' column already exists.";
    }
    
    $success = true;
} catch (PDOException $e) {
    $messages[] = "Error: " . $e->getMessage();
    $success = false;
}

include 'includes/header.php';
?>

<div class="admin-content">
    <div class="content-header-compact">
        <h1><i class="fas fa-wrench"></i> Fix Admin Table</h1>
        <a href="admins.php" class="btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Back to Admins</a>
    </div>
    
    <div class="content-body">
        <div class="alert alert-<?php echo $success ? 'success' : 'danger'; ?>">
            <h4><?php echo $success ? 'Table Check Complete' : 'Error Occurred'; ?></h4>
            <ul>
                <?php foreach ($messages as $msg): ?>
                <li><?php echo htmlspecialchars($msg); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <p><a href="admins.php" class="btn btn-primary">Go to Admin Users</a></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
