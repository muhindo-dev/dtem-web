-- Inquiries Module Schema
-- Run this to add status and reply fields to contact_inquiries table

-- Add status column if not exists
ALTER TABLE contact_inquiries 
ADD COLUMN IF NOT EXISTS status ENUM('new', 'read', 'replied', 'archived') DEFAULT 'new' AFTER message;

-- Add reply fields if not exists
ALTER TABLE contact_inquiries 
ADD COLUMN IF NOT EXISTS reply_message TEXT AFTER status;

ALTER TABLE contact_inquiries 
ADD COLUMN IF NOT EXISTS replied_at DATETIME AFTER reply_message;

ALTER TABLE contact_inquiries 
ADD COLUMN IF NOT EXISTS replied_by INT AFTER replied_at;

-- Add index for status
ALTER TABLE contact_inquiries 
ADD INDEX IF NOT EXISTS idx_status (status);

-- If table doesn't exist, create it fresh
CREATE TABLE IF NOT EXISTS contact_inquiries (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
