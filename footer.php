<!-- FONT AWESOME (REQUIRED FOR ICONS) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="contact-footer fade-in" style="background: linear-gradient(135deg, #0f172a, #1e3a8a); padding: 50px 0 20px; position: relative; overflow: hidden;">

    <!-- BACKGROUND GLOW EFFECT -->
    <div style="position:absolute; top:-60px; right:-60px; width:220px; height:220px; background:#3b82f6; opacity:0.15; border-radius:50%; filter: blur(90px);"></div>

    <div class="container">
        <div class="row">

            <!-- ORIGINAL CONTENT (UNCHANGED TEXT) -->
            <div class="col-md-3 mb-4">
                <h5 style="color: #3b82f6; font-weight: 700;">Hiking App</h5>
                <p style="color: #aaa; font-size: 0.9rem;">
                    Your gateway to Malaysia's most beautiful hiking trails. Join our community and explore nature.
                </p>
            </div>

            <!-- QUICK LINKS -->
            <div class="col-md-3 mb-4">
                <h5 style="color: #3b82f6; font-weight: 700;">Quick Links</h5>
                <div class="footer-links">
                    <a href="index.php">Home</a>
                    <a href="about-us.php">About Us</a>
                    <a href="event.php">Events</a>
                    <a href="contact-us.php">Contact Us</a>
                </div>
            </div>

            <!-- NEW FEATURES SECTION -->
            <div class="col-md-3 mb-4">
                <h5 style="color: #3b82f6; font-weight: 700;">Features</h5>
                <ul style="color:#aaa; font-size:0.9rem; padding-left:15px;">
                    <li> Real-time Weather</li>
                    <li> Hiking Locations</li>
                    <li> Event Booking</li>
                    <li> Guided Trails</li>
                </ul>
            </div>

            <!-- SOCIAL MEDIA (FULL FIXED VERSION) -->
            <div class="col-md-3 mb-4">
                <h5 style="color: #3b82f6; font-weight: 700;">Follow Us</h5>

                <div class="social-links-modern">
                    <a href="#" class="social-btn facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-btn twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-btn instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-btn youtube"><i class="fab fa-youtube"></i></a>
                </div>

                <!-- NEWSLETTER -->
                <div style="margin-top:15px;">
                    <input type="email" placeholder="Subscribe email"
                        style="padding:8px 12px; border-radius:20px; border:none; width:65%;">
                    <button style="padding:8px 12px; border:none; border-radius:20px; background:#3b82f6; color:white;">
                        ➤
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ORIGINAL FOOTER (UNCHANGED) -->
<footer style="background: #0d1117; padding: 15px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p style="color: #666; margin: 0; font-size: 0.85rem;">
                    Copyright &copy; <?php echo date('Y'); ?> Hiking App. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- ANIMATION SCRIPT -->
<script>
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if(entry.isIntersecting){
      entry.target.classList.add("show");
    }
  });
});

document.querySelectorAll(".fade-in").forEach(el => {
  observer.observe(el);
});
</script>