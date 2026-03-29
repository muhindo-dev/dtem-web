<?php
/**
 * Causes Management - Delete Cause
 */
require_once 'config/auth.php';
require_once 'config/crud-helper.php';

requireAdmin();
checkSessionTimeout();

// Verify CSRF token
$token = isset($_GET['token']) ? $_GET['token'] : '';
if (!verifyCSRFToken($token)) {
    $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Invalid security token. Please try again.'];
    header('Location: causes.php');
    exit;
}

$causeId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$causeId) {
    $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Invalid cause ID'];
    header('Location: causes.php');
    exit;
}

$cause = getRecordById('causes', $causeId);

if (!$cause) {
    $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Cause not found'];
    header('Location: causes.php');
    exit;
}

// Delete cause image if exists
if ($cause['cause_image']) {
    deleteUploadedFile('../uploads/' . $cause['cause_image']);
}

// Delete cause record
$deleted = deleteRecord('causes', $causeId);

if ($deleted) {
    logAdminActivity('delete', 'causes', $causeId);
    $_SESSION['alert'] = ['type' => 'success', 'message' => 'Cause deleted successfully!'];
} else {
    $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Failed to delete cause'];
}

header('Location: causes.php');
exit;
