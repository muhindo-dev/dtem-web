-- ========================================
-- ULFA Admin Panel Database Schema
-- Created: January 18, 2026
-- ========================================

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS ulfa_charity CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ulfa_charity;

-- ========================================
-- Admin Users Table
-- ========================================
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    status ENUM('active', 'inactive') DEFAULT 'active',
    last_login DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default admin user
-- Username: admin, Password: admin123
-- Note: Password hash is generated using password_hash('admin123', PASSWORD_DEFAULT)
INSERT INTO admin_users (username, password, full_name, email, status) 
VALUES ('admin', '$2y$12$yJCY7/0JLPZOahjSFwNXDeC7OZlI.UQJK.CjXr1fxqSZ1/EIMgbE.', 'ULFA Administrator', 'admin@ulfa.org', 'active')
ON DUPLICATE KEY UPDATE password='$2y$12$yJCY7/0JLPZOahjSFwNXDeC7OZlI.UQJK.CjXr1fxqSZ1/EIMgbE.';

-- ========================================
-- Admin Activity Log
-- ========================================
CREATE TABLE IF NOT EXISTS admin_activity_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    action VARCHAR(50) NOT NULL,
    module VARCHAR(50) NOT NULL,
    record_id INT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES admin_users(id) ON DELETE CASCADE,
    INDEX idx_admin_id (admin_id),
    INDEX idx_module (module),
    INDEX idx_created_at (created_at DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- News/Blog Posts Table
-- ========================================
CREATE TABLE IF NOT EXISTS news_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(220) NOT NULL UNIQUE,
    excerpt TEXT NULL,
    content LONGTEXT NOT NULL,
    featured_image VARCHAR(255) NULL,
    author_id INT NOT NULL,
    category VARCHAR(50) NULL,
    tags TEXT NULL,
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    views INT DEFAULT 0,
    published_at DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES admin_users(id),
    INDEX idx_slug (slug),
    INDEX idx_status (status),
    INDEX idx_published_at (published_at DESC),
    INDEX idx_category (category),
    FULLTEXT idx_search (title, content)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Events Table
-- ========================================
CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(220) NOT NULL UNIQUE,
    description TEXT NULL,
    content LONGTEXT NULL,
    featured_image VARCHAR(255) NULL,
    event_date DATETIME NOT NULL,
    end_date DATETIME NULL,
    location VARCHAR(200) NULL,
    organizer VARCHAR(100) NULL,
    max_attendees INT NULL,
    current_attendees INT DEFAULT 0,
    registration_required BOOLEAN DEFAULT FALSE,
    registration_deadline DATETIME NULL,
    status ENUM('upcoming', 'ongoing', 'completed', 'cancelled') DEFAULT 'upcoming',
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES admin_users(id),
    INDEX idx_slug (slug),
    INDEX idx_event_date (event_date),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Causes Table
-- ========================================
CREATE TABLE IF NOT EXISTS causes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(220) NOT NULL UNIQUE,
    description TEXT NULL,
    content LONGTEXT NULL,
    featured_image VARCHAR(255) NULL,
    goal_amount DECIMAL(10, 2) DEFAULT 0.00,
    raised_amount DECIMAL(10, 2) DEFAULT 0.00,
    currency VARCHAR(3) DEFAULT 'UGX',
    start_date DATE NULL,
    end_date DATE NULL,
    category VARCHAR(50) NULL,
    status ENUM('active', 'completed', 'paused', 'archived') DEFAULT 'active',
    featured BOOLEAN DEFAULT FALSE,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES admin_users(id),
    INDEX idx_slug (slug),
    INDEX idx_status (status),
    INDEX idx_featured (featured),
    INDEX idx_category (category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Gallery Images Table
-- ========================================
CREATE TABLE IF NOT EXISTS gallery_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT NULL,
    image_path VARCHAR(255) NOT NULL,
    thumbnail_path VARCHAR(255) NULL,
    category VARCHAR(50) NULL,
    tags TEXT NULL,
    alt_text VARCHAR(200) NULL,
    display_order INT DEFAULT 0,
    status ENUM('active', 'inactive') DEFAULT 'active',
    uploaded_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (uploaded_by) REFERENCES admin_users(id),
    INDEX idx_category (category),
    INDEX idx_status (status),
    INDEX idx_display_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Team Members Table
-- ========================================
CREATE TABLE IF NOT EXISTS team_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    bio TEXT NULL,
    photo VARCHAR(255) NULL,
    email VARCHAR(100) NULL,
    phone VARCHAR(20) NULL,
    social_facebook VARCHAR(200) NULL,
    social_twitter VARCHAR(200) NULL,
    social_linkedin VARCHAR(200) NULL,
    display_order INT DEFAULT 0,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_display_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Site Settings Table
-- ========================================
CREATE TABLE IF NOT EXISTS site_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT NULL,
    setting_type VARCHAR(20) DEFAULT 'text',
    description TEXT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_setting_key (setting_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default settings
INSERT INTO site_settings (setting_key, setting_value, setting_type, description) VALUES
('site_name', 'United Love for All (ULFA)', 'text', 'Website name'),
('site_email', 'info@ulfa.org', 'text', 'Contact email'),
('site_phone', '+256 700 000 000', 'text', 'Contact phone'),
('site_address', 'Mpondwe Lhubiriha, Kasese District, Uganda', 'text', 'Physical address'),
('facebook_url', '', 'text', 'Facebook page URL'),
('twitter_url', '', 'text', 'Twitter profile URL'),
('instagram_url', '', 'text', 'Instagram profile URL'),
('youtube_url', '', 'text', 'YouTube channel URL')
ON DUPLICATE KEY UPDATE setting_key=setting_key;

-- ========================================
-- End of Schema
-- ========================================
