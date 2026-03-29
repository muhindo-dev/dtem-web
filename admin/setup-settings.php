<?php
/**
 * Setup Site Settings Module
 * Run this file once to create site_settings table
 */
require_once __DIR__ . '/config/auth.php';

echo "<h2>Site Settings Module Setup</h2>";

try {
    $pdo = getDBConnection();
    
    // Check if site_settings table exists
    $result = $pdo->query("SHOW TABLES LIKE 'site_settings'")->fetch();
    
    if (!$result) {
        // Create the table
        $pdo->exec("
            CREATE TABLE site_settings (
                id INT AUTO_INCREMENT PRIMARY KEY,
                setting_key VARCHAR(100) NOT NULL UNIQUE,
                setting_value TEXT,
                setting_type ENUM('text', 'textarea', 'image', 'boolean') DEFAULT 'text',
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_key (setting_key)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        echo "✅ Created site_settings table<br>";
        
        // Insert default settings
        $defaultSettings = [
            ['site_name', 'DTEHM Health Ministries', 'text'],
            ['site_tagline', 'DTEHM Health Ministries - Transforming Lives Together', 'text'],
            ['site_description', 'A non-profit organization dedicated to making a positive impact in our community.', 'textarea'],
            ['contact_email', 'info@ulfacharity.org', 'text'],
            ['contact_phone', '+1 234 567 8900', 'text'],
            ['contact_address', '123 Charity Street, City, Country', 'textarea'],
            ['facebook_url', '', 'text'],
            ['twitter_url', '', 'text'],
            ['instagram_url', '', 'text'],
            ['linkedin_url', '', 'text'],
            ['youtube_url', '', 'text'],
            ['site_logo', '', 'image'],
            ['site_favicon', '', 'image'],
            ['maintenance_mode', '0', 'boolean'],
            ['footer_text', '© 2026 DTEHM - DTEHM Health Ministries. All rights reserved.', 'text']
        ];
        
        $stmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value, setting_type) VALUES (?, ?, ?)");
        foreach ($defaultSettings as $setting) {
            $stmt->execute($setting);
        }
        echo "✅ Inserted default settings<br>";
    } else {
        echo "✅ site_settings table already exists<br>";
    }
    
    // Show current settings
    echo "<br><strong>Current settings:</strong><br>";
    echo "<table border='1' cellpadding='5' style='border-collapse: collapse;'>";
    echo "<tr><th>Key</th><th>Value</th><th>Type</th></tr>";
    $result = $pdo->query("SELECT setting_key, setting_value, setting_type FROM site_settings ORDER BY setting_key");
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $value = strlen($row['setting_value']) > 50 ? substr($row['setting_value'], 0, 50) . '...' : $row['setting_value'];
        echo "<tr>";
        echo "<td><strong>{$row['setting_key']}</strong></td>";
        echo "<td>" . htmlspecialchars($value) . "</td>";
        echo "<td>{$row['setting_type']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Count settings
    $count = $pdo->query("SELECT COUNT(*) FROM site_settings")->fetchColumn();
    echo "<br>Total settings: <strong>$count</strong><br>";
    
    echo "<br>✅ <strong>Site Settings module setup complete!</strong><br>";
    echo "<br><a href='settings.php'>Go to Site Settings →</a>";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
