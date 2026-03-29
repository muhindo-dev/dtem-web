-- Site Settings Schema
-- Run this to create site_settings table

CREATE TABLE IF NOT EXISTS site_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT,
    setting_type ENUM('text', 'textarea', 'image', 'boolean') DEFAULT 'text',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_key (setting_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default settings
INSERT INTO site_settings (setting_key, setting_value, setting_type) VALUES
('site_name', 'ULFA Charity', 'text'),
('site_tagline', 'United Love for All - Transforming Lives Together', 'text'),
('site_description', 'A non-profit organization dedicated to making a positive impact in our community.', 'textarea'),
('contact_email', 'info@ulfacharity.org', 'text'),
('contact_phone', '+1 234 567 8900', 'text'),
('contact_address', '123 Charity Street, City, Country', 'textarea'),
('facebook_url', '', 'text'),
('twitter_url', '', 'text'),
('instagram_url', '', 'text'),
('linkedin_url', '', 'text'),
('youtube_url', '', 'text'),
('site_logo', '', 'image'),
('site_favicon', '', 'image'),
('maintenance_mode', '0', 'boolean'),
('footer_text', '© 2026 ULFA - United Love for All. All rights reserved.', 'text')
ON DUPLICATE KEY UPDATE id=id;
