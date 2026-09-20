<?php
include('../hikingdatabase.php');
requireLogin();

// dashboard
$page_title = "Welcome back, Admin!";
$page_desc = "Here's what's happening with your hiking portal today.";
$page_icon = "fas fa-mountain";
$page_button = '<a href="add-event.php" class="btn btn-light">+ New Event</a>';

// Total hikers
$sqlTotalHikers = "SELECT COUNT(*) AS total FROM hikers";
$resultTotalHikers = mysqli_query($conn, $sqlTotalHikers);
$totalHikers = mysqli_fetch_assoc($resultTotalHikers)['total'];

// Total events
$sqlTotalEvent = "SELECT COUNT(*) AS total FROM event";
$resultTotalEvent = mysqli_query($conn, $sqlTotalEvent);
$totalEvent = mysqli_fetch_assoc($resultTotalEvent)['total'];

// Pending events
$sqlPending = "SELECT COUNT(*) AS total FROM event WHERE status = 'Pending'";
$resultPending = mysqli_query($conn, $sqlPending);
$totalPending = mysqli_fetch_assoc($resultPending)['total'];

// Approved events
$sqlApproved = "SELECT COUNT(*) AS total FROM event WHERE status = 'Approve'";
$resultApproved = mysqli_query($conn, $sqlApproved);
$totalApproved = mysqli_fetch_assoc($resultApproved)['total'];

// Total messages
$sqlMessages = "SELECT COUNT(*) AS total FROM contact_us";
$resultMessages = mysqli_query($conn, $sqlMessages);
$totalMessages = mysqli_fetch_assoc($resultMessages)['total'];

// Unread messages
$sqlUnread = "SELECT COUNT(*) AS total FROM contact_us WHERE is_read = 0";
$resultUnread = mysqli_query($conn, $sqlUnread);
$totalUnread = mysqli_fetch_assoc($resultUnread)['total'];

// Recent reports
$sqlReports = "SELECT * FROM contact_us ORDER BY reg_date DESC LIMIT 5";
$resultReports = mysqli_query($conn, $sqlReports);

// Recent hikers
$sqlRecentHikers = "SELECT * FROM hikers ORDER BY registration_date DESC LIMIT 5";
$resultRecentHikers = mysqli_query($conn, $sqlRecentHikers);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - Hiking Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .stat-card { border: none; border-radius: 12px; transition: transform 0.2s; overflow: hidden; }
        .stat-card:hover { transform: translateY(-5px); }
        .stat-card .card-body { padding: 1.5rem; }
        .stat-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }
        .stat-number { font-size: 1.8rem; font-weight: 700; }
        .stat-label { font-size: 0.85rem; color: #6c757d; font-weight: 500; }
       /* PURPLE THEME */

        .bg-gradient-green,
        .bg-gradient-blue,
        .bg-gradient-orange,
        .bg-gradient-red,
        .bg-gradient-purple,
        .bg-gradient-teal {
        background: linear-gradient(135deg, #6366f1, #4f46e5) !important;
}

.welcome-banner {
    background: linear-gradient(135deg, #6366f1, #1e293b) !important;
    border-radius: 15px;
    padding: 2rem;
    color: #fff;
    margin-bottom: 1.5rem;
}
        .table-card { border: none; border-radius: 12px; }
        .table-card .card-header { background: #fff; border-bottom: 2px solid #f0f0f0; font-weight: 600; border-radius: 12px 12px 0 0 !important; }
        .badge-pending { background: #f39c12; }
        .badge-approved { background: #2ecc71; }
    </style>
</head>
<body class="sb-nav-fixed">
    <?php include('include/navbar.php'); ?>
    <div id="layoutSidenav">
        <?php include('include/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <!-- Welcome Banner -->
                    <div class="welcome-banner mt-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h2 class="mb-1"><i class="fas fa-mountain me-2"></i>Welcome back, <?php echo isset($_SESSION['admin_name']) ? htmlspecialchars($_SESSION['admin_name']) : 'Admin'; ?>!</h2>
                                <p class="mb-0 opacity-75">Here's what's happening with your hiking portal today.</p>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="add-event.php" class="btn btn-light btn-lg"><i class="fas fa-plus me-2"></i>New Event</a>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row g-4 mb-4">
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="card stat-card shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div class="stat-icon bg-gradient-green text-white"><i class="fas fa-users"></i></div>
                                    </div>
                                    <div class="stat-number"><?php echo $totalHikers; ?></div>
                                    <div class="stat-label">Total Hikers</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="card stat-card shadow-sm">
                                <div class="card-body">
                                    <div class="stat-icon bg-gradient-blue text-white mb-2"><i class="fas fa-calendar-alt"></i></div>
                                    <div class="stat-number"><?php echo $totalEvent; ?></div>
                                    <div class="stat-label">Total Events</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="card stat-card shadow-sm">
                                <div class="card-body">
                                    <div class="stat-icon bg-gradient-teal text-white mb-2"><i class="fas fa-check-double"></i></div>
                                    <div class="stat-number"><?php echo $totalApproved; ?></div>
                                    <div class="stat-label">Approved</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="card stat-card shadow-sm">
                                <div class="card-body">
                                    <div class="stat-icon bg-gradient-orange text-white mb-2"><i class="fas fa-clock"></i></div>
                                    <div class="stat-number"><?php echo $totalPending; ?></div>
                                    <div class="stat-label">Pending</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="card stat-card shadow-sm">
                                <div class="card-body">
                                    <div class="stat-icon bg-gradient-purple text-white mb-2"><i class="fas fa-envelope"></i></div>
                                    <div class="stat-number"><?php echo $totalMessages; ?></div>
                                    <div class="stat-label">Messages</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="card stat-card shadow-sm">
                                <div class="card-body">
                                    <div class="stat-icon bg-gradient-red text-white mb-2"><i class="fas fa-bell"></i></div>
                                    <div class="stat-number"><?php echo $totalUnread; ?></div>
                                    <div class="stat-label">Unread</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tables Row -->
                    <div class="row g-4">
                        <!-- Recent Messages -->
                        <div class="col-lg-6">
                            <div class="card table-card shadow-sm">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-envelope me-2 text-primary"></i>Recent Messages</span>
                                    <a href="contact-messages.php" class="btn btn-sm btn-outline-primary">View All</a>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="table-light">
                                                <tr><th>Name</th><th>Type</th><th>Date</th></tr>
                                            </thead>
                                            <tbody>
                                                <?php if (mysqli_num_rows($resultReports) > 0): ?>
                                                    <?php while ($row = mysqli_fetch_assoc($resultReports)): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                                        <td><span class="badge <?php echo $row['msg_type'] == 'Report' ? 'bg-danger' : 'bg-info'; ?>"><?php echo $row['msg_type']; ?></span></td>
                                                        <td class="text-muted small"><?php echo date('d M Y', strtotime($row['reg_date'])); ?></td>
                                                    </tr>
                                                    <?php endwhile; ?>
                                                <?php else: ?>
                                                    <tr><td colspan="3" class="text-center text-muted py-4">No messages yet</td></tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Recent Hikers -->
                        <div class="col-lg-6">
                            <div class="card table-card shadow-sm">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-hiking me-2 text-success"></i>Recent Registrations</span>
                                    <a href="events_list.php" class="btn btn-sm btn-outline-success">View All</a>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="table-light">
                                                <tr><th>Name</th><th>Email</th><th>Event</th></tr>
                                            </thead>
                                            <tbody>
                                                <?php if (mysqli_num_rows($resultRecentHikers) > 0): ?>
                                                    <?php while ($row = mysqli_fetch_assoc($resultRecentHikers)): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                                        <td class="small"><?php echo htmlspecialchars($row['email']); ?></td>
                                                        <td><span class="badge bg-success"><?php echo htmlspecialchars($row['event_option']); ?></span></td>
                                                    </tr>
                                                    <?php endwhile; ?>
                                                <?php else: ?>
                                                    <tr><td colspan="3" class="text-center text-muted py-4">No hikers registered yet</td></tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
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
