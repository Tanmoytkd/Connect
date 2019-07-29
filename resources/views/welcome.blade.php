<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Connect') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!--Icon-->
    {{--<link href="img/favicon.png" rel="icon">--}}

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>


<header id="header">
    <div class="container-fluid">

        <div id="logo" class="pull-left">
            <h1>
                <a href="/" class="scrollto">C<img src="images/connect-logo-2.png" style="height: 1em; ">nnect</a>
            </h1>
        </div>

        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <li class="menu-active"><a href="#intro">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#services">Services</a></li>
                @guest
                    <li><a href="{{route('login')}}">Sign In</a></li>
                @else
                    <li><a href="{{route('home')}}">Home</a></li>
                @endGuest
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav><!-- #nav-menu-container -->
    </div>
</header><!-- #header -->


<section id="intro">
    <div class="intro-container">
        <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

            <ol class="carousel-indicators"></ol>

            <div class="carousel-inner" role="listbox">

                <div class="carousel-item active" style="background-image: url('images/intro-carousel/1.jpg');">
                    <div class="carousel-container">
                        <div class="carousel-content">
                            <h2>Start building your new ideas</h2>
                            <p> We provide you with the perfect collaboration platform to lessen your workload and get creative. <br> <b>Photo by ROOM on Unsplash </b></p>
                            @guest
                                <a href="{{route('register')}}" class="btn-get-started scrollto">Get Started</a>
                            @else
                                <a href="{{route('home')}}" class="btn-get-started scrollto">Get Started</a>
                            @endguest
                        </div>
                    </div>
                </div>

                <div class="carousel-item" style="background-image: url('images/intro-carousel/2.jpg');">
                    <div class="carousel-container">
                        <div class="carousel-content">
                            <h2>No worries about initial investment</h2>
                            <p>We provide you with the perfect collaboration platform to lessen your workload and get creative. <br> <b>Photo by Headway on Unsplash</b></p>
                            <a href="{{route('register')}}" class="btn-get-started scrollto">Get Started</a>
                        </div>
                    </div>
                </div>

                <div class="carousel-item" style="background-image: url('images/intro-carousel/3.jpg');">
                    <div class="carousel-container">
                        <div class="carousel-content">
                            <h2>Show your skills</h2>
                            <p>We provide you with the perfect collaboration platform to lessen your workload and get creative. <br> <b>Photo by STIL on Unsplash</b></p>
                            <a href="{{route('register')}}" class="btn-get-started scrollto">Get Started</a>
                        </div>
                    </div>
                </div>

                <div class="carousel-item" style="background-image: url('images/intro-carousel/4.jpg');">
                    <div class="carousel-container">
                        <div class="carousel-content">
                            <h2>Share risk and profit</h2>
                            <p>We provide you with the perfect collaboration platform to lessen your workload and get creative. <br> <b>Photo by Annie Spratt on Unsplash</b></p>
                            <a href="{{route('register')}}" class="btn-get-started scrollto">Get Started</a>
                        </div>
                    </div>
                </div>

                <div class="carousel-item" style="background-image: url('images/intro-carousel/5.jpg');">
                    <div class="carousel-container">
                        <div class="carousel-content">
                            <h2>Add awesome projects to your personal portfolio</h2>
                            <p>We provide you with the perfect collaboration platform to lessen your workload and get creative. <br> <b>Photo by Dylan Gillis on Unsplash</b></p>
                            <a href="{{route('register')}}" class="btn-get-started scrollto">Get Started</a>
                        </div>
                    </div>
                </div>

            </div>

            <a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>
    </div>
</section>

<main id="main">


    <section id="featured-services">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 box">
                    <i class="ion-android-create"></i>
                    <h4 class="title"><a href="">Create</a></h4>
                    <p class="description">We provide you with the perfect collaboration platform to lessen your workload and get creative.</p>
                </div>

                <div class="col-lg-4 box box-bg">
                    <i class="ion-android-bulb"></i>
                    <h4 class="title"><a href="">Innovate</a></h4>
                    <p class="description">We provide you with the perfect collaboration platform to lessen your workload and get creative.</p>
                </div>

                <div class="col-lg-4 box">
                    <i class="ion-ios-infinite"></i>
                    <h4 class="title"><a href="">Collaborate</a></h4>
                    <p class="description">We provide you with the perfect collaboration platform to lessen your workload and get creative.</p>
                </div>

            </div>
        </div>
    </section><!-- #featured-services -->
</main>

<!--==========================
  Footer
============================-->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-info">
                    <h3>Connect</h3>
                    <p>We provide you with the perfect collaboration platform to lessen your workload and get creative.</p>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="ion-ios-arrow-right"></i> <a href="#">Home</a></li>
                        <li><i class="ion-ios-arrow-right"></i> <a href="#">About us</a></li>
                        <li><i class="ion-ios-arrow-right"></i> <a href="#">Services</a></li>
                        <li><i class="ion-ios-arrow-right"></i> <a href="#">Terms of service</a></li>
                        <li><i class="ion-ios-arrow-right"></i> <a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h4>Contact Us</h4>
                    <p>
                        Shakir Hossain <br>
                        <strong>Phone:</strong> +1-111-111-1111<br>
                        <strong>Email:</strong> <a href="mailto:akshossain2060@gmail.com">akshossain2060@gmail.com</a> <br>
                    </p>

                    <div class="social-links">
                        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                        <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                    </div>

                </div>

                <div class="col-lg-3 col-md-6 footer-newsletter">
                    <h4>Our Newsletter</h4>
                    <p>We provide you with the perfect collaboration platform to lessen your workload and get creative.</p>
                    <form action="" method="post">
                        <input type="email" name="email"><input type="submit"  value="Subscribe">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!--<div class="container">
      <div class="copyright">
        &copy; Copyright <strong>BizPage</strong>. All Rights Reserved
      </div>
      <div class="credits">

          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=BizPage

     Best <a href="https://bootstrapmade.com/">Bootstrap Templates</a> by BootstrapMade
   </div>
 </div>
</footer> -->
<!-- #footer -->

    <!--<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>-->

    <!-- JavaScript Libraries -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/superfish/hoverIntent.js"></script>
    <script src="lib/superfish/superfish.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/touchSwipe/jquery.touchSwipe.min.js"></script>
    <!-- Contact Form JavaScript File -->
    <script src="contactform/contactform.js"></script>

    <!-- Template Main Javascript File -->
    <script src="js/main.js"></script>

</body>
