<?php
include("../hikingdatabase.php");
requireLogin();

$hiker = null;
$errors = [];

// GET hiker
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $hikers_id = intval($_GET['id']);
    $stmt = mysqli_prepare($conn, "SELECT * FROM hikers WHERE hikers_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $hikers_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $hiker = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if (!$hiker) {
        setFlash('danger', 'Hiker not found.');
        header("Location: events_list.php");
        exit();
    }
} else {
    header("Location: events_list.php");
    exit();
}

// Handle UPDATE
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hikers_id = intval($_POST['hikers_id']);
    $name = sanitize($_POST['name'] ?? '');
    $tel_no = sanitize($_POST['tel_no'] ?? '');
    $age = intval($_POST['age'] ?? 0);
    $gender = sanitize($_POST['gender'] ?? '');
    $experience = sanitize($_POST['experience'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $emergency_contact = sanitize($_POST['emergency_contact'] ?? '');
    $medical_notes = sanitize($_POST['medical_notes'] ?? '');

    if (empty($name)) $errors[] = "Name is required.";
    if (empty($email)) $errors[] = "Email is required.";
    if ($age < 1) $errors[] = "Valid age is required.";

    if (empty($errors)) {
        $stmt = mysqli_prepare($conn, "UPDATE hikers SET name=?, tel_no=?, age=?, gender=?, experience=?, email=?, emergency_contact=?, medical_notes=? WHERE hikers_id=?");
        mysqli_stmt_bind_param($stmt, "ssisssssi", $name, $tel_no, $age, $gender, $experience, $email, $emergency_contact, $medical_notes, $hikers_id);

        if (mysqli_stmt_execute($stmt)) {
            setFlash('success', 'Hiker "' . $name . '" updated successfully!');
            header("Location: events_list.php");
            exit();
        } else {
            $errors[] = "Database error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
    // Re-populate on error
    $hiker = array_merge($hiker, $_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Hiker - Hiking Portal</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .card { border: none; border-radius: 12px; }
        .form-label { font-weight: 600; color: #333; }
        .form-control:focus, .form-select:focus { border-color: #2ecc71; box-shadow: 0 0 0 0.2rem rgba(46,204,113,0.25); }
        .hiker-avatar { width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #2ecc71, #27ae60); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 700; }
    </style>
</head>
<body class="sb-nav-fixed">
    <?php include('include/navbar.php'); ?>
    <div id="layoutSidenav">
        <?php include('include/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><i class="fas fa-user-edit me-2"></i>Edit Hiker</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="events_list.php">Hikers</a></li>
                        <li class="breadcrumb-item active"><?php echo htmlspecialchars($hiker['name']); ?></li>
                    </ol>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0"><?php foreach($errors as $e) echo "<li>$e</li>"; ?></ul>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body text-center py-4">
                                    <div class="hiker-avatar mx-auto mb-3">
                                        <?php echo strtoupper(substr($hiker['name'], 0, 1)); ?>
                                    </div>
                                    <h5><?php echo htmlspecialchars($hiker['name']); ?></h5>
                                    <p class="text-muted mb-1"><i class="fas fa-envelope me-1"></i><?php echo htmlspecialchars($hiker['email']); ?></p>
                                    <p class="text-muted mb-1"><i class="fas fa-phone me-1"></i><?php echo htmlspecialchars($hiker['tel_no']); ?></p>
                                    <span class="badge bg-success"><?php echo htmlspecialchars($hiker['event_option']); ?></span>
                                    <hr>
                                    <p class="small text-muted mb-0">Registered: <?php echo date('d M Y', strtotime($hiker['registration_date'] ?? 'now')); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-white py-3 fw-bold">
                                    <i class="fas fa-edit me-2"></i>Update Information
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                        <input type="hidden" name="hikers_id" value="<?php echo $hiker['hikers_id']; ?>">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($hiker['name']); ?>" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($hiker['email']); ?>" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Phone Number</label>
                                                <input type="text" class="form-control" name="tel_no" value="<?php echo htmlspecialchars($hiker['tel_no']); ?>">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Age <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="age" min="1" value="<?php echo $hiker['age']; ?>" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Gender</label>
                                                <select class="form-select" name="gender">
                                                    <option value="Male" <?php echo ($hiker['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                                    <option value="Female" <?php echo ($hiker['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Experience</label>
                                                <input type="text" class="form-control" name="experience" value="<?php echo htmlspecialchars($hiker['experience']); ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Emergency Contact</label>
                                                <input type="text" class="form-control" name="emergency_contact" value="<?php echo htmlspecialchars($hiker['emergency_contact'] ?? ''); ?>" placeholder="Phone number">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Medical Notes</label>
                                                <textarea class="form-control" name="medical_notes" rows="3" placeholder="Any allergies, conditions, etc."><?php echo htmlspecialchars($hiker['medical_notes'] ?? ''); ?></textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Update Hiker</button>
                                            <a href="events_list.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i>Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('include/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
