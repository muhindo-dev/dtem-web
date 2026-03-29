-- Settings Setup SQL
-- Run this to populate missing settings with default values

-- Organization Info (only insert if not exists)
INSERT IGNORE INTO site_settings (setting_key, setting_value, created_at) VALUES
('site_name', 'United Love for All (ULFA)', NOW()),
('site_short_name', 'ULFA', NOW()),
('site_tagline', 'United Love for All', NOW()),
('site_description', 'United Love for All (ULFA) is dedicated to providing comprehensive care, education, and sustainable support to orphaned and vulnerable children in Kasese District, Uganda.', NOW()),
('founding_year', '2015', NOW()),
('registration_number', '', NOW());

-- Mission & Vision
INSERT IGNORE INTO site_settings (setting_key, setting_value, created_at) VALUES
('mission_statement', 'To provide holistic care, quality education, and sustainable livelihood opportunities to orphaned and vulnerable children in Kasese District, empowering them to become self-reliant and productive members of society.', NOW()),
('vision_statement', 'A community where every orphaned and vulnerable child has access to love, quality education, comprehensive healthcare, and opportunities to reach their full potential.', NOW());

-- Contact Info (using contact_ prefix - the system handles legacy site_ prefix too)
INSERT IGNORE INTO site_settings (setting_key, setting_value, created_at) VALUES
('contact_email', 'info@ulfa.org', NOW()),
('contact_phone', '+256 700 000 000', NOW()),
('contact_phone_alt', '', NOW()),
('contact_address', 'Mpondwe Lhubiriha, Kasese District, Uganda', NOW()),
('contact_city', 'Kasese', NOW()),
('contact_country', 'Uganda', NOW()),
('whatsapp_number', '+256700000000', NOW()),
('office_hours', 'Monday - Friday: 8:00 AM - 5:00 PM', NOW()),
('office_hours_weekend', 'Saturday: 9:00 AM - 1:00 PM', NOW()),
('google_maps_embed', '', NOW());

-- Currency Settings
INSERT IGNORE INTO site_settings (setting_key, setting_value, created_at) VALUES
('currency_code', 'UGX', NOW()),
('currency_symbol', 'UGX', NOW()),
('min_donation', '1000', NOW());

-- Branding
INSERT IGNORE INTO site_settings (setting_key, setting_value, created_at) VALUES
('logo_icon_class', 'fas fa-hands-helping', NOW()),
('primary_color', '#FFC107', NOW()),
('secondary_color', '#1A1A1A', NOW());

-- Footer
INSERT IGNORE INTO site_settings (setting_key, setting_value, created_at) VALUES
('footer_text', 'All rights reserved.', NOW()),
('footer_about', 'United Love for All is dedicated to providing comprehensive care, education, and sustainable support to orphaned and vulnerable children in Kasese District, Uganda.', NOW()),
('developer_name', 'Muhindo Mubaraka', NOW()),
('developer_url', '#', NOW());

-- Social Media (ensure all exist)
INSERT IGNORE INTO site_settings (setting_key, setting_value, created_at) VALUES
('facebook_url', '', NOW()),
('twitter_url', '', NOW()),
('instagram_url', '', NOW()),
('linkedin_url', '', NOW()),
('youtube_url', '', NOW()),
('tiktok_url', '', NOW());

-- WhatsApp Chat Integration
INSERT IGNORE INTO site_settings (setting_key, setting_value, created_at) VALUES
('enable_whatsapp_chat', '0', NOW()),
('whatsapp_default_message', 'Hello, I would like to know more about ULFA.', NOW());

-- SEO Settings
INSERT IGNORE INTO site_settings (setting_key, setting_value, created_at) VALUES
('meta_title', 'ULFA - United Love for All Orphanage Centre', NOW()),
('meta_description', 'United Love for All (ULFA) provides love, care, education, and sustainable support to orphaned and vulnerable children in Kasese District, Uganda.', NOW()),
('meta_keywords', 'orphanage, charity, Uganda, children, ULFA, Kasese, donate, volunteer', NOW()),
('og_title', 'ULFA - United Love for All', NOW()),
('og_description', 'United Love for All (ULFA) is dedicated to providing comprehensive care, education, and sustainable support to orphaned and vulnerable children.', NOW());

-- Analytics
INSERT IGNORE INTO site_settings (setting_key, setting_value, created_at) VALUES
('enable_google_analytics', '0', NOW()),
('google_analytics_id', '', NOW()),
('facebook_pixel_id', '', NOW());

-- Advanced Settings
INSERT IGNORE INTO site_settings (setting_key, setting_value, created_at) VALUES
('maintenance_mode', '0', NOW()),
('maintenance_message', 'We are currently performing maintenance. Please check back soon.', NOW()),
('notification_email', '', NOW()),
('show_donation_popup', '0', NOW()),
('custom_head_code', '', NOW()),
('custom_footer_code', '', NOW());

-- Bank Details (for manual donations)
INSERT IGNORE INTO site_settings (setting_key, setting_value, created_at) VALUES
('bank_name', '', NOW()),
('bank_account_name', '', NOW()),
('bank_account_number', '', NOW()),
('bank_swift_code', '', NOW()),
('mobile_money_number', '', NOW());

-- Show results
SELECT setting_key, 
       CASE 
           WHEN setting_key LIKE '%secret%' OR setting_key LIKE '%password%' THEN '********'
           WHEN LENGTH(setting_value) > 40 THEN CONCAT(LEFT(setting_value, 40), '...')
           ELSE setting_value 
       END as setting_value
FROM site_settings 
ORDER BY setting_key;
