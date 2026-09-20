<?php
include('../hikingdatabase.php');
requireLogin();

// Handle status update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['event_id']) && isset($_POST['status'])) {
    $event_id = intval($_POST['event_id']);
    $new_status = sanitize($_POST['status']);
    
    $stmt = mysqli_prepare($conn, "UPDATE event SET status = ? WHERE event_id = ?");
    mysqli_stmt_bind_param($stmt, "si", $new_status, $event_id);
    if (mysqli_stmt_execute($stmt)) {
        setFlash('success', 'Event status updated to ' . $new_status . '.');
    } else {
        setFlash('danger', 'Failed to update status.');
    }
    mysqli_stmt_close($stmt);
    header("Location: update-event.php");
    exit();
}

$sql = "SELECT * FROM event ORDER BY FIELD(status, 'Pending', 'Approve', 'Cancelled'), created_at DESC";
$result = mysqli_query($conn, $sql);
$flash = getFlash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Approve Events - Hiking Portal</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .card { border: none; border-radius: 12px; }
        .status-select { min-width: 130px; }
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
                <i class="fas fa-check-circle me-2"></i>Approve Events
            </h2>
            <p class="mb-0 opacity-75">
                Review and approve hiking events submitted by organizers.
            </p>
        </div>
    </div>
</div>

                    <?php if ($flash): ?>
                        <div class="alert alert-<?php echo $flash['type']; ?> alert-dismissible fade show" role="alert">
                            <?php echo $flash['message']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white py-3 fw-bold">
                            <i class="fas fa-tasks me-2"></i>Update Event Status
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Event Name</th>
                                            <th>Location</th>
                                            <th>Organizer</th>
                                            <th>Max Hikers</th>
                                            <th>Current Status</th>
                                            <th>Change Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td class="fw-bold"><?php echo htmlspecialchars($row['event_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['event_location']); ?></td>
                                            <td><?php echo htmlspecialchars($row['event_organizer']); ?></td>
                                            <td><?php echo $row['max_hikers']; ?></td>
                                            <td>
                                                <?php if ($row['status'] === 'Pending'): ?>
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                <?php elseif ($row['status'] === 'Approve'): ?>
                                                    <span class="badge bg-success">Approved</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary"><?php echo $row['status']; ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <form method="POST" class="d-flex gap-2" id="form-<?php echo $row['event_id']; ?>">
                                                    <input type="hidden" name="event_id" value="<?php echo $row['event_id']; ?>">
                                                    <select class="form-select form-select-sm status-select" name="status">
                                                        <option value="Pending" <?php echo ($row['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                                        <option value="Approve" <?php echo ($row['status'] == 'Approve') ? 'selected' : ''; ?>>Approved</option>
                                                        <option value="Cancelled" <?php echo ($row['status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                                                    </select>
                                            </td>
                                            <td>
                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save me-1"></i>Update</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
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
