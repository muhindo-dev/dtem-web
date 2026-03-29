<?php
/**
 * Setup Inquiries Module Database
 * Run this file once to add required columns to contact_inquiries table
 */
require_once __DIR__ . '/config/auth.php';

try {
    $pdo = getDBConnection();
    
    // Check if contact_inquiries table exists
    $result = $pdo->query("SHOW TABLES LIKE 'contact_inquiries'")->fetch();
    
    if (!$result) {
        // Create the table if it doesn't exist
        $pdo->exec("
            CREATE TABLE contact_inquiries (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                phone VARCHAR(50),
                subject VARCHAR(255) NOT NULL,
                message TEXT,
                status ENUM('new', 'read', 'replied', 'archived') DEFAULT 'new',
                reply_message TEXT,
                replied_at DATETIME,
                replied_by INT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                ip_address VARCHAR(45),
                INDEX idx_created_at (created_at DESC),
                INDEX idx_email (email),
                INDEX idx_subject (subject),
                INDEX idx_status (status)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        echo "✅ Created contact_inquiries table<br>";
    } else {
        echo "✅ contact_inquiries table exists<br>";
        
        // Check and add missing columns
        $columns = [];
        $result = $pdo->query("DESCRIBE contact_inquiries");
        while ($row = $result->fetch()) {
            $columns[] = $row['Field'];
        }
        
        // Add status column if not exists
        if (!in_array('status', $columns)) {
            $pdo->exec("ALTER TABLE contact_inquiries ADD COLUMN status ENUM('new', 'read', 'replied', 'archived') DEFAULT 'new' AFTER message");
            echo "✅ Added 'status' column<br>";
        }
        
        // Add reply_message column if not exists
        if (!in_array('reply_message', $columns)) {
            $pdo->exec("ALTER TABLE contact_inquiries ADD COLUMN reply_message TEXT AFTER status");
            echo "✅ Added 'reply_message' column<br>";
        }
        
        // Add replied_at column if not exists
        if (!in_array('replied_at', $columns)) {
            $pdo->exec("ALTER TABLE contact_inquiries ADD COLUMN replied_at DATETIME AFTER reply_message");
            echo "✅ Added 'replied_at' column<br>";
        }
        
        // Add replied_by column if not exists
        if (!in_array('replied_by', $columns)) {
            $pdo->exec("ALTER TABLE contact_inquiries ADD COLUMN replied_by INT AFTER replied_at");
            echo "✅ Added 'replied_by' column<br>";
        }
    }
    
    // Show current table structure
    echo "<br><strong>Current table structure:</strong><br>";
    echo "<pre>";
    $result = $pdo->query("DESCRIBE contact_inquiries");
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "{$row['Field']} - {$row['Type']} - {$row['Null']} - Default: {$row['Default']}\n";
    }
    echo "</pre>";
    
    echo "<br>✅ <strong>Inquiries module setup complete!</strong><br>";
    echo "<br><a href='inquiries.php'>Go to Inquiries Module →</a>";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
