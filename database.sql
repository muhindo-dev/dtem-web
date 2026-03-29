-- Create database
CREATE DATABASE IF NOT EXISTS ulfa_charity CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE ulfa_charity;

-- Create contact inquiries table (replaces enrollments)
CREATE TABLE IF NOT EXISTS contact_inquiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    subject VARCHAR(100) NOT NULL,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    INDEX idx_created_at (created_at DESC),
    INDEX idx_email (email),
    INDEX idx_subject (subject)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
