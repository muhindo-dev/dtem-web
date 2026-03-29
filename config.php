<?php
/**
 * DTEHM Health Ministries Website Configuration
 * 
 * IMPORTANT: This file contains sensitive configuration.
 * For production deployment:
 * 1. Copy config-production.php to config.php on your server
 * 2. Update all credentials with production values
 * 3. Never commit production credentials to version control
 */

// Environment detection (set to 'production' on live server)
define('ENVIRONMENT', 'development');

// Database configuration - shared with dtehm-insurance-api Laravel app
// Both the website and the API use the same database (dtehm_insurance_api)
// Website tables: causes, events, news_posts, gallery_albums, gallery_images,
//   team_members, donations, contact_inquiries, site_settings, admin_users, admin_activity_log
// API tables: users, orders, ordered_items, products, etc.
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '8889');
define('DB_NAME', 'dtehm_insurance_api');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_SOCKET', '/Applications/MAMP/tmp/mysql/mysql.sock'); // Leave empty '' for production/online hosting

// DEPRECATED: ADMIN_PASSWORD is no longer used
// Admin authentication now uses database-stored hashed passwords
// Use admin/setup-admins.php to create admin accounts
define('ADMIN_PASSWORD', ''); // Kept for backwards compatibility only

// Error reporting based on environment
if (ENVIRONMENT === 'production') {
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', __DIR__ . '/error.log');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    // Session security settings
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_strict_mode', 1);
    if (ENVIRONMENT === 'production') {
        ini_set('session.cookie_secure', 1);
    }
    session_start();
}
?>
