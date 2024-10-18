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
            <div class=""></div>
        </div>
    </div>


    <header class="header">

   
    </header>

    <main class="main mt-3">

        <!-- <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/02.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">All Agents</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="admin.php">Home</a></li>
                    <li class="active">All Agents</li>
                </ul>
            </div>
        </div> -->

        <div class="user-profile">
            <div class="container">
                <div class="row">
                <?php
                     $page ='agent';
                    include("sidebar.php"); ?>
                    <div class="col-lg-9">
                        <div class="user-profile-wrapper">

                       


                            <div class="user-profile-card">
                            <?php include('alertmsg.php'); ?>
                                <h4 class="user-profile-card-title">All Agent <a href="register.php" class="theme-btn p-2" style="font-size:15px; float:right;"> <i class="fa fa-user"> </i> Add New Agent
                            </a></h4>
                                <div class="table-responsive">
                                    <!-- <table class="table text-nowrap table-striped"> -->
                                    <table class="table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Agent ID</th>    
                                                <th>Agent Name</th>
                                                <th>Agent Mobile</th>
                                                <th>Email Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                               
                                                      $i=01;
                                                      $tsel ="SELECT * FROM `admin` ORDER BY admin_id DESC";
                                                      $trunquery = mysqli_query($con,$tsel);
                                                 if(mysqli_num_rows($trunquery) > 0 ){

                                                        while($rows = mysqli_fetch_array($trunquery)){
 
                                                              ?>

                                                                <tr>
                                                <td><?= $i ?></td>
                                                <td><b><?= $rows['admin_uniqueid'] ?></b></td>
                                                <td><?= $rows['admin_username'] ?></td>
                                                <td><?= $rows['admin_mobile'] ?></td>

                                               
                                                <td><?= $rows['admin_email'] ?></td>
                                                <td>
                                                 <a href="editagent.php?uniqid=<?= $rows['admin_uniqueid'] ?>" class="btn btn-outline-secondary btn-sm"><i
                                                 class="far fa-pen"></i></a>
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