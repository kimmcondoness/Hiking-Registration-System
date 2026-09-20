<?php
include('../hikingdatabase.php');
requireLogin();

$errors = [];
$event = null;

// Get event data
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = mysqli_prepare($conn, "SELECT * FROM event WHERE event_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $event = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if (!$event) {
        setFlash('danger', 'Event not found.');
        header("Location: event-display.php");
        exit();
    }
} else {
    header("Location: event-display.php");
    exit();
}

// Handle UPDATE
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
    $event_id = intval($_POST['event_id']);

    if (empty($event_name)) $errors[] = "Event name is required.";
    if (empty($event_organizer)) $errors[] = "Event organizer is required.";
    if (empty($event_location)) $errors[] = "Event location is required.";

    if (empty($errors)) {
        $stmt = mysqli_prepare($conn, "UPDATE event SET event_organizer=?, event_location=?, event_name=?, event_description=?, event_date=?, event_image=?, max_hikers=?, difficulty=?, status=?, approved_by=? WHERE event_id=?");
        mysqli_stmt_bind_param($stmt, "ssssssisssi", $event_organizer, $event_location, $event_name, $event_description, $event_date, $event_image, $max_hikers, $difficulty, $status, $approved_by, $event_id);

        if (mysqli_stmt_execute($stmt)) {
            setFlash('success', 'Event "' . $event_name . '" updated successfully!');
            header("Location: event-display.php");
            exit();
        } else {
            $errors[] = "Database error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
    // Re-populate event with POST data on error
    $event = array_merge($event, $_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Event - Hiking Portal</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .card { border: none; border-radius: 12px; }
        .form-label { font-weight: 600; color: #333; }
        .form-control:focus, .form-select:focus { 
        border-color: #6366f1; 
        box-shadow: 0 0 0 0.2rem rgba(99,102,241,0.25); 
    }
        .img-preview { max-width: 100%; max-height: 200px; border-radius: 8px; margin-top: 10px; }
    </style>
</head>
<body class="sb-nav-fixed">
    <?php include('include/navbar.php'); ?>
    <div id="layoutSidenav">
        <?php include('include/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><i class="fas fa-edit me-2"></i>Edit Event</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="event-display.php">Events</a></li>
                        <li class="breadcrumb-item active">Edit: <?php echo htmlspecialchars($event['event_name']); ?></li>
                    </ol>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0"><?php foreach($errors as $e) echo "<li>$e</li>"; ?></ul>
                        </div>
                    <?php endif; ?>

                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <span class="fw-bold"><i class="fas fa-edit me-2"></i>Update Event Details</span>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <input type="hidden" name="event_id" value="<?php echo $event['event_id']; ?>">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Event Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="event_name" value="<?php echo htmlspecialchars($event['event_name']); ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Event Organizer <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="event_organizer" value="<?php echo htmlspecialchars($event['event_organizer']); ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Location <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="event_location" value="<?php echo htmlspecialchars($event['event_location']); ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Event Date</label>
                                        <input type="date" class="form-control" name="event_date" value="<?php echo $event['event_date']; ?>">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="event_description" rows="4"><?php echo htmlspecialchars($event['event_description'] ?? ''); ?></textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Image URL</label>
                                        <input type="url" class="form-control" name="event_image" id="imageUrl" value="<?php echo htmlspecialchars($event['event_image'] ?? ''); ?>" oninput="previewImage(this.value)">
                                        <?php if (!empty($event['event_image'])): ?>
                                            <img id="imgPreview" class="img-preview" src="<?php echo htmlspecialchars($event['event_image']); ?>" alt="Preview">
                                        <?php else: ?>
                                            <img id="imgPreview" class="img-preview" style="display:none;" alt="Preview">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Max Hikers</label>
                                        <input type="number" class="form-control" name="max_hikers" min="1" value="<?php echo $event['max_hikers']; ?>">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Difficulty</label>
                                        <select class="form-select" name="difficulty">
                                            <?php foreach(['Easy','Moderate','Hard','Expert'] as $d): ?>
                                                <option value="<?php echo $d; ?>" <?php echo ($event['difficulty'] == $d) ? 'selected' : ''; ?>><?php echo $d; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Approved By</label>
                                        <input type="text" class="form-control" name="approved_by" value="<?php echo htmlspecialchars($event['approved_by'] ?? ''); ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" name="status">
                                            <option value="Pending" <?php echo ($event['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                            <option value="Approve" <?php echo ($event['status'] == 'Approve') ? 'selected' : ''; ?>>Approved</option>
                                            <option value="Cancelled" <?php echo ($event['status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Update Event</button>
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
