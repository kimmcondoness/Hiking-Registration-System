<?php

include('../hikingdatabase.php');
$page = 'Dashboard';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $page; ?> - Hiking Portal</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php include('include/navbar.php'); ?>
        
        <div id="layoutSidenav">
        <?php include('include/sidebar.php'); ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">

    <!--PAGE BANNER -->
    <div class="page-banner mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">
                    <i class="<?php echo $page_icon ?? 'fas fa-layer-group'; ?> me-2"></i>
                    <?php echo $page_title ?? 'Dashboard'; ?>
                </h2>
                <p class="mb-0 opacity-75">
                    <?php echo $page_desc ?? 'Manage your hiking portal easily.'; ?>
                </p>
            </div>

            <?php if (!empty($page_button)): ?>
                <div>
                    <?php echo $page_button; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
                        
                        <!-- content -->

                        <!-- content -->
                    </div>
                </main>

                <?php include('include/footer.php');?>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>