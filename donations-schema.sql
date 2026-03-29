-- ========================================
-- ULFA Donations System Database Schema
-- For use with Pesapal API 3.0
-- ========================================

USE ulfa_charity;

-- ========================================
-- Donations Table
-- Stores all donation records and payment info
-- ========================================
CREATE TABLE IF NOT EXISTS donations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- Donor Information
    donor_name VARCHAR(255) NOT NULL,
    donor_email VARCHAR(255) NOT NULL,
    donor_phone VARCHAR(50) NOT NULL,
    
    -- Donation Details
    amount DECIMAL(12, 2) NOT NULL,
    currency VARCHAR(10) DEFAULT 'UGX',
    cause_id INT NULL,
    message TEXT NULL,
    is_anonymous TINYINT(1) DEFAULT 0,
    
    -- Pesapal Transaction Details
    merchant_reference VARCHAR(100) NOT NULL UNIQUE,
    order_tracking_id VARCHAR(255) NULL,
    payment_method VARCHAR(100) NULL,
    confirmation_code VARCHAR(255) NULL,
    
    -- Payment Status
    -- pending, completed, failed, reversed, invalid
    payment_status ENUM('pending', 'completed', 'failed', 'reversed', 'invalid') DEFAULT 'pending',
    
    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    completed_at DATETIME NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Metadata
    ip_address VARCHAR(45) NULL,
    
    -- Indexes for faster lookups
    INDEX idx_donor_email (donor_email),
    INDEX idx_payment_status (payment_status),
    INDEX idx_cause_id (cause_id),
    INDEX idx_created_at (created_at DESC),
    INDEX idx_merchant_reference (merchant_reference),
    INDEX idx_order_tracking_id (order_tracking_id),
    
    -- Foreign key to causes table
    FOREIGN KEY (cause_id) REFERENCES causes(id) ON DELETE SET NULL
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Add Pesapal Settings to site_settings
-- ========================================
INSERT INTO site_settings (setting_key, setting_value, setting_type, description) VALUES
    ('pesapal_environment', 'sandbox', 'text', 'Pesapal environment: sandbox or live'),
    ('pesapal_consumer_key', '', 'text', 'Pesapal Consumer Key'),
    ('pesapal_consumer_secret', '', 'text', 'Pesapal Consumer Secret'),
    ('pesapal_ipn_id', '', 'text', 'Pesapal IPN Notification ID')
ON DUPLICATE KEY UPDATE setting_key = setting_key;

-- ========================================
-- End of Schema
-- ========================================
