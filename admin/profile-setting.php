<?php include("connection.php"); 
include("function.php"); 
if(!isset($_SESSION['admin_uniqueid']) && !isset($_SESSION['admin_username']))
{
     header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from live.themewild.com/mytrip/profile-setting.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:46 GMT -->

<head>

<?php include("headerlink.php"); ?>
</head>

<body>

    

    <?php include("header.php"); ?>
    </header>

    <main class="main">

        <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/02.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Settings</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index-2.html">Home</a></li>
                    <li class="active">Settings</li>
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
                                        data-cfemail="80eaefeef3efeec0e5f8e1edf0ece5aee3efed">[email&#160;protected]</a>
                                </p>
                            </div>
                            <ul class="user-profile-sidebar-list">
                                <li><a href="dashboard.html"><i class="far fa-gauge-high"></i> Dashboard</a></li>
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
                                <li><a class="active" href="profile-setting.html"><i class="far fa-cog"></i>
                                        Settings</a></li>
                                <li><a href="#"><i class="far fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="user-profile-wrapper">
                            <div class="col-lg-12 mb-4">
                                <div class="user-profile-card">
                                    <h4 class="user-profile-card-title">Update Profile Info</h4>
                                    <div class="user-profile-form">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" class="form-control" value="Antoni"
                                                            placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" class="form-control" value="Jonson"
                                                            placeholder="Last Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control"
                                                            value="jonson@example.com" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                        <input type="text" class="form-control" value="+2 134 562 458"
                                                            placeholder="Phone">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control" value="New York, USA"
                                                            placeholder="Address">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="theme-btn mt-4">Update Profile Info <i
                                                    class="far fa-user"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="user-profile-card">
                                    <h4 class="user-profile-card-title">Change Password</h4>
                                    <div class="col-lg-12">
                                        <div class="user-profile-form">
                                            <form action="#">
                                                <div class="form-group">
                                                    <label>Old Password</label>
                                                    <input type="password" class="form-control"
                                                        placeholder="Old Password">
                                                </div>
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input type="password" class="form-control"
                                                        placeholder="New Password">
                                                </div>
                                                <div class="form-group">
                                                    <label>Re-Type Password</label>
                                                    <input type="password" class="form-control"
                                                        placeholder="Re-Type Password">
                                                </div>
                                                <button type="button" class="theme-btn mt-4">Change Password <i
                                                        class="far fa-key"></i></button>
                                            </form>
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

<!-- Mirrored from live.themewild.com/mytrip/profile-setting.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:46 GMT -->

</html>