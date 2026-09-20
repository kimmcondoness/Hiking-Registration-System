<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<link rel="stylesheet" href="main.css">

<header class="header-modern">
    <div class="nav-modern">

        <!-- LOGO -->
        <a href="index.php" class="logo">
            <img src="assets/images/salji.png">
        </a>

        <!-- NAVIGATION -->
        <div class="nav-links">
            <a href="index.php" <?php echo ($current_page=='index.php')?'class="active"':''; ?>>Home</a>
            <a href="about-us.php" <?php echo ($current_page=='about-us.php')?'class="active"':''; ?>>About</a>
            <a href="search.php">Search</a>
            <a href="event.php" <?php echo ($current_page=='event.php')?'class="active"':''; ?>>Events</a>
            <a href="contact-us.php" <?php echo ($current_page=='contact-us.php')?'class="active"':''; ?>>Contact</a>
            <a href="admin/index.php" class="admin-btn">Admin</a>
        </div>

    </div>
</header>