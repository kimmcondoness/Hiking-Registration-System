<?php
include('../hikingdatabase.php');
requireLogin();

// Handle DELETE
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = mysqli_prepare($conn, "DELETE FROM contact_us WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        setFlash('success', 'Message deleted.');
    }
    mysqli_stmt_close($stmt);
    header("Location: contact-messages.php");
    exit();
}

// Handle mark as read
if (isset($_GET['read']) && is_numeric($_GET['read'])) {
    $id = intval($_GET['read']);
    $stmt = mysqli_prepare($conn, "UPDATE contact_us SET is_read = 1 WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: contact-messages.php");
    exit();
}

$sql = "SELECT * FROM contact_us ORDER BY is_read ASC, reg_date DESC";
$result = mysqli_query($conn, $sql);
$flash = getFlash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Messages - Hiking Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .card { border: none; border-radius: 12px; }
        .unread { background: #f0fff4; font-weight: 500; }
        .btn-action { border-radius: 6px; padding: 4px 10px; font-size: 0.8rem; margin: 1px; }
        .msg-preview { max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
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
                <i class="fas fa-envelope me-2"></i>Contact Messages
            </h2>
            <p class="mb-0 opacity-75">
                Read and manage messages sent by users.
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
                            <i class="fas fa-inbox me-2"></i>All Messages
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Type</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr class="<?php echo ($row['is_read'] == 0) ? 'unread' : ''; ?>">
                                        <td>
                                            <?php if ($row['is_read'] == 0): ?>
                                                <span class="badge bg-danger">New</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Read</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['tel_no']); ?></td>
                                        <td>
                                            <span class="badge <?php echo ($row['msg_type'] == 'Report') ? 'bg-warning text-dark' : 'bg-info'; ?>">
                                                <?php echo $row['msg_type']; ?>
                                            </span>
                                        </td>
                                        <td class="msg-preview" title="<?php echo htmlspecialchars($row['message']); ?>"><?php echo htmlspecialchars($row['message']); ?></td>
                                        <td><?php echo date('d M Y', strtotime($row['reg_date'])); ?></td>
                                        <td>
                                            <?php if ($row['is_read'] == 0): ?>
                                                <a href="contact-messages.php?read=<?php echo $row['id']; ?>" class="btn btn-success btn-action" title="Mark as Read">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            <?php endif; ?>
                                            <a href="contact-messages.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-action" title="Delete" onclick="return confirm('Delete this message?')">
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
