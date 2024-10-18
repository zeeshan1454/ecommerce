<?php include("connection.php");
include("function.php"); 
if(!isset($_SESSION['admin_uniqueid']) && !isset($_SESSION['admin_username']))
{
     header("location:login.php");
}
$uniq = $_REQUEST['uniqueid'];


$sel ="SELECT * FROM `book_ticket` WHERE `unique_id`='$uniq'";
$runquery = mysqli_query($con,$sel);
 $row = mysqli_fetch_array($runquery);


?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from live.themewild.com/mytrip/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:32 GMT -->

<head>

<?php include("headerlink.php"); ?>
<style>
    tbody, td, tfoot, th, thead, tr{
        font-size: 12px !important;
    }
</style>
</head>

<body>

    <?php include("header.php"); ?>
    </header>

    <main class="main">

        <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/02.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Product Details</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php">Product</a></li>
                    <li class="active">Product Details</li>
                </ul>
            </div>
        </div>

        <div class="faq-area py-120">
            <div class="container">
                <div class="row">
                        <div class="col-lg-12">
                        <div class="user-profile-wrapper">
                            <div class="user-profile-card">
                                <h4 class="user-profile-card-title">Product Details <a href="index.php" class="theme-btn p-2" style="font-size:10px; float:right;"> <i class="fas fa-long-arrow-left"></i> Back Page
                            </a></h4>
                                       <div class="row p-2">

                                <div class="col-lg-6">
                                    <div class="profile-info-list">
                                        <ul> 
                                            <li>Product Id: <span><?= $row['unique_id'] ?></span></li>
                                            <li>Product Title: <span><?= $row['name'] ?></span></li>
                                            <li>Product Category: <span><?= $row['category'] ?></span></li>
                                            <li>First Image: <span><img src="assets/img/product/<?= $row['image1'] ?>" alt="" width="150px"></span></li>
                                             
                                                                               
                                        </ul>
                                    </div>
                                </div>

                                       <div class="col-lg-6">
                                    <div class="profile-info-list">
                                        <ul> 
                                            
                                            <li>Agent Name: <span><?= $row['agent_name'] ?></span></li>
                                           <li>Old Price: <span><i class="fa fa-inr"></i> <?= $row['price'] ?></span></li>
                                            <li>New Price <span><i class="fa fa-inr"></i> <?= $row['n_price'] ?></span></li>
                                            <li>SEcond Image: <span><img src="assets/img/product/<?= $row['image'] ?>" alt="" width="150px"></span></li>

                                        </ul>
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

<!-- Mirrored from live.themewild.com/mytrip/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:32 GMT -->

</html>