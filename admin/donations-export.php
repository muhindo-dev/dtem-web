<?php
/**
 * Donations Export - CSV Download
 * 
 * Exports filtered donations to CSV format for reporting and analysis.
 * 
 * @author DTEHM Development Team
 * @version 1.0.0
 * @since 2026-01-20
 */
require_once 'config/auth.php';
require_once 'config/crud-helper.php';

requireAdmin();
checkSessionTimeout();

$pdo = getDBConnection();

// Get filters (same as donations.php)
$status = $_GET['status'] ?? '';
$search = $_GET['search'] ?? '';
$dateFrom = $_GET['date_from'] ?? '';
$dateTo = $_GET['date_to'] ?? '';
$causeId = $_GET['cause_id'] ?? '';

// Build query
$conditions = [];
$params = [];

if ($search) {
    $conditions[] = "(d.donor_name LIKE ? OR d.donor_email LIKE ? OR d.donor_phone LIKE ? OR d.merchant_reference LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if ($status) {
    $conditions[] = "d.payment_status = ?";
    $params[] = $status;
}

if ($dateFrom) {
    $conditions[] = "DATE(d.created_at) >= ?";
    $params[] = $dateFrom;
}

if ($dateTo) {
    $conditions[] = "DATE(d.created_at) <= ?";
    $params[] = $dateTo;
}

if ($causeId) {
    if ($causeId === 'general') {
        $conditions[] = "d.cause_id IS NULL";
    } else {
        $conditions[] = "d.cause_id = ?";
        $params[] = $causeId;
    }
}

$whereClause = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';

// Get all donations matching filters
$sql = "SELECT d.*, c.title as cause_title 
        FROM donations d 
        LEFT JOIN causes c ON d.cause_id = c.id 
        $whereClause 
        ORDER BY d.created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$donations = $stmt->fetchAll();

// Set headers for CSV download
$filename = 'ulfa-donations-' . date('Y-m-d-His') . '.csv';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Pragma: no-cache');
header('Expires: 0');

// Create output stream
$output = fopen('php://output', 'w');

// Add BOM for Excel UTF-8 compatibility
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// Write header row
fputcsv($output, [
    'ID',
    'Date',
    'Donor Name',
    'Email',
    'Phone',
    'Amount (UGX)',
    'Cause',
    'Status',
    'Payment Method',
    'Confirmation Code',
    'Merchant Reference',
    'Tracking ID',
    'Anonymous',
    'Message',
    'Completed At'
]);

// Write data rows
foreach ($donations as $donation) {
    fputcsv($output, [
        $donation['id'],
        date('Y-m-d H:i:s', strtotime($donation['created_at'])),
        $donation['donor_name'],
        $donation['donor_email'],
        $donation['donor_phone'],
        $donation['amount'],
        $donation['cause_title'] ?: 'General Fund',
        ucfirst($donation['payment_status']),
        $donation['payment_method'] ?: '',
        $donation['confirmation_code'] ?: '',
        $donation['merchant_reference'],
        $donation['order_tracking_id'] ?: '',
        $donation['is_anonymous'] ? 'Yes' : 'No',
        $donation['message'] ?: '',
        $donation['completed_at'] ? date('Y-m-d H:i:s', strtotime($donation['completed_at'])) : ''
    ]);
}

fclose($output);
exit;
