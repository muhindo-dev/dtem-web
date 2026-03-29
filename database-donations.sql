-- ULFA Donation System Database Structure
-- Add Pesapal settings to site_settings table and create donations table

USE ulfa_charity;

-- Add Pesapal credentials to site_settings (if not exists)
INSERT INTO site_settings (setting_key, setting_value, setting_group) VALUES
('pesapal_consumer_key', '', 'payment'),
('pesapal_consumer_secret', '', 'payment'),
('pesapal_environment', 'sandbox', 'payment'),
('pesapal_ipn_url', '', 'payment')
ON DUPLICATE KEY UPDATE setting_key=setting_key;

-- Create donations table
CREATE TABLE IF NOT EXISTS donations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- Donor Information
    donor_name VARCHAR(255) NOT NULL,
    donor_email VARCHAR(255) NOT NULL,
    donor_phone VARCHAR(50),
    donor_address TEXT,
    
    -- Donation Details
    amount DECIMAL(12, 2) NOT NULL,
    currency VARCHAR(10) DEFAULT 'UGX',
    cause_id INT NULL,
    message TEXT,
    is_anonymous TINYINT(1) DEFAULT 0,
    
    -- Pesapal Transaction Details
    pesapal_tracking_id VARCHAR(255) UNIQUE,
    pesapal_merchant_reference VARCHAR(255) UNIQUE NOT NULL,
    pesapal_payment_method VARCHAR(100),
    
    -- Payment Status
    payment_status ENUM('pending', 'completed', 'failed', 'cancelled') DEFAULT 'pending',
    payment_date DATETIME NULL,
    
    -- Metadata
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Indexes
    INDEX idx_donor_email (donor_email),
    INDEX idx_payment_status (payment_status),
    INDEX idx_cause_id (cause_id),
    INDEX idx_created_at (created_at DESC),
    INDEX idx_merchant_ref (pesapal_merchant_reference),
    INDEX idx_tracking_id (pesapal_tracking_id),
    
    -- Foreign key
    FOREIGN KEY (cause_id) REFERENCES causes(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Add donation count and total to causes table
ALTER TABLE causes 
ADD COLUMN total_donations DECIMAL(12, 2) DEFAULT 0 AFTER raised_amount,
ADD COLUMN donation_count INT DEFAULT 0 AFTER total_donations;
