<?php
// Test script to verify everything works
require_once 'functions.php';

echo "<h1>System Test</h1>";
echo "<style>body { font-family: Arial; padding: 2rem; } .success { color: green; } .error { color: red; } pre { background: #f5f5f5; padding: 1rem; border: 1px solid #ddd; }</style>";

// Test 1: Database Connection
echo "<h2>Test 1: Database Connection</h2>";
$pdo = getDBConnection();
if ($pdo) {
    echo "<p class='success'>✓ Database connection successful</p>";
} else {
    echo "<p class='error'>✗ Database connection failed</p>";
    echo "<p>Please check your database configuration in config.php</p>";
}

// Test 2: Create Table
echo "<h2>Test 2: Create Enrollments Table</h2>";
if (createEnrollmentsTable()) {
    echo "<p class='success'>✓ Table created/verified successfully</p>";
} else {
    echo "<p class='error'>✗ Table creation failed</p>";
}

// Test 3: Check if table exists
echo "<h2>Test 3: Verify Table Structure</h2>";
try {
    $stmt = $pdo->query("DESCRIBE enrollments");
    $columns = $stmt->fetchAll();
    echo "<p class='success'>✓ Table structure verified</p>";
    echo "<pre>";
    foreach ($columns as $column) {
        echo "{$column['Field']} - {$column['Type']}\n";
    }
    echo "</pre>";
} catch (Exception $e) {
    echo "<p class='error'>✗ Error: " . $e->getMessage() . "</p>";
}

// Test 4: Test Enrollment (with test data)
echo "<h2>Test 4: Test Enrollment Function</h2>";
$testResult = saveEnrollment(
    'Test User',
    'test@example.com',
    '+256700000000',
    'web-design',
    'This is a test enrollment'
);
echo "<p class='" . ($testResult['success'] ? 'success' : 'error') . "'>";
echo ($testResult['success'] ? '✓' : '✗') . " " . $testResult['message'];
echo "</p>";

// Test 5: Count enrollments
echo "<h2>Test 5: Count Enrollments</h2>";
$enrollments = getAllEnrollments();
echo "<p class='success'>✓ Total enrollments: " . count($enrollments) . "</p>";

// Test 6: Admin Login
echo "<h2>Test 6: Admin Login Function</h2>";
if (verifyAdminLogin('4321')) {
    echo "<p class='success'>✓ Admin password verification works</p>";
} else {
    echo "<p class='error'>✗ Admin password verification failed</p>";
}

echo "<h2>All Tests Complete!</h2>";
echo "<p><a href='index.php'>Go to Homepage</a> | <a href='admin.php'>Go to Admin Panel</a></p>";
?>
