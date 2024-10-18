<?php include("connection.php");
include("function.php"); 
if(!isset($_SESSION['admin_uniqueid']) && !isset($_SESSION['admin_username']))
{
     header("location:login.php");
}
$uniq = $_SESSION['admin_uniqueid'];

$sel ="SELECT * FROM `admin` WHERE `admin_uniqueid`='$uniq'";
$runquery = mysqli_query($con,$sel);
 $row = mysqli_fetch_array($runquery);


?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from live.themewild.com/mytrip/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:32 GMT -->

<head>

    <?php include("headerlink.php"); ?>
</head>

<body>


    <?php include("header.php"); ?>
    </header>

    <main class="main">

        <!-- <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/02.jpg)">
                <div class="container">
                    <h2 class="breadcrumb-title">My Profile</h2>
                    <ul class="breadcrumb-menu">
                        <li><a href="admin.php">Home</a></li>
                        <li class="active">My Profile</li>
                    </ul>
                </div>
            </div> -->

        <div class="user-profile py-120 mt-5">
            <div class="container">
                <div class="row mt-3">
                    <?php
                     $page ='profile';
                    include("sidebar.php"); ?>
                    <div class="col-lg-9">
                        <div class="user-profile-wrapper">
                            <div class="user-profile-card">
                                <h4 class="user-profile-card-title">Profile Info <a
                                        href="editagent.php?uniqid=<?= $row['admin_uniqueid'] ?>&editpro="
                                        class="theme-btn p-2" style="font-size:15px; float:right;"> <i
                                            class="far fa-pen"> </i>&nbsp; Edit Profile
                                    </a></h4>
                                <div class="col-lg-6">
                                    <div class="profile-info-list">
                                        <ul>
                                            <li>My ID: <span><?= $row['admin_uniqueid'] ?></span></li>
                                            <li>Full Name: <span><?= $row['admin_username'] ?></span></li>
                                            <li>Email: <span><a
                                                        href="mailto:<?= $row['admin_email'] ?>"><?= $row['admin_email'] ?></a></span>
                                            </li>
                                            <li>Phone Number: <span><?= $row['admin_mobile'] ?></span>
                                            </li>
                                            <!-----   <li>Phone: <span>+2 134 562 458</span></li>
                                            <li>Address: <span>New York, USA</span></li>
                                            <li>Join Date: <span>21 August, 2022</span></li>
--->
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

<!-- Mirrored from live.themewild.com/mytrip/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:32 GMT -->

</html>