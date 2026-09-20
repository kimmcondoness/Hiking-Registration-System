<?php
include('../hikingdatabase.php');
requireLogin();

// Handle DELETE
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = mysqli_prepare($conn, "DELETE FROM event WHERE event_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        setFlash('success', 'Event deleted successfully.');
    } else {
        setFlash('danger', 'Failed to delete event.');
    }
    mysqli_stmt_close($stmt);
    header("Location: event-display.php");
    exit();
}

$sql = "SELECT * FROM event ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
$flash = getFlash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Events - Hiking Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .card { border: none; border-radius: 12px; }
        .card-header { border-radius: 12px 12px 0 0 !important; }
        .badge-difficulty { font-size: 0.75rem; padding: 4px 10px; border-radius: 20px; }
        .btn-action { border-radius: 6px; padding: 4px 10px; font-size: 0.8rem; margin: 1px; }
        .event-img { width: 60px; height: 40px; object-fit: cover; border-radius: 6px; }
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
                <i class="fas fa-calendar-alt me-2"></i>Events Management
            </h2>
            <p class="mb-0 opacity-75">
                Manage and organize all hiking events in your system.
            </p>
        </div>
        <div>
            <a href="add-event.php" class="btn btn-light">
                <i class="fas fa-plus me-1"></i>Add New Event
            </a>
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
                        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                            <span class="fw-bold"><i class="fas fa-list me-2"></i>All Events (<?php echo mysqli_num_rows($result); ?>)</span>
                            <a href="add-event.php" class="btn btn-success btn-sm"><i class="fas fa-plus me-1"></i>Add New Event</a>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Event Name</th>
                                        <th>Location</th>
                                        <th>Date</th>
                                        <th>Organizer</th>
                                        <th>Difficulty</th>
                                        <th>Capacity</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td>
                                            <?php if ($row['event_image']): ?>
                                                <img src="<?php echo htmlspecialchars($row['event_image']); ?>" class="event-img" alt="">
                                            <?php else: ?>
                                                <span class="text-muted"><i class="fas fa-image"></i></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="fw-bold"><?php echo htmlspecialchars($row['event_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['event_location']); ?></td>
                                        <td><?php echo $row['event_date'] ? date('d M Y', strtotime($row['event_date'])) : '-'; ?></td>
                                        <td><?php echo htmlspecialchars($row['event_organizer']); ?></td>
                                        <td>
                                            <?php
                                            $diffColors = ['Easy' => 'success', 'Moderate' => 'warning', 'Hard' => 'danger', 'Expert' => 'dark'];
                                            $dc = $diffColors[$row['difficulty']] ?? 'secondary';
                                            ?>
                                            <span class="badge bg-<?php echo $dc; ?> badge-difficulty"><?php echo $row['difficulty']; ?></span>
                                        </td>
                                        <td><?php echo $row['current_hikers']; ?>/<?php echo $row['max_hikers']; ?></td>
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
                                            <a href="edit-event.php?id=<?php echo $row['event_id']; ?>" class="btn btn-primary btn-action" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="view-event.php?id=<?php echo $row['event_id']; ?>" class="btn btn-info btn-action text-white" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="event-display.php?delete=<?php echo $row['event_id']; ?>" class="btn btn-danger btn-action" title="Delete" onclick="return confirm('Are you sure you want to delete this event?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('include/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>
