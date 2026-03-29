<?php
/**
 * Setup Admin Users Module
 * Run this file once to create admin_users table
 */
require_once __DIR__ . '/config/auth.php';

echo "<h2>Admin Users Module Setup</h2>";

try {
    $pdo = getDBConnection();
    
    // Check if admin_users table exists
    $result = $pdo->query("SHOW TABLES LIKE 'admin_users'")->fetch();
    
    if (!$result) {
        // Create the table
        $pdo->exec("
            CREATE TABLE admin_users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                full_name VARCHAR(100) NOT NULL,
                email VARCHAR(255) NOT NULL UNIQUE,
                phone VARCHAR(50),
                role ENUM('super_admin', 'admin', 'editor') DEFAULT 'admin',
                status ENUM('active', 'inactive') DEFAULT 'active',
                avatar VARCHAR(255),
                last_login DATETIME,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_username (username),
                INDEX idx_email (email),
                INDEX idx_status (status)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        echo "✅ Created admin_users table<br>";
        
        // Insert default admin
        $defaultPassword = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("
            INSERT INTO admin_users (username, password, full_name, email, role, status) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute(['admin', $defaultPassword, 'Super Admin', 'admin@ulfacharity.org', 'super_admin', 'active']);
        echo "✅ Created default admin user<br>";
        echo "<br><strong>Default Login:</strong><br>";
        echo "Username: <code>admin</code><br>";
        echo "Password: <code>admin123</code><br>";
    } else {
        echo "✅ admin_users table already exists<br>";
        
        // Check for missing columns and add them
        $columns = [];
        $result = $pdo->query("DESCRIBE admin_users");
        while ($row = $result->fetch()) {
            $columns[] = $row['Field'];
        }
        
        $requiredColumns = [
            'phone' => "ALTER TABLE admin_users ADD COLUMN phone VARCHAR(50) AFTER email",
            'role' => "ALTER TABLE admin_users ADD COLUMN role ENUM('super_admin', 'admin', 'editor') DEFAULT 'admin' AFTER phone",
            'status' => "ALTER TABLE admin_users ADD COLUMN status ENUM('active', 'inactive') DEFAULT 'active' AFTER role",
            'avatar' => "ALTER TABLE admin_users ADD COLUMN avatar VARCHAR(255) AFTER status",
            'last_login' => "ALTER TABLE admin_users ADD COLUMN last_login DATETIME AFTER avatar",
            'updated_at' => "ALTER TABLE admin_users ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"
        ];
        
        foreach ($requiredColumns as $col => $sql) {
            if (!in_array($col, $columns)) {
                try {
                    $pdo->exec($sql);
                    echo "✅ Added '$col' column<br>";
                } catch (PDOException $e) {
                    echo "⚠️ Could not add '$col' column: " . $e->getMessage() . "<br>";
                }
            }
        }
    }
    
    // Show current table structure
    echo "<br><strong>Current table structure:</strong><br>";
    echo "<pre>";
    $result = $pdo->query("DESCRIBE admin_users");
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "{$row['Field']} - {$row['Type']} - Default: {$row['Default']}\n";
    }
    echo "</pre>";
    
    // Count admins
    $count = $pdo->query("SELECT COUNT(*) FROM admin_users")->fetchColumn();
    echo "<br>Total admin users: <strong>$count</strong><br>";
    
    echo "<br>✅ <strong>Admin Users module setup complete!</strong><br>";
    echo "<br><a href='admins.php'>Go to Admin Users →</a>";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
