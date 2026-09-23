<!doctype html>
<html lang="zxx">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- bootstrap css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Ico Font CSS -->
    <link href="{{ asset('assets/css/icofont.min.css') }}" rel="stylesheet">

    <!-- Mean Menu CSS -->
    <link href="{{ asset('assets/css/meanmenu.css') }}" rel="stylesheet">

    <!-- Animate CSS -->
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet">

    <!-- Odometer CSS -->
    <link href="{{ asset('assets/css/odometer.min.css') }}" rel="stylesheet">

    <!-- Owl Carousel CSS -->
    <link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.theme.default.min.css') }}" rel="stylesheet">

    <!-- Modal Video CSS -->
    <link href="{{ asset('assets/css/modal-video.min.css') }}" rel="stylesheet">

    <!-- Nice Select CSS -->
    <link href="{{ asset('assets/css/nice-select.min.css') }}" rel="stylesheet">

    <!-- Style CSS -->
    <link href="{{ asset('assets/css/style.css?v.1') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ asset('assets/css/main.css?v.1') }}" rel="stylesheet">

    <!-- Register CSS -->
    <link href="{{ asset('assets/css/register.css?v.1') }}" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="{{ asset('assets/css/responsive.css?v.1') }}" rel="stylesheet">

    <!-- Theme Dark CSS -->
    <link href="{{ asset('assets/css/theme-dark.css') }}" rel="stylesheet">

    <!-- Title -->
    <title>Tamilaga Podhu Makkal Iyakkam</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/images/logo/PMI_logo.png" />
</head>

<body>
    <!-- Header -->
    <div class="header-area two">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-7">
                    <div class="left">
                        <span>Watch:</span>
                        <a href="#">
                            Tamilaga Podhu Makkal Iyakkam
                            <i class="icofont-long-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="right">
                        <ul class="social-icon">
                            <li>
                                <a href="https://www.facebook.com/login/" target="_blank">
                                    <i class="icofont-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/i/flow/login" target="_blank">
                                    <i class="icofont-twitter"></i>
                                </a>
                            </li>


                        </ul>



                        <div class="nav-flag-dropdown">
                            <a href="{{ route('language.change', 'en') }}"
                                class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">
                                English
                            </a>
                            <a href="{{ route('language.change', 'ta') }}"
                                class="{{ app()->getLocale() == 'ta' ? 'active' : '' }}">
                                தமிழ்
                            </a>


                        </div>


                    </div>
                </div>

                <div class="col-lg-2 adminlink pt-10">
                    <div class="left">


                           <a class="adminbtn" href="{{route('admin.index')}}"> Admin Portal</a>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header -->

    <!-- Navbar -->
    <div class="navbar-area sticky-top">
        <!-- Menu For Mobile Device -->
        <div class="mobile-nav">
            <a href="index.html" class="logo">
                <img src="assets/images/logo/PMI_logo.png" alt="Logo" />
            </a>
        </div>

        <!-- Menu For Desktop Device -->
        <div class="main-nav two">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="index.html">
                        <img src="assets/images/logo/pmilogo.png" alt="Logo" /> <span>
                            Tamilaga Podhu Makkal Iyakkam
                        </span>
                    </a>
                    <div
                        class="collapse navbar-collapse mean-menu"
                        id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="{{route('index')}}" class="nav-link active">Home </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('about_us')}}" class="nav-link">About Party</a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link dropdown-toggle">Blog </a>
                            </li>
                            <li class="nav-item">
                                <a href="#footer" class="nav-link">Contact</a>
                            </li>
                        </ul>

                        <div class="side-nav">
                            <a class="right common-btn two" href="{{route('member-register')}}">Join With Us</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Navbar -->
