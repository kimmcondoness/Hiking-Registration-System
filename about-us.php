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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

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
<style>
  *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: sans-serif;
    
  }

  .right content{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
  }


</style>
</head>

<body>
<div class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="header-text">
            <h2>About Us</h2>
            <div class="div-dec"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

 <div class="bgImage">
        <section class="about-us" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="section-heading">
                           
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="right-content">
                          <img src="https://images.unsplash.com/photo-1525474089639-b5fff4440315?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NjR8fGhpa2luZ3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="right-content">
                            <h4>History</h4>
                            <p>In the early 20th century, hiking organizations like the Sierra Club emerged, championing conservation and trail development. They not only promoted hiking as a recreational activity but also recognized its role in preserving natural environments for future generations.

Today, hiking is more popular than ever, attracting millions of enthusiasts worldwide. It offers an escape from the hustle and bustle of modern life, a chance to reconnect with the earth's beauty, and a way to maintain physical fitness. Hiking remains a testament to the enduring bond between humans and nature, reminding us of our responsibility to protect and preserve the wild places we cherish.

In conclusion, the history of hiking is a tale of our enduring connection to nature. From ancient wanderers to modern-day adventurers, hiking has been a means of exploration, spiritual reflection, and environmental stewardship. It continues to inspire countless individuals to embark on journeys of discovery, forging a deeper appreciation for the natural world and our place within it.</p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

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
        progress: function () {
          var swiper = this;
          for (var i = 0; i < swiper.slides.length; i++) {
            var slideProgress = swiper.slides[i].progress;
            var innerOffset = swiper.width * interleaveOffset;
            var innerTranslate = slideProgress * innerOffset;
            swiper.slides[i].querySelector(".slide-inner").style.transform =
              "translate3d(" + innerTranslate + "px, 0, 0)";
          }
        },
        touchStart: function () {
          var swiper = this;
          for (var i = 0; i < swiper.slides.length; i++) {
            swiper.slides[i].style.transition = "";
          }
        },
        setTransition: function (speed) {
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