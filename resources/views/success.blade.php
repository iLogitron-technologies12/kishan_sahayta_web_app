<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="Landing page template built with HTML and Bootstrap 4 for presenting training courses, classes, workshops and for convincing visitors to register using the form.">
    <meta name="author" content="Inovatik">

    <meta property="og:site_name" content="" />
    <meta property="og:site" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:type" content="article" />

    <title>Palm Oil Portal</title>

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/swiper.css') }}" rel="stylesheet">
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- <link rel="icon" href="{{ asset('images/GoTFavicon2.png') }}"> -->
    <style>
        h1 {
            color: white !important;
        }

        .success-text {
            font: 600 1.125rem/1.75rem "Montserrat", sans-serif;
            font-size: 30px;
            color: white;
        }
    </style>

</head>

<body data-spy="scroll" data-target=".fixed-top">

    <div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>


    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">

        <a class="navbar-brand logo-image" href="/"><img src="{{ asset('images/GoTEmblem.png') }}" alt="alternative"></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-awesome fas fa-bars"></span>
            <span class="navbar-toggler-awesome fas fa-times"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ asset('advisories_pdf/NMEO-OPGUIEDELINES.pdf') }}" download>Operational Guidelines</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ asset('advisories_pdf/Assistance under NMEO-OP.pdf') }}" download>Scheme Assistance </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="/new-application/step1">Apply Now<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="/track-application">Track Application<span class="sr-only"></span></a>
                </li>
                <!--<li class="nav-item">
            <a class="nav-link page-scroll" href="#description">KVIC Website</a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle page-scroll" href="#date" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">OTHERS</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="article-details.html"><span class="item-text">SCHEME DETAILS</span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="terms-conditions.html"><span class="item-text">TERMS CONDITIONS</span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="privacy-policy.html"><span class="item-text">PRIVACY POLICY</span></a>
            </div>
        </li>-->

                <!--  <li class="nav-item">
            <a class="nav-link page-scroll" href="contact.php">Contact Us</a>
        </li> -->
            </ul>
            <!--<span class="nav-item social-icons">
        <span class="fa-stack">
            <a href="#your-link">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fab fa-facebook-f fa-stack-1x"></i>
            </a>
        </span>
        <span class="fa-stack">
            <a href="#your-link">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fab fa-twitter fa-stack-1x"></i>
            </a>
        </span>
    </span>-->
        </div>
    </nav>

    <header id="header" class="header" style="padding-bottom: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                        </br>
                        <h1>Successful!</h1>
                        </br>
                        <h3 class="success-text">You have sucessfully applied!</h3> <br>
                        <h3 class="success-text">Thank you for showing your interest in Oil Palm Cultivation!</h3>
                        <a class="btn-outline-lg page-scroll" href="/track-application">Login & Track Application</a>
                    </div>
                </div>
            </div>
        </div>
        




    </header>
    <div class="slider-1" style="background-color: #ffffff;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider-container">
                        <div class="swiper-container image-slider-2">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <a href="https://nmeo.dac.gov.in/" target="_blank"><img class="img-fluid" src="images/1.png" alt="alternative"></a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="https://horti.tripura.gov.in/" target="_blank"> <img class="img-fluid" src="images/2.png" alt="alternative"></a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="https://agri.tripura.gov.in/" target="_blank"> <img class="img-fluid" src="images/3.png" alt="alternative"></a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="https://midh.gov.in/Schemes.html" target="_blank"> <img class="img-fluid" src="images/4.png" alt="alternative"></a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="https://tripura.gov.in/" target="_blank"> <img class="img-fluid" src="images/6.png" alt="alternative"></a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="footer-col first">
                        <h5>About Oil Plam Cultivation Scheme</h5>
                        <p class="p-small" style=" text-align: justify;">Swavalamban is a Self-employment Generation Programme initiated by the State with the objective to ensure that a sizeable number of unemployed youth and SHGs are developed as potential individual & generate self-employment. A Swavalamban Society has been constituted for effective implementation of the Programme. The SHGs component of the Programme is being implemented through RD Department and the Self-employment Programme.</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="footer-col third">
                        <h5>Links</h5>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><a href="{{ asset('advisories_pdf/NMEO-OPGUIEDELINES.pdf') }}">Scheme Details</a></div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><a href="terms-conditions.php">Terms & Conditions</a></div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><a href="privacy-policy.php">Privacy Policy</a></div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><a href="/login">Login</a></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-col fourth">
                        <h5>Follow Us</h5>
                        <p class="p-small"> </p>
                        <a href="#your-link">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#your-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">© 2023. Developed by <a href="">iLogitron Technologies</a>. All rights reserved</p>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('js/validator.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>



</body>

</html>
