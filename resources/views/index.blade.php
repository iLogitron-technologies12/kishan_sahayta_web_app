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

    <title>Oil Palm Cultivation</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,600,700,700i&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/swiper.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="icon" href="{{ asset('images/GoTFavicon2.png') }}">

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

    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">


                        <h1 id="header_title">Oil Palm Cultivation in Tripura</h1>
                        <p class="p-small" style="font-size:24px; font-weight:500;color:black;">Under</p>
                        <p class="p-large" style="font-size:24px; font-weight:500; background:#ffbd50;padding:10px 20px;opacity:0.7;font-weight:bold;color:black;border-radius:20px;">National Mission on Edible Oils-Oil Palm (NMEO-OP)</p>
                        <p class="p-small" style="font-size:24px; font-weight:bold;color:white;">Directorate of Horticulture and Soil Conservation, Govt. of Tripura</p>
                        <a class="btn-outline-lg page-scroll" href="/new-application/step1">New Application</a>
                        <a class="btn-solid-lg page-scroll" href="/track-application">Track Application</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="outer-container">
            <div class="slider-container">
                <div class="swiper-container image-slider-1">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <img class="img-fluid" src="images/Palm1.png" alt="alternative">
                        </div>


                        <div class="swiper-slide">
                            <img class="img-fluid" src="images/Palm2.png" alt="alternative">
                        </div>

                        <div class="swiper-slide">
                            <img class="img-fluid" src="images/palm3.png" alt="alternative">
                        </div>
                        <div class="swiper-slide">
                            <img class="img-fluid" src="images/palm4.png" alt="alternative">
                        </div>



                    </div>


                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>

                </div>
            </div>
        </div>


    </header>



    <div id="register" class="form-1">
        <div class="container">
            <div class="row">
                <!--  <div class="col-lg-6">
                    <div class="text-container">
                        <h2>Apply Now!</h2>
                        <p>It's easy to register the KVIC Scheme, just fill out the form and click on the submit button . Then your application will be scrutinized by officials and notify you once it is Approved!</p>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><strong>Your information</strong> is required to complete the registration</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><strong>It's safe with us</strong> and will not be used for marketing</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><strong>You will receive</strong> a confirmation email within 7 working days</div>
                            </li>
                        </ul>
                    </div>  --><!-- end of text-container -->
            </div> <!-- end of col -->
            <div class="col-lg-6">

                <!-- Registration Form -->
                <!--   <div class="form-container">
                        <form id="registrationForm" data-toggle="validator" data-focus="false">
                            <div class="form-group">
                                <input type="text" class="form-control-input" id="rname" name="rname" required>
                                <label class="label-control" for="rname">Name</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control-input" id="remail" name="remail" required>
                                <label class="label-control" for="remail">Email address</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control-input" id="rphone" name="rphone" required>
                                <label class="label-control" for="rphone">Phone number</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group checkbox">
                                <input type="checkbox" id="rterms" value="Agreed-to-Terms" name="rterms" required>I've read and agree to Samabalamban's <a href="privacy-policy.html">Privacy Policy</a> and <a href="terms-conditions.html">Terms & Conditions</a>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control-submit-button">REGISTER</button>
                            </div>
                            <div class="form-message">
                                <div id="rmsgSubmit" class="h3 text-center hidden"></div>
                            </div>
                        </form>
                    </div>  -->
                <!-- end of form-container -->
                <!-- end of registration form -->

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
    </div> <!-- end of form-1 -->
    <!-- end of registration -->


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
                        <h5>About Oil Palm Cultivation Scheme</h5>
                        <p class="p-small" style=" text-align: justify;">Step into the world of oil palm cultivation with the ease of online applications, backed by government support. Unleash your potential in self-employment and agricultural excellence through our user-friendly platform. The journey of palm oil, essential in both culinary delights and industrial products, involves careful processing and refinement. Guided by a commitment to sustainability, our efforts address environmental concerns, promoting responsible practices.</p>
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
