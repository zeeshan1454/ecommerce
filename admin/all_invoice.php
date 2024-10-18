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
// print_r($row);
// die();
?>
<!DOCTYPE html>
<html lang="en">


<head>

<?php include("headerlink.php"); ?>
</head>

<body>

    <!-- <div class="preloader">
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
    </div> -->


    <header class="header">

    
    </header>

    <main class="main mt-3">

        <!-- <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/02.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title"><?php  if($row['admin_status'] == '1'){
                                    echo "All Invoice";
                                   } else {
                                    echo "My Invoice";
                                   }
                                ?></h2>
                <ul class="breadcrumb-menu">
                    <li><a href="admin.php">Home</a></li>
                    <li class="active"><?php  if($row['admin_status'] == '1'){
                                    echo "All Invoice";
                                   } else {
                                    echo "My Invoice";
                                   }
                                ?></li>
                </ul>
            </div>
        </div> -->

        <div class="user-profile ">
            <div class="container">
                <div class="row">
                    <?php
                     $page ='invoice';
                    include("sidebar.php"); ?>
                    <div class="col-lg-9">
                        <div class="user-profile-wrapper">

                        
                        <div class="row">
                        
                                <div class="col-md-6 col-lg-6">
                                    <div class="dashboard-widget dashboard-widget-color-3">
                                        <div class="dashboard-widget-info">
                                            <?php
                                               $agentid = $row['admin_username'] ?? '';
                                               if($row['admin_status'] == '1'){
                                                $tsel ="SELECT * FROM `invoice_tbl` ORDER BY id DESC";
                                               }
                                              
                                           $trunquery = mysqli_query($con,$tsel);
                                            ?>
                                            <h1><?= mysqli_num_rows($trunquery) ?></h1>
                                            <span>Total Invoice</span>
                                        </div>
                                        <a href="export_total.php">
                                        <div class="dashboard-widget-icon">
                                            <!-- <i class="far fa-clipboard-list"></i> -->
                                            <i class="fa fa-download"></i>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="dashboard-widget dashboard-widget-color-1">
                                        <div class="dashboard-widget-info">
                                            <?php
                                            date_default_timezone_set("Asia/Kolkata");
                                            $date= date("Y-m-d");
                                            if($row['admin_status'] == '1'){  
                                                 $tselp ="SELECT * FROM `invoice_tbl` WHERE created_at LIKE '%$date%'";
                                               } 
                                             
                                              $trunqueryp = mysqli_query($con,$tselp);
                                            ?>
                                            <h1><?= mysqli_num_rows($trunqueryp) ?></h1>
                                            <span>Today Invoice</span>
                                        </div>
                                        <a href="export_total.php?filter=today">
                                        <div class="dashboard-widget-icon">
                                            <!-- <i class="far fa-clipboard-list"></i> -->
                                            <i class="fa fa-download"></i>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6 col-lg-4">
                                    <div class="dashboard-widget dashboard-widget-color-2">
                                        <div class="dashboard-widget-info">
                                        <?php
                                        //  if($row['admin_status'] == '1'){
                                        //     $tselc ="SELECT * FROM `invoice_tbl` WHERE status='1' OR status='3'";
                                        //    } else {
                                        //     $tselc ="SELECT * FROM `invoice_tbl` WHERE `agent_name`='$agentid' AND (status='1' OR status='3')";
                                        //    }
                                        //       $trunqueryc = mysqli_query($con,$tselc);
                                        // echo mysqli_num_rows($trunqueryc);
                                            ?>
                                            <h1> </h1>
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
                                <h4 class="user-profile-card-title">Invoice History <a href="invoice2.php" class="theme-btn p-2" style="font-size:15px; float:right;"> <i class="fal fa-shopping-bag"> </i>&nbsp; Add New Invoice
                            </a></h4>
                                <div class="table-responsive">
                                    <!-- <table class="table text-nowrap table-striped"> -->
                                    <table class="table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Invoice ID</th>    
                                                <th>Name</th>
                                                <th>Phone Number</th>
                                                <th>Total</th>
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
                                                <td><b><?= $rows['unique_id'] ?? '' ?></b></td>
                                                <td><?= $rows['name'] ?? '' ?></td>
                                                <td> <?= $rows['mobile'] ?? '' ?></td>
                                                <td>  <i class="fa fa-inr"></i> <?= $rows['total'] ?? '' ?></td>
                                                <td><?= $rows['created_at'] ?? '' ?></td>
                                               
                                                <td>
                                                 <a href="invoice.php?uniqid=<?= $rows['unique_id'] ?? '' ?>" class="btn btn-outline-secondary btn-sm"><i
                                                 class="far fa-pen"></i></a>
                                                 <a href="inoive_delete.php?uniqid=<?= $rows['unique_id'] ?? '' ?>" class="btn btn-outline-secondary btn-sm"><i
                                                 class="fa fa-trash"></i></a>
                                                 <a href="export.php?uniqid=<?= $rows['unique_id'] ?? '' ?>" class="btn btn-outline-secondary btn-sm"><i
                                                 class="fa fa-download"></i></a>
                                                 <a class="btn btn-outline-secondary btn-sm print_invoice" data-uniqid="<?= $rows['unique_id'] ?? '' ?>"><i
                                                 class="fa fa-print"></i></a>
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

  $(document).ready(function () {
    $('.print_invoice').click(function () {
        var uniq_id = $(this).data('uniqid');
        if (uniq_id) {
            var url = 'print_single_invoice.php?uniqid=' + encodeURIComponent(uniq_id);
            var myWindow = window.open(url, 'Print Invoice', 'height=600,width=800');
            myWindow.onload = function() {
                myWindow.print();
                myWindow.onafterprint = function() {
                    myWindow.close();
                };
            };
        } else {
            alert('Unique ID is missing!');
        }
    });
});

  </script>
</body>

<!-- Mirrored from live.themewild.com/mytrip/profile-booking-history.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:44 GMT -->

</html>