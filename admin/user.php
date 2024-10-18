<?php include("connection.php"); 
include("function.php"); 
if(!isset($_SESSION['admin_uniqueid']) && !isset($_SESSION['admin_username']))
{
     header("location:login.php");
}
$uniq = $_SESSION['admin_uniqueid'];
$user_name = $_SESSION['admin_username'];
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

        <!--  -->

        <div class="user-profile">
            <div class="container">
                <div class="row">
                <?php
                     $page ='user';
                    include("sidebar.php"); ?>
                    <div class="col-lg-9">
                        <div class="user-profile-wrapper">

                       


                            <div class="user-profile-card">
                            <?php include('alertmsg.php'); ?>
                                <h4 class="user-profile-card-title"><?php if($row['admin_status'] == '1'){
                                                echo "All Users";
                                               } else {
                                              echo "My Users";
                                               } ?> <a href="adduser.php" class="theme-btn p-2" style="font-size:15px; float:right;"> <i class="fa fa-user"> </i> Add New User
                            </a></h4>
                                <div class="table-responsive">
                                    <!-- <table class="table text-nowrap table-striped"> -->
                                    <table class="table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>User ID</th>    
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile Number</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                               
                                                      $i=01;
                                                      if($row['admin_status'] == '1'){
                                                        $tsel ="SELECT * FROM `user` WHERE user_name != '' ORDER BY id DESC";
                                                      } else {
                                                        $tsel ="SELECT * FROM `user` WHERE agent_name='$user_name'";
                                                      }
                                                     
                                                      $trunquery = mysqli_query($con,$tsel);
                                                 if(mysqli_num_rows($trunquery) > 0 ){

                                                        while($rows = mysqli_fetch_array($trunquery)){
 
                                                              ?>

                                                                <tr>
                                                <td><?= $i ?></td>
                                                <td><b><?= $rows['unique_id'] ?></b></td>
                                                <td><?= $rows['user_name'] ?></td>
                                                <td><?= $rows['user_email'] ?></td>
                                                <td><?= $rows['mobile'] ?></td>
                                                <td>
                                                 <a href="edituser.php?uniqid=<?= $rows['unique_id'] ?>" class="btn btn-outline-secondary btn-sm"><i
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