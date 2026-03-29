<?php
require_once 'config.php';

// Initialize global PDO connection
try {
    // Use socket for local development (MAMP), standard connection for production
    if (defined('DB_SOCKET') && !empty(DB_SOCKET) && file_exists(DB_SOCKET)) {
        $dsn = "mysql:dbname=" . DB_NAME . ";unix_socket=" . DB_SOCKET . ";charset=utf8mb4";
    } else {
        $port = defined('DB_PORT') ? DB_PORT : '3306';
        $dsn = "mysql:host=" . DB_HOST . ";port=" . $port . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    }
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("Database connection failed. Please check your configuration.");
}

// Database connection function
function getDBConnection(&$errorMessage = null) {
    try {
        // Use socket for local development (MAMP), standard connection for production
        if (defined('DB_SOCKET') && !empty(DB_SOCKET) && file_exists(DB_SOCKET)) {
            $dsn = "mysql:dbname=" . DB_NAME . ";unix_socket=" . DB_SOCKET . ";charset=utf8mb4";
        } else {
            $port = defined('DB_PORT') ? DB_PORT : '3306';
            $dsn = "mysql:host=" . DB_HOST . ";port=" . $port . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        }
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch(PDOException $e) {
        $errorMessage = $e->getMessage();
        error_log("Database connection failed: " . $errorMessage);
        return null;
    }
}

// Create enrollments table if not exists
function createEnrollmentsTable() {
    $pdo = getDBConnection();
    if (!$pdo) return false;
    
    try {
        $sql = "CREATE TABLE IF NOT EXISTS contact_inquiries (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            phone VARCHAR(50) NOT NULL,
            subject VARCHAR(100) NOT NULL,
            message TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            ip_address VARCHAR(45),
            INDEX idx_created_at (created_at DESC),
            INDEX idx_email (email)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        
        $pdo->exec($sql);
        return true;
    } catch(PDOException $e) {
        error_log("Table creation failed: " . $e->getMessage());
        return false;
    }
}

// Sanitize input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

// Validate email
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Validate phone
function isValidPhone($phone) {
    $phone = preg_replace('/[^0-9+]/', '', $phone);
    return strlen($phone) >= 10;
}

// Check for duplicate inquiry
function isDuplicateEnrollment($email, $subject) {
    $pdo = getDBConnection();
    if (!$pdo) return false;
    
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM contact_inquiries WHERE email = ? AND subject = ? AND created_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)");
        $stmt->execute([$email, $subject]);
        return $stmt->fetchColumn() > 0;
    } catch(PDOException $e) {
        error_log("Duplicate check failed: " . $e->getMessage());
        return false;
    }
}

// Save contact inquiry
function saveEnrollment($name, $email, $phone, $subject, $message = '') {
    $dbError = null;
    $pdo = getDBConnection($dbError);
    if (!$pdo) {
        return ['success' => false, 'message' => 'Database connection failed. ' . ($dbError ? 'Error: ' . $dbError : 'Please try again later.')];
    }
    
    // Sanitize inputs
    $name = sanitizeInput($name);
    $email = sanitizeInput($email);
    $phone = sanitizeInput($phone);
    $subject = sanitizeInput($subject);
    $message = sanitizeInput($message);
    
    // Validation
    if (empty($name) || empty($email) || empty($phone) || empty($subject)) {
        return ['success' => false, 'message' => 'All required fields must be filled.'];
    }
    
    if (!isValidEmail($email)) {
        return ['success' => false, 'message' => 'Invalid email address.'];
    }
    
    if (!isValidPhone($phone)) {
        return ['success' => false, 'message' => 'Invalid phone number.'];
    }
    
    // Check for duplicate
    if (isDuplicateEnrollment($email, $subject)) {
        return ['success' => false, 'message' => 'You have already submitted this inquiry recently.'];
    }
    
    try {
        $stmt = $pdo->prepare("INSERT INTO contact_inquiries (name, email, phone, subject, message, ip_address) VALUES (?, ?, ?, ?, ?, ?)");
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        
        $stmt->execute([$name, $email, $phone, $subject, $message, $ipAddress]);
        
        return ['success' => true, 'message' => 'Thank you for contacting DTEHM! We will get back to you soon.'];
    } catch(PDOException $e) {
        error_log("Enrollment save failed: " . $e->getMessage());
        return ['success' => false, 'message' => 'Failed to save enrollment. Please try again.'];
    }
}

// Get all contact inquiries
function getAllEnrollments() {
    $pdo = getDBConnection();
    if (!$pdo) return [];
    
    try {
        $stmt = $pdo->query("SELECT * FROM contact_inquiries ORDER BY created_at DESC");
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        error_log("Failed to fetch inquiries: " . $e->getMessage());
        return [];
    }
}

// ============================================
// SITE SETTINGS FUNCTIONS
// ============================================

/**
 * Global settings cache
 */
$GLOBALS['_site_settings'] = null;

/**
 * Load all site settings into global cache
 * Call this once at the start of each page
 */
function loadSiteSettings() {
    if ($GLOBALS['_site_settings'] !== null) {
        return $GLOBALS['_site_settings'];
    }
    
    $pdo = getDBConnection();
    if (!$pdo) {
        $GLOBALS['_site_settings'] = [];
        return [];
    }
    
    try {
        $stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings");
        $settings = [];
        while ($row = $stmt->fetch()) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        $GLOBALS['_site_settings'] = $settings;
        return $settings;
    } catch(PDOException $e) {
        error_log("Failed to load settings: " . $e->getMessage());
        $GLOBALS['_site_settings'] = [];
        return [];
    }
}

/**
 * Get a single setting value
 * Handles legacy naming conventions (site_* vs contact_*)
 * 
 * @param string $key Setting key
 * @param mixed $default Default value if not found
 * @return mixed Setting value or default
 */
function getSetting($key, $default = '') {
    // Load settings if not already loaded
    if ($GLOBALS['_site_settings'] === null) {
        loadSiteSettings();
    }
    
    // Direct match
    if (isset($GLOBALS['_site_settings'][$key]) && $GLOBALS['_site_settings'][$key] !== '') {
        return $GLOBALS['_site_settings'][$key];
    }
    
    // Handle legacy naming: contact_* vs site_*
    $legacyMappings = [
        'contact_email' => 'site_email',
        'contact_phone' => 'site_phone',
        'contact_address' => 'site_address',
        'site_email' => 'contact_email',
        'site_phone' => 'contact_phone',
        'site_address' => 'contact_address',
    ];
    
    if (isset($legacyMappings[$key])) {
        $altKey = $legacyMappings[$key];
        if (isset($GLOBALS['_site_settings'][$altKey]) && $GLOBALS['_site_settings'][$altKey] !== '') {
            return $GLOBALS['_site_settings'][$altKey];
        }
    }
    
    return $default;
}

/**
 * Get multiple settings at once
 * 
 * @param array $keys Array of setting keys
 * @return array Associative array of settings
 */
function getSettings($keys = []) {
    // Load settings if not already loaded
    if ($GLOBALS['_site_settings'] === null) {
        loadSiteSettings();
    }
    
    if (empty($keys)) {
        return $GLOBALS['_site_settings'];
    }
    
    $result = [];
    foreach ($keys as $key) {
        $result[$key] = $GLOBALS['_site_settings'][$key] ?? '';
    }
    return $result;
}

/**
 * Get settings by prefix (e.g., 'pesapal_', 'social_')
 * 
 * @param string $prefix Setting key prefix
 * @return array Associative array of matching settings
 */
function getSettingsByPrefix($prefix) {
    // Load settings if not already loaded
    if ($GLOBALS['_site_settings'] === null) {
        loadSiteSettings();
    }
    
    $result = [];
    foreach ($GLOBALS['_site_settings'] as $key => $value) {
        if (strpos($key, $prefix) === 0) {
            $result[$key] = $value;
        }
    }
    return $result;
}

/**
 * Check if a setting has a non-empty value
 * 
 * @param string $key Setting key
 * @return bool True if setting exists and is not empty
 */
function hasSetting($key) {
    $value = getSetting($key, null);
    return $value !== null && $value !== '';
}

/**
 * Get site logo URL
 * Returns default icon if no logo uploaded
 */
function getSiteLogo() {
    $logo = getSetting('site_logo');
    if ($logo && file_exists(__DIR__ . '/uploads/' . $logo)) {
        return 'uploads/' . $logo;
    }
    return null;
}

/**
 * Get site favicon URL
 */
function getSiteFavicon() {
    $favicon = getSetting('site_favicon');
    if ($favicon && file_exists(__DIR__ . '/uploads/' . $favicon)) {
        return 'uploads/' . $favicon;
    }
    return null;
}

/**
 * Get formatted phone number for display
 */
function getFormattedPhone($key = 'contact_phone') {
    $phone = getSetting($key);
    if (empty($phone)) return '';
    return $phone;
}

/**
 * Get phone number for tel: link
 * @param string $phone Phone number string (or setting key if starts with 'contact_')
 */
function getPhoneLink($phone = 'contact_phone') {
    // If it looks like a setting key, get the setting
    if (strpos($phone, 'contact_') === 0 || $phone === 'whatsapp_number') {
        $phone = getSetting($phone);
    }
    if (empty($phone)) return '';
    // Remove all non-numeric characters except +
    return 'tel:' . preg_replace('/[^0-9+]/', '', $phone);
}

/**
 * Get WhatsApp link
 * @param string $phone Phone number (optional, will use setting if not provided)
 * @param string $message Pre-filled message (optional)
 */
function getWhatsAppLink($phone = null, $message = null) {
    if (empty($phone)) {
        $phone = getSetting('whatsapp_number');
        if (empty($phone)) {
            $phone = getSetting('contact_phone');
        }
    }
    if (empty($phone)) return '';
    
    // Remove all non-numeric characters
    $phone = preg_replace('/[^0-9]/', '', $phone);
    
    if ($message === null) {
        $message = getSetting('whatsapp_default_message', 'Hello, I would like to know more about DTEHM.');
    }
    $message = urlencode($message);
    
    return "https://wa.me/{$phone}?text={$message}";
}

/**
 * Get social media links as array
 */
function getSocialLinks() {
    return [
        'facebook' => getSetting('facebook_url'),
        'twitter' => getSetting('twitter_url'),
        'instagram' => getSetting('instagram_url'),
        'linkedin' => getSetting('linkedin_url'),
        'youtube' => getSetting('youtube_url'),
        'tiktok' => getSetting('tiktok_url'),
    ];
}

/**
 * Get currency settings
 */
function getCurrency() {
    return [
        'code' => getSetting('currency_code', 'USD'),
        'symbol' => getSetting('currency_symbol', '$'),
        'name' => getSetting('currency_name', 'US Dollar'),
    ];
}

/**
 * Get USD to UGX exchange rate
 * @return float Exchange rate (1 USD = X UGX)
 */
function getExchangeRate() {
    return (float) getSetting('usd_to_ugx_rate', '3600');
}

/**
 * Convert USD amount to UGX for Pesapal payment processing
 * @param float $usdAmount Amount in USD
 * @return float Amount in UGX
 */
function convertUsdToUgx($usdAmount) {
    $rate = getExchangeRate();
    return round($usdAmount * $rate, 0); // Round to whole number for UGX
}

/**
 * Convert UGX amount back to USD for display
 * @param float $ugxAmount Amount in UGX
 * @return float Amount in USD
 */
function convertUgxToUsd($ugxAmount) {
    $rate = getExchangeRate();
    return round($ugxAmount / $rate, 2);
}

/**
 * Format amount with currency
 */
function formatCurrency($amount) {
    $currency = getCurrency();
    return $currency['symbol'] . ' ' . number_format($amount, 2);
}

/**
 * Format donation amount for display
 * Shows USD amount if available, otherwise converts UGX to USD
 * @param array $donation Donation record from database
 * @return string Formatted currency string
 */
function formatDonationAmount($donation) {
    // If we have the USD amount stored, use it
    if (!empty($donation['amount_usd'])) {
        return '$ ' . number_format($donation['amount_usd'], 2) . ' USD';
    }
    // Otherwise convert from UGX
    $usdAmount = convertUgxToUsd($donation['amount']);
    return '$ ' . number_format($usdAmount, 2) . ' USD';
}

// Load settings on include (auto-load for convenience)
loadSiteSettings();

// Handle enrollment form submission (only in web context)
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'enroll') {
    // Create table if not exists
    createEnrollmentsTable();
    
    $result = saveEnrollment(
        $_POST['name'] ?? '',
        $_POST['email'] ?? '',
        $_POST['phone'] ?? '',
        $_POST['course'] ?? '',
        $_POST['message'] ?? ''
    );
    
    $_SESSION['enrollment_result'] = $result;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
?>
