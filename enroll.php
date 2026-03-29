<?php
/**
 * Contact Form Handler (AJAX endpoint)
 * Handles contact form submissions from the frontend
 */

// Prevent any output before JSON
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Use centralized configuration
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';

/**
 * Sanitize input data (only define if not already in functions.php)
 */
if (!function_exists('sanitizeInput')) {
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        return $data;
    }
}

/**
 * Validate email address
 */
if (!function_exists('isValidEmail')) {
    function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}

/**
 * Validate phone number (minimum 10 digits)
 */
if (!function_exists('isValidPhone')) {
    function isValidPhone($phone) {
        $phone = preg_replace('/[^0-9+]/', '', $phone);
        return strlen($phone) >= 10;
    }
}

/**
 * Check for duplicate submissions within 1 hour
 */
if (!function_exists('isDuplicateEnrollment')) {
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
}

/**
 * Simple rate limiting by IP
 */
if (!function_exists('isRateLimited')) {
function isRateLimited($ipAddress) {
    $pdo = getDBConnection();
    if (!$pdo) return false;
    
    try {
        // Max 5 submissions per IP in 10 minutes
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM contact_inquiries WHERE ip_address = ? AND created_at > DATE_SUB(NOW(), INTERVAL 10 MINUTE)");
        $stmt->execute([$ipAddress]);
        return $stmt->fetchColumn() >= 5;
    } catch(PDOException $e) {
        error_log("Rate limit check failed: " . $e->getMessage());
        return false;
    }
}
}

/**
 * Save contact inquiry to database
 */
if (!function_exists('saveEnrollment')) {
function saveEnrollment($name, $email, $phone, $subject, $message = '') {
    $pdo = getDBConnection();
    if (!$pdo) {
        return ['success' => false, 'message' => 'Database connection failed. Please try again later.'];
    }
    
    // Sanitize all inputs
    $name = sanitizeInput($name);
    $email = sanitizeInput($email);
    $phone = sanitizeInput($phone);
    $subject = sanitizeInput($subject);
    $message = sanitizeInput($message);
    $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    
    // Validation
    if (empty($name) || empty($email) || empty($phone) || empty($subject)) {
        return ['success' => false, 'message' => 'All required fields must be filled.'];
    }
    
    if (strlen($name) > 255) {
        return ['success' => false, 'message' => 'Name is too long.'];
    }
    
    if (!isValidEmail($email)) {
        return ['success' => false, 'message' => 'Invalid email address.'];
    }
    
    if (!isValidPhone($phone)) {
        return ['success' => false, 'message' => 'Invalid phone number.'];
    }
    
    // Rate limiting
    if (isRateLimited($ipAddress)) {
        return ['success' => false, 'message' => 'Too many requests. Please try again later.'];
    }
    
    // Duplicate check
    if (isDuplicateEnrollment($email, $subject)) {
        return ['success' => false, 'message' => 'You have already submitted this inquiry recently.'];
    }
    
    try {
        $stmt = $pdo->prepare("INSERT INTO contact_inquiries (name, email, phone, subject, message, ip_address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $subject, $message, $ipAddress]);
        
        return ['success' => true, 'message' => 'Thank you for contacting DTEHM! We will get back to you soon.'];
    } catch(PDOException $e) {
        error_log("Contact form save failed: " . $e->getMessage());
        return ['success' => false, 'message' => 'Failed to save your inquiry. Please try again.'];
    }
}
} // end function_exists('saveEnrollment')

// Main execution
try {
    // Only accept POST requests
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }
    
    // Process the form
    $result = saveEnrollment(
        $_POST['name'] ?? '',
        $_POST['email'] ?? '',
        $_POST['phone'] ?? '',
        $_POST['subject'] ?? '',
        $_POST['message'] ?? ''
    );

    ob_clean();
    header('Content-Type: application/json');
    echo json_encode($result);
    
} catch (Exception $e) {
    error_log("Contact form error: " . $e->getMessage());
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false, 
        'message' => 'An error occurred. Please try again.'
    ]);
}

ob_end_flush();
