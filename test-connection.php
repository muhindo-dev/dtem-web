<?php
// Simple test endpoint
header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'message' => 'Connection test successful!',
    'server_info' => [
        'php_version' => phpversion(),
        'request_method' => $_SERVER['REQUEST_METHOD'],
        'current_time' => date('Y-m-d H:i:s')
    ]
]);
?>
