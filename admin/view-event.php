<?php
include('../hikingdatabase.php');
requireLogin();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: event-display.php");
    exit();
}

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

// Get hikers registered for this event
$stmtHikers = mysqli_prepare($conn, "SELECT * FROM hikers WHERE event_option LIKE ?");
$search = '%' . $event['event_name'] . '%';
mysqli_stmt_bind_param($stmtHikers, "s", $search);
mysqli_stmt_execute($stmtHikers);
$hikersResult = mysqli_stmt_get_result($stmtHikers);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>View Event - Hiking Portal</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .card { border: none; border-radius: 12px; }
        .event-hero { width: 100%; height: 250px; object-fit: cover; border-radius: 12px; }
        .detail-label { font-weight: 600; color: #666; font-size: 0.85rem; text-transform: uppercase; }
        .detail-value { font-size: 1rem; color: #333; margin-bottom: 1rem; }
    </style>
</head>
<body class="sb-nav-fixed">
    <?php include('include/navbar.php'); ?>
    <div id="layoutSidenav">
        <?php include('include/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><i class="fas fa-eye me-2"></i>Event Details</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="event-display.php">Events</a></li>
                        <li class="breadcrumb-item active"><?php echo htmlspecialchars($event['event_name']); ?></li>
                    </ol>

                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="card shadow-sm mb-4">
                                <?php if ($event['event_image']): ?>
                                    <img src="<?php echo htmlspecialchars($event['event_image']); ?>" class="event-hero" alt="">
                                <?php endif; ?>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h3 class="mb-0"><?php echo htmlspecialchars($event['event_name']); ?></h3>
                                        <?php if ($event['status'] === 'Approve'): ?>
                                            <span class="badge bg-success fs-6">Approved</span>
                                        <?php elseif ($event['status'] === 'Pending'): ?>
                                            <span class="badge bg-warning text-dark fs-6">Pending</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary fs-6"><?php echo $event['status']; ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-muted"><?php echo nl2br(htmlspecialchars($event['event_description'] ?? 'No description provided.')); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <div class="detail-label">Organizer</div>
                                    <div class="detail-value"><i class="fas fa-user me-2 text-success"></i><?php echo htmlspecialchars($event['event_organizer']); ?></div>
                                    <div class="detail-label">Location</div>
                                    <div class="detail-value"><i class="fas fa-map-marker-alt me-2 text-danger"></i><?php echo htmlspecialchars($event['event_location']); ?></div>
                                    <div class="detail-label">Date</div>
                                    <div class="detail-value"><i class="fas fa-calendar me-2 text-primary"></i><?php echo $event['event_date'] ? date('d M Y', strtotime($event['event_date'])) : 'TBD'; ?></div>
                                    <div class="detail-label">Difficulty</div>
                                    <div class="detail-value">
                                        <?php
                                        $diffColors = ['Easy' => 'success', 'Moderate' => 'warning', 'Hard' => 'danger', 'Expert' => 'dark'];
                                        $dc = $diffColors[$event['difficulty']] ?? 'secondary';
                                        ?>
                                        <span class="badge bg-<?php echo $dc; ?>"><?php echo $event['difficulty']; ?></span>
                                    </div>
                                    <div class="detail-label">Capacity</div>
                                    <div class="detail-value"><i class="fas fa-users me-2 text-info"></i><?php echo $event['current_hikers']; ?> / <?php echo $event['max_hikers']; ?></div>
                                    <div class="detail-label">Approved By</div>
                                    <div class="detail-value"><i class="fas fa-check-circle me-2 text-success"></i><?php echo htmlspecialchars($event['approved_by'] ?? '-'); ?></div>
                                    <hr>
                                    <div class="d-grid gap-2">
                                        <a href="edit-event.php?id=<?php echo $event['event_id']; ?>" class="btn btn-primary"><i class="fas fa-edit me-1"></i>Edit Event</a>
                                        <a href="event-display.php" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i>Back to Events</a>
                                    </div>
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
