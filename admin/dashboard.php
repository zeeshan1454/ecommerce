<?php include("connection.php"); 
include("function.php"); 
if(!isset($_SESSION['admin_uniqueid']) && !isset($_SESSION['admin_username']))
{
     header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from live.themewild.com/mytrip/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:28 GMT -->

<head>
    <?php include("headerlink.php"); ?>
</head>

<body>

  
    <?php include("header.php"); ?>
    </header>

    <main class="main">

        <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/02.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Dashboard</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index-2.html">Home</a></li>
                    <li class="active">Dashboard</li>
                </ul>
            </div>
        </div>

        <div class="user-profile py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="user-profile-sidebar">
                            <div class="user-profile-sidebar-top">
                                <div class="user-profile-img">
                                    <img src="assets/img/account/user.jpg" alt>
                                    <button type="button" class="profile-img-btn"><i class="far fa-camera"></i></button>
                                    <input type="file" class="profile-img-file">
                                </div>
                                <h4>Antoni Jonson</h4>
                                <p><a href="https://live.themewild.com/cdn-cgi/l/email-protection" class="__cf_email__"
                                        data-cfemail="a0cacfced3cfcee0c5d8c1cdd0ccc58ec3cfcd">[email&#160;protected]</a>
                                </p>
                            </div>
                            <ul class="user-profile-sidebar-list">
                                <li><a class="active" href="dashboard.html"><i class="far fa-gauge-high"></i>
                                        Dashboard</a></li>
                                <li><a href="profile.html"><i class="far fa-user"></i> My Profile</a></li>
                                <li><a href="profile-booking.html"><i class="far fa-shopping-bag"></i> My Booking</a>
                                </li>
                                <li><a href="profile-booking-history.html"><i class="far fa-clipboard-list"></i> Booking
                                        History</a></li>
                                <li><a href="profile-listing.html"><i class="far fa-globe"></i> My Listing</a></li>
                                <li class="profile-menu">
                                    <a href="#profile-menu" data-bs-toggle="collapse" aria-expanded="false"
                                        aria-controls="profile-menu">
                                        <i class="far fa-plus-circle"></i> Add Listing <i
                                            class="far fa-angle-down profile-menu-angle"></i>
                                    </a>
                                    <div class="collapse" id="profile-menu">
                                        <ul class="profile-menu-list">
                                            <li><a href="flight-add.html">Add Flight</a></li>
                                            <li><a href="hotel-add.html">Add Hotel</a></li>
                                            <li><a href="hotel-room-add.html">Add Hotel Room</a></li>
                                            <li><a href="activity-add.html">Add Activity</a></li>
                                            <li><a href="car-add.html">Add Car</a></li>
                                            <li><a href="cruise-add.html">Add Cruise</a></li>
                                            <li><a href="tour-add.html">Add Tour</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="profile-wishlist.html"><i class="far fa-heart"></i> My Wishlist</a></li>
                                <li><a href="profile-message.html"><i class="far fa-envelope"></i> Messages <span
                                            class="badge">02</span></a></li>
                                <li><a href="profile-wallet.html"><i class="far fa-wallet"></i> My Wallet</a></li>
                                <li><a href="profile-notification.html"><i class="far fa-bell"></i> Notifications <span
                                            class="badge">05</span></a></li>
                                <li><a href="profile-setting.html"><i class="far fa-cog"></i> Settings</a></li>
                                <li><a href="#"><i class="far fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="user-profile-wrapper">
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="dashboard-widget dashboard-widget-color-1">
                                        <div class="dashboard-widget-info">
                                            <h1>120</h1>
                                            <span>Total Booking</span>
                                        </div>
                                        <div class="dashboard-widget-icon">
                                            <i class="fal fa-shopping-bag"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="dashboard-widget dashboard-widget-color-2">
                                        <div class="dashboard-widget-info">
                                            <h1>26</h1>
                                            <span>Pending Booking</span>
                                        </div>
                                        <div class="dashboard-widget-icon">
                                            <i class="fal fa-loader"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="dashboard-widget dashboard-widget-color-3">
                                        <div class="dashboard-widget-info">
                                            <h1>$60,050</h1>
                                            <span>You Earned</span>
                                        </div>
                                        <div class="dashboard-widget-icon">
                                            <i class="fal fa-sack-dollar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="user-profile-card">
                                        <h4 class="user-profile-card-title">Sales Chart</h4>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div id="chart"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="user-profile-card">
                                        <h4 class="user-profile-card-title">Notifications</h4>
                                        <div class="user-notification">
                                            <div class="user-notification-item">
                                                <a href="#">
                                                    <div class="user-notification-icon">
                                                        <i class="far fa-home"></i>
                                                    </div>
                                                    <div class="user-notification-info">
                                                        <p>Your Booking <b>#123456</b> Roltak Hotel Is Confirmed!</p>
                                                        <span>just now</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="user-notification-item">
                                                <a href="#">
                                                    <div class="user-notification-icon">
                                                        <i class="far fa-envelope"></i>
                                                    </div>
                                                    <div class="user-notification-info">
                                                        <p>Your Booking <b>#123456</b> Roltak Hotel Is Confirmed!</p>
                                                        <span>15 min ago</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="user-notification-item">
                                                <a href="#">
                                                    <div class="user-notification-icon">
                                                        <i class="far fa-heart"></i>
                                                    </div>
                                                    <div class="user-notification-info">
                                                        <p>Your Booking <b>#123456</b> Roltak Hotel Is Confirmed!</p>
                                                        <span>15 days ago</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="user-notification-item">
                                                <a href="#">
                                                    <div class="user-notification-icon">
                                                        <i class="far fa-comment"></i>
                                                    </div>
                                                    <div class="user-notification-info">
                                                        <p>Your Booking <b>#123456</b> Roltak Hotel Is Confirmed!</p>
                                                        <span>2 months ago</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="user-profile-card profile-booking">
                                        <h4 class="user-profile-card-title">Recent Booking</h4>
                                        <div class="table-responsive">
                                            <table class="table text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Booking ID</th>
                                                        <th>Type</th>
                                                        <th>Date</th>
                                                        <th>Price</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>01.</td>
                                                        <td><b>#12453</b></td>
                                                        <td>Hotel</td>
                                                        <td>Oct 22, 2022</td>
                                                        <td>$11,569</td>
                                                        <td><span class="badge badge-success">Confirmed</span></td>
                                                        <td>
                                                            <a href="#" class="btn btn-outline-secondary btn-sm"><i
                                                                    class="far fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>02.</td>
                                                        <td><b>#12453</b></td>
                                                        <td>Flight</td>
                                                        <td>Oct 22, 2022</td>
                                                        <td>$11,569</td>
                                                        <td><span class="badge badge-success">Confirmed</span></td>
                                                        <td>
                                                            <a href="#" class="btn btn-outline-secondary btn-sm"><i
                                                                    class="far fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>03.</td>
                                                        <td><b>#12453</b></td>
                                                        <td>Activity</td>
                                                        <td>Oct 22, 2022</td>
                                                        <td>$11,569</td>
                                                        <td><span class="badge badge-warning">Pending</span></td>
                                                        <td>
                                                            <a href="#" class="btn btn-outline-secondary btn-sm"><i
                                                                    class="far fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>04.</td>
                                                        <td><b>#12453</b></td>
                                                        <td>Car</td>
                                                        <td>Oct 22, 2022</td>
                                                        <td>$11,569</td>
                                                        <td><span class="badge badge-success">Confirmed</span></td>
                                                        <td>
                                                            <a href="#" class="btn btn-outline-secondary btn-sm"><i
                                                                    class="far fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>05.</td>
                                                        <td><b>#12453</b></td>
                                                        <td>Cruise</td>
                                                        <td>Oct 22, 2022</td>
                                                        <td>$11,569</td>
                                                        <td><span class="badge badge-danger">Cancel</span></td>
                                                        <td>
                                                            <a href="#" class="btn btn-outline-secondary btn-sm"><i
                                                                    class="far fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <footer class="footer-area">
    <?php include("footer.php"); ?>
    </footer>

    <?php include("footerlink.php"); ?>
</body>

<!-- Mirrored from live.themewild.com/mytrip/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:32 GMT -->

</html>