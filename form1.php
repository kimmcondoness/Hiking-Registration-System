<?php
include("hikingdatabase.php");

// Get available events for dropdown
$sqlEvents = "SELECT event_id, event_name FROM event WHERE status = 'Approve' ORDER BY event_date ASC";
$resultEvents = mysqli_query($conn, $sqlEvents);

// Pre-select event from URL
$selectedEvent = isset($_GET['event']) ? sanitize($_GET['event']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration - Hiking App</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-574-mexant.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f7f6; }
        .reg-section { padding: 40px 0 60px; }
        .reg-card { background: #fff; border-radius: 18px; box-shadow: 0 8px 30px rgba(0,0,0,0.08); overflow: hidden; }
        .reg-image { height: 100%; min-height: 500px; background-size: cover; background-position: center; position: relative; }
        .reg-image::after { content: ''; position: absolute; inset: 0; background: linear-gradient(180deg, rgba(26,92,46,0.3) 0%, rgba(26,92,46,0.7) 100%); }
        .reg-image-text { position: absolute; bottom: 40px; left: 30px; right: 30px; z-index: 2; color: #fff; }
        .reg-image-text h2 { font-weight: 700; font-size: 1.8rem; }
        .reg-image-text p { opacity: 0.9; font-size: 0.95rem; }
        .reg-body { padding: 40px; }
        .reg-body h3 { color: #1a5c2e; font-weight: 700; margin-bottom: 5px; }
        .reg-body .subtitle { color: #888; font-size: 0.9rem; margin-bottom: 25px; }
        .form-label { font-weight: 600; font-size: 0.85rem; color: #444; }
        .form-control, .form-select { border-radius: 10px; padding: 10px 15px; border: 1.5px solid #e0e0e0; }
        .form-control:focus, .form-select:focus { border-color: #2ecc71; box-shadow: 0 0 0 0.2rem rgba(46,204,113,0.15); }
        .btn-register { background: linear-gradient(135deg, #2ecc71, #27ae60); border: none; color: #fff; font-weight: 600; padding: 12px 30px; border-radius: 10px; font-size: 1rem; }
        .btn-register:hover { background: linear-gradient(135deg, #27ae60, #1a5c2e); color: #fff; }
        .btn-back { border: 2px solid #ddd; color: #666; font-weight: 500; padding: 12px 30px; border-radius: 10px; }
        .btn-back:hover { border-color: #2ecc71; color: #2ecc71; }
        .form-check-input:checked { background-color: #2ecc71; border-color: #27ae60; }
        .required-star { color: #e74c3c; }
    </style>
</head>
<body>

<?php include("header.php"); ?>

<div class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="header-text">
                    <h2>Event Registration</h2>
                    <div class="div-dec"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="reg-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="reg-card">
                    <div class="row g-0">
                        <div class="col-xl-5 d-none d-xl-block">
                            <div class="reg-image" style="background-image: url('https://images.pexels.com/photos/2413238/pexels-photo-2413238.jpeg?auto=compress&cs=tinysrgb&w=600');">
                                <div class="reg-image-text">
                                    <h2><i class="fas fa-mountain me-2"></i>Join The Adventure</h2>
                                    <p>Fill in your details to register for an upcoming hiking event. Our team will contact you with further information.</p>
                                    <hr style="border-color: rgba(255,255,255,0.3);">
                                    <p class="mb-1"><i class="fas fa-check-circle me-2"></i>Expert guides provided</p>
                                    <p class="mb-1"><i class="fas fa-check-circle me-2"></i>Safety equipment included</p>
                                    <p class="mb-0"><i class="fas fa-check-circle me-2"></i>Insurance coverage</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7">
                            <div class="reg-body">
                                <h3>Register Now</h3>
                                <p class="subtitle">Fields marked with <span class="required-star">*</span> are required</p>

                                <form action="admin/dashboard-data.php" method="post">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Full Name <span class="required-star">*</span></label>
                                            <input type="text" class="form-control" name="name" placeholder="Your full name" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Email <span class="required-star">*</span></label>
                                            <input type="email" class="form-control" name="email" placeholder="email@example.com" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Phone Number <span class="required-star">*</span></label>
                                            <input type="tel" class="form-control" name="tel_no" placeholder="012-3456789" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Age <span class="required-star">*</span></label>
                                            <input type="number" class="form-control" name="age" min="10" max="80" placeholder="25" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Gender <span class="required-star">*</span></label>
                                            <select class="form-select" name="gender" required>
                                                <option value="" disabled selected>Select</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Hiking Experience</label>
                                            <select class="form-select" name="experience">
                                                <option value="Beginner">Beginner (0-2 hikes)</option>
                                                <option value="Intermediate">Intermediate (3-10 hikes)</option>
                                                <option value="Advanced">Advanced (10+ hikes)</option>
                                                <option value="Expert">Expert / Professional</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Emergency Contact</label>
                                            <input type="tel" class="form-control" name="emergency_contact" placeholder="Emergency phone number">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Select Event <span class="required-star">*</span></label>
                                            <select class="form-select" name="event_option" required>
                                                <option value="" disabled <?php echo empty($selectedEvent) ? 'selected' : ''; ?>>Choose an event</option>
                                                <?php while ($ev = mysqli_fetch_assoc($resultEvents)): ?>
                                                    <option value="<?php echo htmlspecialchars($ev['event_name']); ?>"
                                                        <?php echo ($selectedEvent == $ev['event_name']) ? 'selected' : ''; ?>>
                                                        <?php echo htmlspecialchars($ev['event_name']); ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Medical Notes</label>
                                            <textarea class="form-control" name="medical_notes" rows="2" placeholder="Any allergies, medical conditions, or special requirements..."></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex gap-3">
                                        <button type="submit" class="btn btn-register" name="submit">
                                            <i class="fas fa-paper-plane me-2"></i>Register
                                        </button>
                                        <a href="event.php" class="btn btn-back">
                                            <i class="fas fa-arrow-left me-2"></i>Back to Events
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/isotope.min.js"></script>
<script src="assets/js/owl-carousel.js"></script>
<script src="assets/js/tabs.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>
<?php include("footer.php"); ?>
