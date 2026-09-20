<?php include("header.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hiking App - New UI</title>

  <!-- Bootstrap -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: #f5f7fa;
      font-family: 'Poppins', sans-serif;
    }

    .hero {
      background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
      url('https://source.unsplash.com/1600x900/?mountain');
      height: 90vh;
      color: white;
      display: flex;
      align-items: center;
      text-align: center;
    }

    .hero h1 {
      font-size: 3rem;
      font-weight: bold;
    }

    .card-custom {
      border: none;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      transition: 0.3s;
    }

    .card-custom:hover {
      transform: translateY(-5px);
    }

    .section-title {
      text-align: center;
      margin-bottom: 40px;
    }
  </style>
</head>

<body>

<section class="hero-modern">
  <div class="hero-overlay"></div>

  <div class="container hero-content">
    <h1 class="hero-title">
      Discover Your Next Adventure
    </h1>

    <p class="hero-subtitle">
      Explore breathtaking trails, join exciting hikes, and connect with nature lovers across Malaysia.
    </p>

    <div class="hero-buttons">
      <a href="event.php" class="btn-primary">Explore Events</a>
      <a href="search.php" class="btn-secondary">Search Trails</a>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section class="container py-5">
  <div class="section-title">
    <h2>Why Choose Us?</h2>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="card card-custom p-4 text-center">
        <h4>🌦 Weather Info</h4>
        <p>Check weather before hiking</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-custom p-4 text-center">
        <h4>⛰ Events</h4>
        <p>Join hiking communities</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-custom p-4 text-center">
        <h4>📍 Locations</h4>
        <p>Discover top hiking places</p>
      </div>
    </div>
  </div>
</section>

<!-- EVENTS (DYNAMIC - SAME BACKEND) -->
<section class="container py-5">
  <div class="section-title">
    <h2>Upcoming Events</h2>
  </div>

  <div class="row">
    <?php
    include("hikingdatabase.php");
    $result = mysqli_query($conn, "SELECT * FROM event WHERE status='Approve' LIMIT 3");

    while($row = mysqli_fetch_assoc($result)){
    ?>
      <div class="col-md-4">
        <div class="card card-custom">
          <img src="<?php echo $row['event_image']; ?>" class="card-img-top">
          <div class="card-body">
            <h5><?php echo $row['event_name']; ?></h5>
            <p><?php echo $row['event_location']; ?></p>
            <a href="event.php" class="btn btn-success">Join</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</section>

<?php include("footer.php"); ?>

</body>
</html>