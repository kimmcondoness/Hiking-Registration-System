<?php
include('../hikingdatabase.php');
requireLogin();

$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_organizer = sanitize($_POST['event_organizer'] ?? '');
    $event_location = sanitize($_POST['event_location'] ?? '');
    $event_name = sanitize($_POST['event_name'] ?? '');
    $event_description = sanitize($_POST['event_description'] ?? '');
    $event_date = $_POST['event_date'] ?? '';
    $event_image = sanitize($_POST['event_image'] ?? '');
    $max_hikers = intval($_POST['max_hikers'] ?? 50);
    $difficulty = sanitize($_POST['difficulty'] ?? 'Moderate');
    $status = sanitize($_POST['status'] ?? 'Pending');
    $approved_by = sanitize($_POST['approved_by'] ?? '');

    // Validation
    if (empty($event_name)) $errors[] = "Event name is required.";
    if (empty($event_organizer)) $errors[] = "Event organizer is required.";
    if (empty($event_location)) $errors[] = "Event location is required.";
    if ($max_hikers < 1) $errors[] = "Max hikers must be at least 1.";

    if (empty($errors)) {
        $stmt = mysqli_prepare($conn, "INSERT INTO event (event_organizer, event_location, event_name, event_description, event_date, event_image, max_hikers, difficulty, status, approved_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssssssisss", $event_organizer, $event_location, $event_name, $event_description, $event_date, $event_image, $max_hikers, $difficulty, $status, $approved_by);

        if (mysqli_stmt_execute($stmt)) {
            setFlash('success', 'Event "' . $event_name . '" added successfully!');
            header("Location: event-display.php");
            exit();
        } else {
            $errors[] = "Database error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Add Event - Hiking Portal</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .card { border: none; border-radius: 12px; }
        .form-label { font-weight: 600; color: #333; }
       .form-control:focus, 
.form-select:focus { 
    border-color: #6366f1; 
    box-shadow: 0 0 0 0.2rem rgba(99,102,241,0.25); 
}

.btn-success { 
    background: linear-gradient(135deg, #6366f1, #4f46e5); 
    border: none; 
}

.btn-success:hover {
    background: linear-gradient(135deg, #4f46e5, #4338ca);
}
        .img-preview { max-width: 100%; max-height: 200px; border-radius: 8px; display: none; margin-top: 10px; }
    </style>
</head>
<body class="sb-nav-fixed">
    <?php include('include/navbar.php'); ?>
    <div id="layoutSidenav">
        <?php include('include/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="page-banner mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-1">
                <i class="fas fa-plus-circle me-2"></i>Add New Event
            </h2>
            <p class="mb-0 opacity-75">
                Create and manage new hiking events.
            </p>
        </div>
    </div>
</div>
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <ul class="mb-0"><?php foreach($errors as $e) echo "<li>$e</li>"; ?></ul>
                        </div>
                    <?php endif; ?>

                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <span class="fw-bold"><i class="fas fa-edit me-2"></i>Event Details</span>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="event_name" class="form-label">Event Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="event_name" id="event_name" value="<?php echo $_POST['event_name'] ?? ''; ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="event_organizer" class="form-label">Event Organizer <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="event_organizer" value="<?php echo $_POST['event_organizer'] ?? ''; ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="event_location" class="form-label">Location <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="event_location" value="<?php echo $_POST['event_location'] ?? ''; ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="event_date" class="form-label">Event Date</label>
                                        <input type="date" class="form-control" name="event_date" value="<?php echo $_POST['event_date'] ?? ''; ?>">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="event_description" class="form-label">Description</label>
                                        <textarea class="form-control" name="event_description" rows="4"><?php echo $_POST['event_description'] ?? ''; ?></textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="event_image" class="form-label">Image URL</label>
                                        <input type="url" class="form-control" name="event_image" id="imageUrl" value="<?php echo $_POST['event_image'] ?? ''; ?>" placeholder="https://..." oninput="previewImage(this.value)">
                                        <img id="imgPreview" class="img-preview" alt="Preview">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="max_hikers" class="form-label">Max Hikers <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="max_hikers" min="1" value="<?php echo $_POST['max_hikers'] ?? '50'; ?>" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="difficulty" class="form-label">Difficulty</label>
                                        <select class="form-select" name="difficulty">
                                            <?php foreach(['Easy','Moderate','Hard','Expert'] as $d): ?>
                                                <option value="<?php echo $d; ?>" <?php echo (($_POST['difficulty'] ?? 'Moderate') == $d) ? 'selected' : ''; ?>><?php echo $d; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="approved_by" class="form-label">Approved By</label>
                                        <input type="text" class="form-control" name="approved_by" value="<?php echo $_POST['approved_by'] ?? ($_SESSION['admin_name'] ?? 'Admin'); ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" name="status">
                                            <option value="Pending" <?php echo (($_POST['status'] ?? '') == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                            <option value="Approve" <?php echo (($_POST['status'] ?? '') == 'Approve') ? 'selected' : ''; ?>>Approved</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i>Save Event</button>
                                    <a href="event-display.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i>Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('include/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script>
        function previewImage(url) {
            const img = document.getElementById('imgPreview');
            if (url) { img.src = url; img.style.display = 'block'; img.onerror = function(){ this.style.display='none'; }; }
            else { img.style.display = 'none'; }
        }
    </script>
</body>
</html>
