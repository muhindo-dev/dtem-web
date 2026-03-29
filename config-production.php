<?php
// Production Database configuration for dtehmhealth.com
// Shared database with the dtehm-insurance-api backend
define('DB_HOST', 'localhost'); // Or your production database host
define('DB_NAME', 'dtehm_insurance_api'); // Same database as the API
define('DB_USER', 'your_db_username'); // Your production database username
define('DB_PASS', 'your_db_password'); // Your production database password
define('DB_SOCKET', ''); // Leave empty for standard connections, or specify socket path

// API Storage URL - where product images are served from
define('API_STORAGE_URL', 'https://dip.dtehmhealth.com/storage/');

// Admin password - CHANGE THIS TO A STRONG PASSWORD
define('ADMIN_PASSWORD', 'change_this_to_strong_password');

// Site URL
define('SITE_URL', 'https://ai-programming.tusometech.com');

// Environment
define('ENVIRONMENT', 'production');

// Error reporting for production
error_reporting(E_ALL);
ini_set('display_errors', 0); // Don't display errors to users
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
