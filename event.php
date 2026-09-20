<?php
include("hikingdatabase.php");
include("header.php");

// Fetch approved events from database
$sql = "SELECT * FROM event WHERE status = 'Approve' ORDER BY event_date ASC";
$result = mysqli_query($conn, $sql);
$events = [];
while ($row = mysqli_fetch_assoc($result)) {
    $events[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Events - HIKING APP</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-574-mexant.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .event-card { background: #fff; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.08); margin-bottom: 30px; transition: transform 0.3s; }
        .event-card:hover { transform: translateY(-5px); }
        .event-card img { width: 100%; height: 250px; object-fit: cover; }
        .event-card .event-body { padding: 25px; }
        .event-card .event-date { display: inline-block; background: linear-gradient(135deg, #2ecc71, #27ae60); color: #fff; padding: 5px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; margin-bottom: 12px; }
        .event-card h4 { color: #1a5c2e; font-weight: 700; margin-bottom: 8px; }
        .event-card .event-meta { color: #888; font-size: 0.85rem; margin-bottom: 10px; }
        .event-card .event-meta i { color: #2ecc71; margin-right: 5px; }
        .difficulty-badge { font-size: 0.75rem; padding: 3px 10px; border-radius: 10px; }
        .capacity-bar { height: 6px; border-radius: 3px; background: #e0e0e0; overflow: hidden; margin-top: 10px; }
        .capacity-fill { height: 100%; border-radius: 3px; background: linear-gradient(90deg, #2ecc71, #27ae60); transition: width 0.5s; }
        .no-events { text-align: center; padding: 60px 20px; color: #888; }
        .no-events i { font-size: 4rem; color: #ccc; margin-bottom: 15px; }
    </style>
</head>
<body>

<<div class="modern-heading">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="header-text">

                    <h2 class="heading-title fade-up">
                        Upcoming Events
                    </h2>

                    <div class="heading-line fade-up delay-1"></div>

                    <p class="heading-subtitle fade-up delay-1">
                        Discover breathtaking trails, meet passionate hikers, and create unforgettable adventures across Malaysia 🌿
                    </p>

                    <a href="#events" class="heading-btn fade-up delay-2">
                        Explore Now
                    </a>

                </div>
            </div>
        </div>
    </div>


<section class="main-services" style="padding: 60px 0;">
    <div class="container">
        <?php if (count($events) > 0): ?>
        <div class="row">
            <?php foreach ($events as $index => $event): ?>
            <div class="col-lg-6">
                <div class="event-card">
                    <?php if (!empty($event['event_image'])): ?>
                        <img src="<?php echo htmlspecialchars($event['event_image']); ?>" alt="<?php echo htmlspecialchars($event['event_name']); ?>">
                    <?php else: ?>
                        <img src="https://images.pexels.com/photos/2606532/pexels-photo-2606532.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Hiking">
                    <?php endif; ?>
                    <div class="event-body">
                        <?php if ($event['event_date']): ?>
                            <span class="event-date"><i class="fas fa-calendar-alt me-1"></i><?php echo date('d M Y', strtotime($event['event_date'])); ?></span>
                        <?php endif; ?>

                        <?php
                        $diffColors = ['Easy' => 'success', 'Moderate' => 'warning', 'Hard' => 'danger', 'Expert' => 'dark'];
                        $dc = $diffColors[$event['difficulty']] ?? 'secondary';
                        ?>
                        <span class="badge bg-<?php echo $dc; ?> difficulty-badge ms-2"><?php echo $event['difficulty']; ?></span>

                        <h4><?php echo htmlspecialchars($event['event_name']); ?></h4>
                        <div class="event-meta">
                            <i class="fas fa-map-marker-alt"></i><?php echo htmlspecialchars($event['event_location']); ?>
                            &nbsp;&nbsp;
                            <i class="fas fa-user"></i><?php echo htmlspecialchars($event['event_organizer']); ?>
                        </div>
                        <p><?php echo htmlspecialchars(substr($event['event_description'] ?? '', 0, 200)); ?><?php echo (strlen($event['event_description'] ?? '') > 200) ? '...' : ''; ?></p>

                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-users me-1"></i><?php echo $event['current_hikers']; ?>/<?php echo $event['max_hikers']; ?> hikers
                            </small>
                            <?php if ($event['current_hikers'] < $event['max_hikers']): ?>
                                <div class="green-button">
                                    <a href="form1.php?event=<?php echo urlencode($event['event_name']); ?>">Join Now</a>
                                </div>
                            <?php else: ?>
                                <span class="badge bg-secondary">Full</span>
                            <?php endif; ?>
                        </div>
                        <div class="capacity-bar">
                            <div class="capacity-fill" style="width: <?php echo ($event['max_hikers'] > 0) ? min(100, ($event['current_hikers'] / $event['max_hikers']) * 100) : 0; ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="no-events">
            <i class="fas fa-mountain"></i>
            <h3>No Events Available</h3>
            <p>Check back soon for upcoming hiking events!</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Scripts -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/isotope.min.js"></script>
<script src="assets/js/owl-carousel.js"></script>
<script src="assets/js/tabs.js"></script>
<script src="assets/js/swiper.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>
<?php include("footer.php"); ?>
