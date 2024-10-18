<?php
session_start();
if(!isset($_SESSION['mobile']))
{
    header("Location:login.php");
}

 $mobile=$_SESSION['mobile'];

 require("connection.php");
  
//  echo "<script>alert('$mobile')</script>";

$sqla = "SELECT a.`admin_mobile`,u.`agent_name`
            FROM `user` u
            INNER JOIN `admin` a ON u.`agent_name` = a.`admin_username`
            WHERE u.`mobile`='$mobile'";
    
    $querya = mysqli_query($con, $sqla);
    $rowa = mysqli_fetch_array($querya);
    $adminMobile = $rowa['admin_mobile'];

$sql="SELECT * FROM `user` WHERE mobile='$mobile'";  

$query = mysqli_query($con,$sql);
$row=mysqli_fetch_array($query);
$name=$row['agent_name'];

if(isset($_REQUEST['unique_id'])){
    $unique_id = $_REQUEST['unique_id'];
    $sql="UPDATE `book_ticket` SET `status`='$mobile' WHERE `unique_id`='$unique_id'";  
    $query = mysqli_query($con,$sql);
    if($query){
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css">
        
        <script>
        window.onload = function() {
            Swal.fire({
                position: "top",
                icon: "success",
                title: "Product Add Success!",
                showConfirmButton: false,
                timer: 1500
                 }).then(function() {
                    window.location.href = "index.php";
                  });
        }
        </script>
        ';    
    } else {
        echo '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css">
        
        <script>
        window.onload = function() {
            Swal.fire({
                position: "top",
                icon: "error",
                title: "Product Add Failed!",
                showConfirmButton: false,
                timer: 2000
                 }).then(function() {
                    window.location.href = "index.php";
                  });
        }
        </script>
        ';
    }
}



// echo "<script>alert('$name')</script>";
// $c = mysqli_num_rows($query);

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored by HTTrack Website Copier/3.x [XR/YP'2000] -->

<head>
<!-- ------------------include headerlink---------------------------------  -->

<?php include('headerlink.php') ?>

<!-- ------------------include headerlink---------------------------------  -->
</head>

<body>

<!-- ------------------include headerlink---------------------------------  -->

<?php include('header.php') ?>

<!-- ------------------include headerlink---------------------------------  -->



    <div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Shariq Grocery Shop</h2>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
              
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">

                                    <div class="total-products">
                                        <p><span>products found</span> </p>
                                    </div>

                                    <div class="product-sorting d-flex">
    <p>Sort by:</p>
    <form action="#" method="post">
        <select name="select" id="sortByselect" onchange="redirectToPage(this)">
            <option value="high">Highest Rated</option>
            <option value="low">Lowest Rated</option>
            <option value="midlow">Price: 200 - 500</option>
            <option value="mid">Price: 500 - 1,000</option>
            <option value="midhigh">Price: 1,000 - 10,000</option>
        </select>
    </form>
</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php 
                             if(isset($_POST['search_submit'])){
                                if(!empty($search)){
                                $sql1="SELECT * FROM `book_ticket` WHERE agent_name='$name' AND (name LIKE '%$search%' OR category LIKE '%$search%' OR description LIKE '%$search%' OR price LIKE '%$search%' OR n_price LIKE '%$search%')";
                                } else {
                                    $sql1="SELECT * FROM `book_ticket` WHERE agent_name='$name'";
                                }
                            } elseif(isset($_REQUEST['pr'])) {
                                $prvl = $_REQUEST['pr'];
                               if($prvl == 'high'){
                                $sql1="SELECT * FROM `book_ticket` WHERE agent_name='$name' ORDER BY n_price DESC";
                               } elseif($prvl == 'low'){
                                $sql1="SELECT * FROM `book_ticket` WHERE agent_name='$name' ORDER BY n_price ASC";
                               } elseif($prvl == 'midlow'){
                                $sql1="SELECT * FROM `book_ticket` WHERE agent_name='$name' AND n_price BETWEEN 200 AND 500";
                               } elseif($prvl == 'mid'){
                                $sql1="SELECT * FROM `book_ticket` WHERE agent_name='$name' AND n_price BETWEEN 500 AND 1000";
                               } elseif($prvl == 'midhigh'){
                                $sql1="SELECT * FROM `book_ticket` WHERE agent_name='$name' AND n_price BETWEEN 1000 AND 10000";
                               }
                            } else {
                                $sql1="SELECT * FROM `book_ticket` WHERE agent_name='$name' ORDER BY id DESC";
                            }
                             
                            $query1 = mysqli_query($con,$sql1);
                            while($row1=mysqli_fetch_array($query1))
                            {
                     
                            ?>
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="single-product-wrapper">

                                    <div class="product-img">
                                        <img src="admin/assets/img/product/<?= $row1['image1'] ?>" alt>
                                    </div>

                                    <div class="product-description">
                                        <span><?= $row1['category']?></span>
                                        <a href="single-product-details.php?unique_id=<?= $row1['unique_id']?>&category=<?= $row1['category']?>">
                                            <h6><?= $row1['name']?></h6>
                                        </a>
                                        <p class="product-price"><span class="old-price"><?= $row1['price']?></span><?= $row1['n_price']?></p>

                                        <div class="hover-content">

                                            <div class="add-to-cart-btn">
                                                <a href="index.php?unique_id=<?= $row1['unique_id']?>" class="btn essence-btn">Add To Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }  ?>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ---------------------------------------- include footer section ----------------------------------- -->

    <?php include('footer.php') ?>

    <!-- ---------------------------------------- include footer section ----------------------------------- -->



    <!-- ---------------------------------------- include footer_link ----------------------------------- -->

    <?php include('footerlink.php') ?>

    <!-- ---------------------------------------- include footer_link ----------------------------------- -->

</body>

<!-- Mirrored by HTTrack Website Copier/3.x [XR/YP'2000] -->

</html>