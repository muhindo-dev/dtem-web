<?php
/**
 * Causes Management - Add New Cause
 */
require_once 'config/auth.php';
require_once 'config/crud-helper.php';

requireAdmin();
checkSessionTimeout();

$currentAdmin = getCurrentAdmin();
$currentPage = 'causes';
$pageTitle = 'Add New Cause';

$error = '';
$categories = ['Education', 'Healthcare', 'Housing', 'Food Security', 'Emergency Relief', 'Community Development'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitizeInput($_POST['title'] ?? '');
    $category = sanitizeInput($_POST['category'] ?? '');
    $description = $_POST['description'] ?? '';
    $goalAmount = (float)($_POST['goal_amount'] ?? 0);
    $raisedAmount = (float)($_POST['raised_amount'] ?? 0);
    $startDate = $_POST['start_date'] ?? '';
    $endDate = $_POST['end_date'] ?? null;
    $beneficiaries = sanitizeInput($_POST['beneficiaries'] ?? '');
    $location = sanitizeInput($_POST['location'] ?? '');
    $urgency = $_POST['urgency'] ?? 'medium';
    $status = $_POST['status'] ?? 'active';
    $isFeatured = isset($_POST['is_featured']) ? 1 : 0;
    
    $validation = validateRequiredFields($_POST, ['title', 'description', 'category', 'goal_amount', 'start_date']);
    
    if (!$validation['success']) {
        $error = $validation['message'];
    } elseif ($goalAmount <= 0) {
        $error = 'Goal amount must be greater than zero';
    } else {
        $slug = generateSlug($title);
        $slug = ensureUniqueSlug('causes', $slug);
        
        $causeImage = null;
        if (isset($_FILES['cause_image']) && $_FILES['cause_image']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = uploadImage($_FILES['cause_image'], '../uploads/causes/');
            if ($uploadResult['success']) {
                $causeImage = 'causes/' . $uploadResult['filename'];
            } else {
                $error = 'Image upload failed: ' . $uploadResult['message'];
            }
        }
        
        if (!$error) {
            try {
                $pdo = getDBConnection();
                $sql = "INSERT INTO causes (title, slug, description, cause_image, category, goal_amount, raised_amount, start_date, end_date, beneficiaries, location, urgency, status, is_featured, created_by, created_at) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute([
                    $title, $slug, $description, $causeImage, $category, $goalAmount, $raisedAmount,
                    $startDate, $endDate ?: null, $beneficiaries, $location, $urgency, $status, $isFeatured,
                    $currentAdmin['id'], date('Y-m-d H:i:s')
                ]);
                
                if ($result) {
                    logAdminActivity('create', 'causes', $pdo->lastInsertId());
                    $_SESSION['alert'] = ['type' => 'success', 'message' => 'Cause created successfully!'];
                    header('Location: causes.php');
                    exit;
                } else {
                    $error = 'Database error: ' . implode(', ', $stmt->errorInfo());
                }
            } catch (PDOException $e) {
                $error = 'Database error: ' . $e->getMessage();
            }
        }
    }
}

include 'includes/header.php';
?>

<div class="admin-content">
    <div class="content-header-compact">
        <h1><i class="fas fa-plus-circle"></i> Add New Cause</h1>
        <a href="causes.php" class="btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" id="causeForm">
        <div class="row">
            <div class="col-lg-8">
                <div class="card-compact">
                    <div class="card-header-compact"><h4><i class="fas fa-file-alt"></i> Cause Details</h4></div>
                    <div class="card-body-compact">
                        <div class="form-group">
                            <label for="title" class="form-label required">Cause Title</label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Enter cause title..." required maxlength="200" value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>">
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label required">Description</label>
                            <input type="hidden" id="description" name="description" value="<?php echo htmlspecialchars($_POST['description'] ?? ''); ?>">
                            <div id="editor-container" style="height: 300px; background: #fff;"><?php echo $_POST['description'] ?? ''; ?></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="beneficiaries" class="form-label">Beneficiaries</label>
                                    <input type="text" id="beneficiaries" name="beneficiaries" class="form-control" placeholder="e.g., Children, Elderly, Families" value="<?php echo htmlspecialchars($_POST['beneficiaries'] ?? ''); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" id="location" name="location" class="form-control" placeholder="e.g., Kampala, Uganda" value="<?php echo htmlspecialchars($_POST['location'] ?? ''); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card-compact">
                    <div class="card-header-compact"><h4><i class="fas fa-cog"></i> Cause Settings</h4></div>
                    <div class="card-body-compact">
                        <div class="form-group">
                            <label for="status" class="form-label required">Status</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="active" <?php echo (($_POST['status'] ?? '') == 'active') ? 'selected' : ''; ?>>Active</option>
                                <option value="paused" <?php echo (($_POST['status'] ?? '') == 'paused') ? 'selected' : ''; ?>>Paused</option>
                                <option value="completed" <?php echo (($_POST['status'] ?? '') == 'completed') ? 'selected' : ''; ?>>Completed</option>
                                <option value="cancelled" <?php echo (($_POST['status'] ?? '') == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                            </select>
                        </div>

                        <hr class="my-3">

                        <div class="form-group">
                            <label for="category" class="form-label required">Category</label>
                            <select id="category" name="category" class="form-control" required>
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?php echo $cat; ?>" <?php echo (($_POST['category'] ?? '') == $cat) ? 'selected' : ''; ?>><?php echo $cat; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="urgency" class="form-label">Urgency Level</label>
                            <select id="urgency" name="urgency" class="form-control">
                                <option value="low" <?php echo (($_POST['urgency'] ?? '') == 'low') ? 'selected' : ''; ?>>Low</option>
                                <option value="medium" <?php echo (($_POST['urgency'] ?? 'medium') == 'medium') ? 'selected' : ''; ?>>Medium</option>
                                <option value="high" <?php echo (($_POST['urgency'] ?? '') == 'high') ? 'selected' : ''; ?>>High</option>
                                <option value="critical" <?php echo (($_POST['urgency'] ?? '') == 'critical') ? 'selected' : ''; ?>>Critical</option>
                            </select>
                        </div>

                        <hr class="my-3">

                        <div class="form-group">
                            <label for="goal_amount" class="form-label required">Goal Amount ($)</label>
                            <input type="number" id="goal_amount" name="goal_amount" class="form-control" placeholder="10000" min="1" step="0.01" required value="<?php echo htmlspecialchars($_POST['goal_amount'] ?? ''); ?>">
                        </div>

                        <div class="form-group">
                            <label for="raised_amount" class="form-label">Already Raised ($)</label>
                            <input type="number" id="raised_amount" name="raised_amount" class="form-control" placeholder="0" min="0" step="0.01" value="<?php echo htmlspecialchars($_POST['raised_amount'] ?? '0'); ?>">
                        </div>

                        <hr class="my-3">

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="start_date" class="form-label required">Start Date</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control" required value="<?php echo htmlspecialchars($_POST['start_date'] ?? date('Y-m-d')); ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control" value="<?php echo htmlspecialchars($_POST['end_date'] ?? ''); ?>">
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" id="is_featured" name="is_featured" class="form-check-input" <?php echo isset($_POST['is_featured']) ? 'checked' : ''; ?>>
                                <label for="is_featured" class="form-check-label">Featured Cause</label>
                            </div>
                        </div>

                        <hr class="my-3">

                        <div class="form-group">
                            <label for="cause_image" class="form-label">Cause Image</label>
                            <input type="file" id="cause_image" name="cause_image" class="form-control" accept="image/*">
                            <small class="form-text">1200x630px. Max 5MB</small>
                            <div id="imagePreview" class="mt-2"></div>
                        </div>

                        <hr class="my-3">

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Cause</button>
                            <a href="causes.php" class="btn btn-secondary"><i class="fas fa-times"></i> Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Quill editor
    var quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'Enter cause description...',
        modules: {
            toolbar: [
                [{ 'header': [2, 3, 4, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'align': [] }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    document.getElementById('causeForm').addEventListener('submit', function(e) {
        // Get Quill content and update hidden input
        var description = quill.root.innerHTML;
        document.getElementById('description').value = description;
        
        // Check if description is empty (only has empty tags)
        var textContent = quill.getText().trim();
        if (!textContent || textContent === '') {
            e.preventDefault();
            alert('Please enter the cause description');
            quill.focus();
            return false;
        }
    });

    document.getElementById('cause_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('imagePreview');
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = '<img src="' + e.target.result + '" style="max-width: 100%; height: auto; border: 2px solid #dee2e6;">';
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
        }
    });
});
</script>

<style>
.content-header-compact { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem; padding-bottom: 0.375rem; border-bottom: 2px solid #FFC107; }
.content-header-compact h1 { font-size: 1.25rem; margin: 0; font-weight: 700; }
.btn-sm { padding: 0.25rem 0.625rem; font-size: 0.8125rem; border: 2px solid; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.25rem; cursor: pointer; }
.btn-sm.btn-secondary { background: #6c757d; border-color: #6c757d; color: #fff; }
.card-compact { background: #fff; border: 2px solid #dee2e6; margin-bottom: 0.75rem; }
.card-header-compact { padding: 0.5rem 0.75rem; background: #f8f9fa; border-bottom: 2px solid #dee2e6; }
.card-header-compact h4 { margin: 0; font-size: 0.9375rem; font-weight: 600; }
.card-body-compact { padding: 0.75rem; }
.form-group { margin-bottom: 0.75rem; }
.form-label { display: block; margin-bottom: 0.25rem; font-weight: 600; font-size: 0.8125rem; }
.form-label.required::after { content: ' *'; color: #dc3545; }
.form-control { width: 100%; padding: 0.375rem 0.5rem; border: 2px solid #dee2e6; font-size: 0.8125rem; }
.form-control:focus { outline: none; border-color: #FFC107; background: #fff9e6; }
.form-text { display: block; margin-top: 0.25rem; font-size: 0.75rem; color: #6c757d; }
.form-check { display: flex; align-items: center; gap: 0.5rem; }
.form-check-input { width: 16px; height: 16px; border: 2px solid #dee2e6; cursor: pointer; }
.form-check-label { font-size: 0.8125rem; cursor: pointer; }
.btn { padding: 0.375rem 0.75rem; font-size: 0.8125rem; border: 2px solid; font-weight: 600; text-decoration: none; display: inline-block; text-align: center; cursor: pointer; }
.btn-primary { background: #FFC107; border-color: #FFC107; color: #000; }
.btn-primary:hover { background: #000; color: #FFC107; }
.btn-secondary { background: #6c757d; border-color: #6c757d; color: #fff; }
.d-grid { display: grid; }
.gap-2 { gap: 0.5rem; }
.my-3 { margin-top: 0.75rem; margin-bottom: 0.75rem; }
.mt-2 { margin-top: 0.5rem; }
hr { border: 0; border-top: 1px solid #dee2e6; margin: 0.75rem 0; }
.alert { padding: 0.625rem 0.75rem; margin-bottom: 0.75rem; border: 2px solid; font-size: 0.8125rem; }
.alert-danger { background: #f8d7da; border-color: #dc3545; color: #721c24; }
</style>

<?php include 'includes/footer.php'; ?>
