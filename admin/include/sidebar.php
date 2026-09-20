<?php $current = basename($_SERVER['PHP_SELF']); ?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background: linear-gradient(180deg, #1a5c2e 0%, #145224 100%);">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading" style="color: #8fd4a4;">Main</div>
                <a class="nav-link <?php echo ($current == 'dashboard.php') ? 'active' : ''; ?>" href="dashboard.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading" style="color: #8fd4a4;">Events Management</div>
                <a class="nav-link <?php echo ($current == 'event-display.php') ? 'active' : ''; ?>" href="event-display.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                    All Events
                </a>
                <a class="nav-link <?php echo ($current == 'add-event.php') ? 'active' : ''; ?>" href="add-event.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                    Add New Event
                </a>
                <a class="nav-link <?php echo ($current == 'update-event.php') ? 'active' : ''; ?>" href="update-event.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-check-circle"></i></div>
                    Approve Events
                </a>

                <div class="sb-sidenav-menu-heading" style="color: #8fd4a4;">Hikers Management</div>
                <a class="nav-link <?php echo ($current == 'events_list.php') ? 'active' : ''; ?>" href="events_list.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    All Hikers
                </a>

                <div class="sb-sidenav-menu-heading" style="color: #8fd4a4;">Reports</div>
                <a class="nav-link <?php echo ($current == 'contact-messages.php') ? 'active' : ''; ?>" href="contact-messages.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                    Contact Messages
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer" style="background: rgba(0,0,0,0.2);">
            <div class="small">Logged in as:</div>
            <i class="fas fa-user-shield me-1"></i>
            <?php echo isset($_SESSION['admin_name']) ? htmlspecialchars($_SESSION['admin_name']) : 'Admin'; ?>
        </div>
    </nav>
</div>
