<?php
// Quick database setup script
require_once 'config.php';

echo "<h1>Database Setup</h1>";
echo "<style>body { font-family: Arial; padding: 2rem; } .success { color: green; font-weight: bold; } .error { color: red; font-weight: bold; }</style>";

try {
    // Connect without database name first to create it
    $dsn = "mysql:host=" . DB_HOST . ";unix_socket=" . DB_SOCKET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "<p class='success'>✓ Database '" . DB_NAME . "' created/verified successfully</p>";
    
    // Use the database
    $pdo->exec("USE " . DB_NAME);
    
    // Create table
    $sql = "CREATE TABLE IF NOT EXISTS enrollments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(50) NOT NULL,
        course VARCHAR(100) NOT NULL,
        message TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        ip_address VARCHAR(45),
        INDEX idx_created_at (created_at DESC),
        INDEX idx_email (email)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql);
    echo "<p class='success'>✓ Table 'enrollments' created/verified successfully</p>";
    
    echo "<h2>Setup Complete!</h2>";
    echo "<p>Your database is ready to use.</p>";
    echo "<p><a href='test.php'>Run Tests</a> | <a href='index.php'>Go to Homepage</a> | <a href='admin.php'>Go to Admin Panel</a></p>";
    
} catch (PDOException $e) {
    echo "<p class='error'>✗ Error: " . $e->getMessage() . "</p>";
    echo "<p>Please check your database configuration in config.php</p>";
    echo "<pre>";
    echo "DB_HOST: " . DB_HOST . "\n";
    echo "DB_NAME: " . DB_NAME . "\n";
    echo "DB_USER: " . DB_USER . "\n";
    echo "DB_SOCKET: " . DB_SOCKET . "\n";
    echo "</pre>";
}
?>
