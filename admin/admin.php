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

<!-- Mirrored from live.themewild.com/mytrip/profile-booking-history.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:44 GMT -->

<head>

<?php include("headerlink.php"); ?>
</head>

<body>

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
            <div class="loader-plane"></div>
        </div>
    </div>


    <header class="header">

    
    </header>

    <main class="main mt-3">

        <!-- <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/02.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title"><?php  if($row['admin_status'] == '1'){
                                    echo "All Product";
                                   } else {
                                    echo "My Product";
                                   }
                                ?></h2>
                <ul class="breadcrumb-menu">
                    <li><a href="admin.php">Home</a></li>
                    <li class="active"><?php  if($row['admin_status'] == '1'){
                                    echo "All Product";
                                   } else {
                                    echo "My Product";
                                   }
                                ?></li>
                </ul>
            </div>
        </div> -->

        <div class="user-profile ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="user-profile-sidebar">
                            <div class="user-profile-sidebar-top">
                                <div class="user-profile-img">
                                    <img src="assets/img/account/profile.jpg" alt>
                                   <!------------- <button type="button" class="profile-img-btn"><i class="far fa-camera"></i></button>
                                    <input type="file" class="profile-img-file"> ---->
                                </div>
                                <h4><?= $row['admin_username'] ?></h4>
                                <p><a href="mailto:<?= $row['admin_email'] ?>"><?= $row['admin_email'] ?></a>
                                </p>
                            </div>
                            <ul class="user-profile-sidebar-list">
                                                                <li><a href="profile.php"><i class="far fa-user"></i>My Profile</a></li>
                                <li><a href="admin.php" class="active"><i class="far fa-clipboard-list"></i><?php
                                  if($row['admin_status'] == '1'){
                                    echo "All Product";
                                   } else {
                                    echo "My Product";
                                   }
                                ?></a>
                                </li>
                                <?php
                                  if($row['admin_status'] == '1'){
                                    ?>
                                     <li><a href="agent.php"><i class="far fa-user"></i>All Agents</a></li>
                                    <?php
                                   } else {
                                    echo "";
                                   }
                                ?>
                                <li><a href="user.php"><i class="far fa-user"></i><?php if($row['admin_status'] == '1'){
                                                echo "All Users";
                                               } else {
                                              echo "My Users";
                                               } ?></a></li>
                                <li><a href="logout.php"><i class="far fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="user-profile-wrapper">

                        
                        <div class="row">
                        
                                <div class="col-md-6 col-lg-6">
                                    <div class="dashboard-widget dashboard-widget-color-3">
                                        <div class="dashboard-widget-info">
                                            <?php
                                               $agentid = $row['admin_username'];
                                               if($row['admin_status'] == '1'){
                                                $tsel ="SELECT * FROM `book_ticket` ORDER BY id DESC";
                                               } else {
                                                $tsel ="SELECT * FROM `book_ticket` WHERE `agent_name`='$agentid' ORDER BY id DESC";
                                               }
                                              
                                           $trunquery = mysqli_query($con,$tsel);
                                            ?>
                                            <h1><?= mysqli_num_rows($trunquery) ?></h1>
                                            <span>Total Product</span>
                                        </div>
                                        <div class="dashboard-widget-icon">
                                            <i class="fal fa-shopping-bag"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="dashboard-widget dashboard-widget-color-1">
                                        <div class="dashboard-widget-info">
                                            <?php
                                            date_default_timezone_set("Asia/Kolkata");
                                            $date= date("Y-M-d");
                                            if($row['admin_status'] == '1'){  
                                                $tselp ="SELECT * FROM `book_ticket` WHERE status='0' AND date LIKE '%$date%'";
                                               } else {
                                                $tselp ="SELECT * FROM `book_ticket` WHERE `agent_name`='$agentid' AND status='0' AND date LIKE '%$date%'";
                                               }
                                             
                                              $trunqueryp = mysqli_query($con,$tselp);
                                            ?>
                                            <h1><?= mysqli_num_rows($trunqueryp) ?></h1>
                                            <span>Today Product</span>
                                        </div>
                                        <div class="dashboard-widget-icon">
                                            <i class="fal fa-shopping-bag"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6 col-lg-4">
                                    <div class="dashboard-widget dashboard-widget-color-2">
                                        <div class="dashboard-widget-info">
                                        <?php
                                         if($row['admin_status'] == '1'){
                                            $tselc ="SELECT * FROM `book_ticket` WHERE status='1' OR status='3'";
                                           } else {
                                            $tselc ="SELECT * FROM `book_ticket` WHERE `agent_name`='$agentid' AND (status='1' OR status='3')";
                                           }
                                              
                                              $trunqueryc = mysqli_query($con,$tselc);
                                            ?>
                                            <h1><?= mysqli_num_rows($trunqueryc) ?></h1>
                                            <span></span>
                                        </div>
                                        <div class="dashboard-widget-icon">
                                            <i class="fal fa-shopping-bag"></i>
                                        </div>
                                    </div>
                                </div> -->
                            </div>


                            <div class="user-profile-card">
                            <?php include('alertmsg.php'); ?>
                                <h4 class="user-profile-card-title">Product History <a href="addproduct.php" class="theme-btn p-2" style="font-size:15px; float:right;"> <i class="fal fa-shopping-bag"> </i>&nbsp; Add New Product
                            </a></h4>
                                <div class="table-responsive">
                                    <!-- <table class="table text-nowrap table-striped"> -->
                                    <table class="table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Product ID</th>    
                                                <th>Product Title</th>
                                                <th>Old Price</th>
                                                <th>New Price</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                               
                                                      $i=01;
                                                 if(mysqli_num_rows($trunquery) > 0 ){

                                                        while($rows = mysqli_fetch_array($trunquery)){
 
                                                              ?>

                                                                <tr>
                                                <td><?= $i ?></td>
                                                <td><b><?= $rows['unique_id'] ?></b></td>
                                                <td><?= $rows['name'] ?></td>
                                                <td> <i class="fa fa-inr"></i> <?= $rows['price'] ?></td>
                                                <td>  <i class="fa fa-inr"></i> <?= $rows['n_price'] ?></td>
                                                <td><?= $rows['date'] ?></td>
                                               
                                                <td>
                                                 <a href="ticket_details.php?uniqueid=<?= $rows['unique_id'] ?>" class="btn btn-outline-secondary btn-sm"><i
                                                            class="far fa-eye"></i></a>
                                                 <a href="addproduct.php?uniqid=<?= $rows['unique_id'] ?>" class="btn btn-outline-secondary btn-sm"><i
                                                 class="far fa-pen"></i></a>
                                                 <a href="prodelete.php?uniqid=<?= $rows['unique_id'] ?>" class="btn btn-outline-secondary btn-sm"><i
                                                 class="fa fa-close"></i></a>
                                                </td>
                                            </tr>

                                                         <?php
                                                        $i++;

                                                        } 

                                                   } else {
                                                      echo 'Data Not Found';
                                                       }
                                                   ?>
                                          
                                       </tbody>
                                    </table>
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

    <script>
  $(document).ready( function () {
		$('.table').DataTable();
  });
  </script>
</body>

<!-- Mirrored from live.themewild.com/mytrip/profile-booking-history.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:44 GMT -->

</html>