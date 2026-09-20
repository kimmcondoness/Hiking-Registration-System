<?php
include('../hikingdatabase.php');
requireLogin();

// Handle DELETE
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = mysqli_prepare($conn, "DELETE FROM hikers WHERE hikers_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        setFlash('success', 'Hiker deleted successfully.');
    } else {
        setFlash('danger', 'Failed to delete hiker.');
    }
    mysqli_stmt_close($stmt);
    header("Location: events_list.php");
    exit();
}

$sql = "SELECT * FROM hikers ORDER BY registration_date DESC";
$result = mysqli_query($conn, $sql);
$flash = getFlash();
$no = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Hikers List - Hiking Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .card { border: none; border-radius: 12px; }
        .btn-action { border-radius: 6px; padding: 4px 10px; font-size: 0.8rem; margin: 1px; }
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
                <i class="fas fa-users me-2"></i>Hikers Management
            </h2>
            <p class="mb-0 opacity-75">
                View and manage all registered hikers.
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
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <span class="fw-bold"><i class="fas fa-list me-2"></i>Registered Hikers (<?php echo mysqli_num_rows($result); ?>)</span>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Experience</th>
                                        <th>Email</th>
                                        <th>Event</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td class="fw-bold"><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['tel_no']); ?></td>
                                        <td class="text-center"><?php echo $row['age']; ?></td>
                                        <td>
                                            <span class="badge <?php echo ($row['gender'] == 'Male') ? 'bg-primary' : 'bg-pink'; ?>" style="<?php echo ($row['gender'] == 'Female') ? 'background:#e91e63;' : ''; ?>">
                                                <?php echo $row['gender']; ?>
                                            </span>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['experience']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><span class="badge bg-success"><?php echo htmlspecialchars($row['event_option']); ?></span></td>
                                        <td>
                                            <a href="view-hikers.php?id=<?php echo $row['hikers_id']; ?>" class="btn btn-info btn-action text-white" title="View/Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="events_list.php?delete=<?php echo $row['hikers_id']; ?>" class="btn btn-danger btn-action" title="Delete" onclick="return confirm('Are you sure you want to delete this hiker?')">
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
