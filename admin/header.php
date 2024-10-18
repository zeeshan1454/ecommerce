<div class="header-top">

            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="header-top-left">
                            <!-- <div class="top-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div> -->
                            <div class="top-contact-info">
                                <!-- <ul>
                                    <li><a href="tel:+21234567897"><i class="far fa-phone-arrow-down-left"></i>+2 123
                                            4567 897</a></li>
                                    <li><a
                                            href="https://live.themewild.com/cdn-cgi/l/email-protection#c9a0a7afa689acb1a8a4b9a5ace7aaa6a4"><i
                                                class="far fa-envelopes"></i><span class="__cf_email__"
                                                data-cfemail="4f262129200f2a372e223f232a612c2022">[email&#160;protected]</span></a>
                                    </li>
                                </ul> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="header-top-right">
                            <!-- <div class="lang">
                                <select name="lang" class="select">
                                    <option value="1">ENG</option>
                                </select>
                            </div> -->
                            <!-- <div class="currency">
                                <select name="currency" class="select">
                                    <option value="1">USD</option>
                                    <option value="2">EUR</option>
                                    <option value="3">AUD</option>
                                    <option value="4">BRL</option>
                                    <option value="5">CAD</option>
                                    <option value="6">MXN</option>
                                </select> 
                            </div>-->
                            <div class="account">
                              <?php
if(isset($_SESSION['admin_uniqueid']))
{ 
    ?>
<a href="logout.php"><i class="far fa-sign-in"></i>Log Out</a>
<?php
} else {
    ?>
   <a href="login.php"><i class="far fa-sign-in"></i>Login</a>
  <?php
}
                              ?>
                                <!-- <a href="register.php"><i class="far fa-user-tie"></i>Sign Up</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-navigation">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="admin.php">
                        <!-- <img src="assets/img/logo/logo.png" class="logo-display" alt="logo">
                        <img src="assets/img/logo/logo-dark.png" class="logo-scrolled" alt="logo"> -->
                    </a>
                    <div class="mobile-menu-right">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-btn-icon"><i class="far fa-bars"></i></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="main_nav">
                        <ul class="navbar-nav">
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="booking-history.php">My booking</a>
                               
                            </li> -->
                            <!-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown">Home</a>
                                <ul class="dropdown-menu fade-down">
                                    <li><a class="dropdown-item" href="index.php">Home One</a></li>  
                                    <li><a class="dropdown-item" href="index-5.php">Home Flight</a></li>
                                   
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu mega-menu fade-down">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <ul>
                                                <li><a class="dropdown-item" href="become-expert.php">Become An
                                                        Expert</a></li>
                                                <li><a class="dropdown-item" href="booking-confirm.php">Booking
                                                        Confirm</a></li>
                                                <li><a class="dropdown-item" href="login.php">Login</a></li>
                                                <li><a class="dropdown-item" href="register.php">Sign Up</a></li>
                                                <li><a class="dropdown-item" href="faq.php">Faq's</a></li>
                                               
                                                <li><a class="dropdown-item" href="404.php">404 Error</a></li>
                                                <li><a class="dropdown-item" href="coming-soon.php">Coming Soon</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-4">
                                            <ul>
                                                <li><a class="dropdown-item" href="forgot-password.php">Forgot
                                                        Password</a></li>
                                                <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
                                                <li><a class="dropdown-item" href="profile.php">My Profile</a>
                                                <li><a class="dropdown-item" href="profile-booking.php">My Booking</a>
                                                </li>
                                                <li><a class="dropdown-item" href="profile-booking-history.php">My
                                                        Booking History</a></li>
                                                        <li><a class="dropdown-item" href="privacy.php">Privacy Policy</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-4">
                                            <ul>
                                               <a class="dropdown-item" href="profile-setting.php">Settings</a>
                                                </li>
                                                <li><a class="dropdown-item" href="about.php">About Us</a></li>
                                                <li><a class="dropdown-item" href="pricing.php">Pricing Plan</a></li>
                                                <li><a class="dropdown-item" href="service.php">Services</a></li>
                                                <li><a class="dropdown-item" href="service-single.php">Service
                                                        Single</a></li>
                                                <li><a class="dropdown-item" href="gallery.php">Gallery</a></li>
                                                <li><a class="dropdown-item" href="contact.php">Contact Us</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Flight</a>
                                <ul class="dropdown-menu fade-down">
                                    <li><a class="dropdown-item" href="flight-grid.php">Flight Grid</a></li>
                                    <li><a class="dropdown-item" href="flight-list.php">Flight List</a></li>
                                    <li><a class="dropdown-item" href="flight-full-width.php">Flight Full Width</a>
                                    </li>
                                    <li><a class="dropdown-item" href="flight-single.php">Flight Details</a></li>
                                    <li><a class="dropdown-item" href="flight-booking.php">Flight Booking</a></li>
                                    <li><a class="dropdown-item" href="flight-add.php">Add Flight</a></li>
                                </ul>
                            </li> -->
                        
                            <!-- <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li> -->
                        </ul>
                        <!-- <div class="header-nav-right">
                            <div class="header-btn"> -->
                                <!-- <a href="become-expert.php" class="theme-btn mt-2">Become An Expert</a> -->
                                <!-- <a href="contact.php" class="theme-btn mt-2">contact Us</a> -->
                                <!-- <a href="admin.php" class="theme-btn mt-2">My Acount</a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </nav>
        </div>

    <div class="preloader">
        <div class="loader">
            <span style="--i:1;"></span>
            <span style="--i:2;"></span>
            <span style="--i:3;"></span>
            <span style="--i:4;"></span>
            <span style="--i:5;"></span>
            <span style="--i:6;"></span>
            <span style="--i:7;"></span>
            <span style="--i:8;"></span>
            <span style="--i:9;"></span>
            <span style="--i:10;"></span>
            <span style="--i:11;"></span>
            <span style="--i:12;"></span>
            <span style="--i:13;"></span>
            <span style="--i:14;"></span>
            <span style="--i:15;"></span>
            <span style="--i:16;"></span>
            <span style="--i:17;"></span>
            <span style="--i:18;"></span>
            <span style="--i:19;"></span>
            <span style="--i:20;"></span>
            <div class=""></div>
        </div>
    </div>


    <header class="header">