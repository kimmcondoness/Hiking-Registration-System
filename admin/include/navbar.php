<nav class="sb-topnav navbar navbar-expand navbar-dark custom-navbar">
    <a class="navbar-brand ps-3" href="dashboard.php">
        <i class="fas fa-mountain me-2"></i>Hiking Portal
    </a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
        <i class="fas fa-bars"></i>
    </button>
    <div class="d-none d-md-inline-block ms-auto me-3">
        <span class="text-light small"><i class="fas fa-calendar me-1"></i><?php echo date('l, d M Y'); ?></span>
    </div>
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item">
            <a class="nav-link" href="../index.php" target="_blank" title="View Website">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
