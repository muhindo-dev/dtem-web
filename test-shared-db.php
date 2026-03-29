<?php
require_once 'config.php';

echo "DB Config: " . DB_HOST . ":" . (defined('DB_PORT') ? DB_PORT : '3306') . "/" . DB_NAME . "\n";

try {
    $dsn = "mysql:dbname=" . DB_NAME . ";unix_socket=" . DB_SOCKET . ";charset=utf8mb4";
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection: OK\n\n";
    
    echo "-- Website tables --\n";
    $tables = ['causes', 'events', 'news_posts', 'gallery_albums', 'gallery_images', 'team_members', 'donations', 'site_settings', 'contact_inquiries', 'admin_users', 'admin_activity_log'];
    foreach ($tables as $t) {
        $count = $pdo->query("SELECT COUNT(*) FROM $t")->fetchColumn();
        echo "  $t: $count rows\n";
    }
    
    echo "\n-- App tables (coexistence check) --\n";
    $appTables = ['users', 'products', 'orders', 'ordered_items'];
    foreach ($appTables as $t) {
        $count = $pdo->query("SELECT COUNT(*) FROM $t")->fetchColumn();
        echo "  $t: $count rows\n";
    }
    
    echo "\nSample data from causes:\n";
    $stmt = $pdo->query("SELECT id, title, status FROM causes LIMIT 5");
    foreach ($stmt as $row) {
        echo "  [{$row['id']}] {$row['title']} ({$row['status']})\n";
    }
    
    echo "\nAll good! Website and API share the database successfully.\n";
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
