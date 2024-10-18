<?php include("connection.php"); ?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from live.themewild.com/mytrip/profile-booking-history.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:44 GMT -->

<head>

<?php include("headerlink.php"); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
</head>

<body>

   

    <?php include("header.php"); ?>
    </header>

    <main class="main">

        <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/02.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Booking History</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index-2.html">Home</a></li>
                    <li class="active">Booking History</li>
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
                                        data-cfemail="157f7a7b667a7b55706d74786579703b767a78">[email&#160;protected]</a>
                                </p>
                            </div>
                            <ul class="user-profile-sidebar-list">
                                <li><a href="dashboard.html"><i class="far fa-gauge-high"></i> Dashboard</a></li>
                                <li><a href="profile.html"><i class="far fa-user"></i> My Profile</a></li>
                                <li><a href="profile-booking.html"><i class="far fa-shopping-bag"></i> My Booking</a>
                                </li>
                                <li><a class="active" href="profile-booking-history.html"><i
                                            class="far fa-clipboard-list"></i> Booking History</a></li>
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
                            <div class="user-profile-card">
                                <h4 class="user-profile-card-title">Booking History</h4>
                                <div class="table-responsive">
                                    <!-- <table class="table text-nowrap table-striped"> -->
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
                                                <td><span class="badge badge-danger">Cancel</span></td>
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
                                                <td><span class="badge badge-danger">Cancelled</span></td>
                                                <td>
                                                    <a href="#" class="btn btn-outline-secondary btn-sm"><i
                                                            class="far fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>06.</td>
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
                                                <td>07.</td>
                                                <td><b>#12453</b></td>
                                                <td>Car</td>
                                                <td>Oct 22, 2022</td>
                                                <td>$11,569</td>
                                                <td><span class="badge badge-danger">Cancelled</span></td>
                                                <td>
                                                    <a href="#" class="btn btn-outline-secondary btn-sm"><i
                                                            class="far fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>08.</td>
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
                                        </tbody>
                                    </table>
                                </div>

                                <div class="pagination-area my-3">
                                    <div aria-label="Page navigation example">
                                        <ul class="pagination mt-0">
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true"><i
                                                            class="far fa-angle-double-left"></i></span>
                                                </a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true"><i
                                                            class="far fa-angle-double-right"></i></span>
                                                </a>
                                            </li>
                                        </ul>
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

<script>
  $(document).ready( function () {
		$('.table').DataTable();
  });
  </script>
<!-- Mirrored from live.themewild.com/mytrip/profile-booking-history.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:44 GMT -->

</html>