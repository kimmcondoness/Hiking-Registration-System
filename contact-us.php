<?php
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">

  <head>

  

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">

    <title>HIKING APP</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-574-mexant.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <link rel="stylesheet" href="style.css">
<!--

TemplateMo 574 Mexant

https://templatemo.com/tm-574-mexant

-->
  </head>

<body>
 

<div class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="header-text">
            <h2>Contact Us</h2>
            <div class="div-dec"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
<section class = "contact-section">


      <div class = "contact-body">
        <div class = "contact-info">
          <div>
            <span><i class = "fas fa-mobile-alt" style = "color: green ;"></i></span>
            <span>Phone No.</span>
            <span class = "text">03-89891231</span>
          </div>
          <div>
            <span><i class = "fas fa-envelope-open" style = "color: green ;"></i></span>
            <span>E-mail</span>
            <span class = "text">hiking@gmail.com</span>
          </div>
          <div>
            <span><i class = "fas fa-map-marker-alt" style = "color: green ;"></i></span>
            <span>Address</span>
            <span class = "text">15 Jalan Rungkup Taman Kok Lian 51200 Jalan Ipoh Kuala Lumpur, Jalan, Jalan Ipoh, 51200 Ipoh</span>
          </div>
          <div>
            <span><i class = "fas fa-clock" style = "color: green ;"></i></span>
            <span>Opening Hours</span>
            <span class = "text">Monday - Friday (9:00 AM to 5:00 PM)</span>
          </div>
        </div>

  <section class="calculator">
    <div class="container">
      <div class="row">
    
        <div class="col-lg-5">
          <div class="section-heading">
            <h6>Your Feedback !!!!</h6>
            <h4>Really matter to us !!!</h4>
          </div>
          <form id="calculate" action="contact-process.php" method="post">
            <div class="row">
              <div class="col-lg-6">
                <fieldset>
                  <label for="name">Your Name</label>
                  <input type="name" name="name" id="name" placeholder="" autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <label for="email">Your Email</label>
                  <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="" required="">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="subject">Tel No</label>
                  <input type="subject" name="tel_no" id="subject" placeholder="" autocomplete="on" >
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="chooseOption" class="form-label">Your Reason</label>
                  <select name="msg_type" class="form-select" aria-label="Default select example" id="chooseOption" onchange="this.form.click()">
                      <option selected>Choose an Option</option>
                      <option value="Feedback">Feedback</option>
                      <option value="Report">Report</option>
                  </select>
              </fieldset>
              <div class="col-lg-12">
                <fieldset>
                  <label for="subject">Message</label>
                  <input type="subject" name="message" id="subject" placeholder="" autocomplete="on" >
                </fieldset>
              </div>
              </div>
              <div class="green-button" >
                      <button type="submit" class="btn btn-success" name = "contact">Submit</button>
                  </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
      </div>

      <div class = "map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127487.0078776355!2d101.57781088060126!3d3.1028943472511332!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc473f1a93a73f%3A0x2a1c08ffb33115f5!2sTaman%20Negara%20Day%20Tour!5e0!3m2!1sen!2smy!4v1694677134718!5m2!1sen!2smy" width="2000" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
      </div>


    </section>



  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>

    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/swiper.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        var interleaveOffset = 0.5;

      var swiperOptions = {
        loop: true,
        speed: 1000,
        grabCursor: true,
        watchSlidesProgress: true,
        mousewheelControl: true,
        keyboardControl: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev"
        },
        on: {
          progress: function() {
            var swiper = this;
            for (var i = 0; i < swiper.slides.length; i++) {
              var slideProgress = swiper.slides[i].progress;
              var innerOffset = swiper.width * interleaveOffset;
              var innerTranslate = slideProgress * innerOffset;
              swiper.slides[i].querySelector(".slide-inner").style.transform =
                "translate3d(" + innerTranslate + "px, 0, 0)";
            }      
          },
          touchStart: function() {
            var swiper = this;
            for (var i = 0; i < swiper.slides.length; i++) {
              swiper.slides[i].style.transition = "";
            }
          },
          setTransition: function(speed) {
            var swiper = this;
            for (var i = 0; i < swiper.slides.length; i++) {
              swiper.slides[i].style.transition = speed + "ms";
              swiper.slides[i].querySelector(".slide-inner").style.transition =
                speed + "ms";
            }
          }
        }
      };

      var swiper = new Swiper(".swiper-container", swiperOptions);
    </script>
  </body>
</html>
<?php
include("footer.php");
?>