<?php
session_start();
if(!isset($_SESSION['mobile']))
{
    header("Location:login.php");
}

require("connection.php");

    $mobile = $_SESSION['mobile'];

    $sql = "SELECT a.`admin_mobile`,u.`agent_name`
            FROM `user` u
            INNER JOIN `admin` a ON u.`agent_name` = a.`admin_username`
            WHERE u.`mobile`='$mobile'";
    
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);
    $adminMobile = $row['admin_mobile'];
    $name=$row['agent_name'];
  $unique_id=$_REQUEST['unique_id'];

   $sql1="SELECT * FROM `book_ticket` WHERE unique_id='$unique_id'";  
   $query1 = mysqli_query($con,$sql1);
   $row1=mysqli_fetch_array($query1);
  
   if(isset($_POST['addtocart'])){
    $title = $row1['name'];
    $quantity = $_POST['quantity'];
    $exampletotal = $_POST['exampletotal'];
    
    $comment = "
    User Phone Number: $mobile
    Product Id: $unique_id
    Product Name: $title
    Quantity: $quantity
    Total Price ₹: $exampletotal
    ";
    
    $whatsappMessage = urlencode($comment);
    
    $whatsappURL = "https://api.whatsapp.com/send?phone=+$adminMobile&text=$whatsappMessage";
    
    // Redirect the user to the WhatsApp URL
    header("location: $whatsappURL");
    exit();
}


if(isset($_POST['addcart'])){
    $sql="UPDATE `book_ticket` SET `status`='1' WHERE `unique_id`='$unique_id'";  
    $query = mysqli_query($con,$sql);
    if($query){
       header("location:index.php");
    } else {
        alert("Data Not Add To Cart"); 
    }
}


//   echo "<script>alert('$unique_id')</script>";
//   echo "<script>alert('$category')</script>";
//   echo "<script>alert('$agent_name')</script>";

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored by HTTrack Website Copier/3.x [XR/YP'2000] -->

<head>
   <!-- ------------------include headerlink---------------------------------  -->

<?php include('headerlink.php') ?>

<!-- ------------------include headerlink---------------------------------  -->

</head>
<!-- ------------------include headerlink---------------------------------  -->

<?php include('header.php') ?>

<!-- ------------------include headerlink---------------------------------  -->

<body>



    <section class="single_product_details_area d-flex align-items-center">
        <div class="single_product_thumb clearfix">
            <div class="product_thumbnail_slides owl-carousel">
                <img src="admin/assets/img/product/<?= $row1['image1'] ?>" alt="slider_image">
                <img src="admin/assets/img/product/<?= $row1['image'] ?>" alt="slider_image">
                
            </div>
        </div>

        <!-- <div class="single_product_desc clearfix">
            <span><?= $row1['category'] ?></span>
            
                <h2><?= $row1['name'] ?></h2>
                 <?php
                   $price = $row1['n_price'];                 
 
                 ?>
            <p class="product-price"><span class="old-price"><?= $row1['price'] ?></span><?= $row1['n_price'] ?></p>
            <p class="product-desc"><?= $row1['description'] ?></p>

            
                <div class="cart-fav-box d-flex align-items-center">

                <a href="https://api.whatsapp.com/6395630844" target="_blank"> 
                <button type="submit" name="addtocart" value="5" class="btn essence-btn">Add to cart</button>    
                </a>
                 <div class="product-favourite ml-4">

                    </div>
                </div>
        
        </div> -->
        <div class="single_product_desc clearfix">
        <form action="#" method="post">
            <span><?= $row1['category'] ?></span>
            
                <h2><?= $row1['name'] ?></h2>
           
            <p class="product-price"><span class="old-price"><?= $row1['price'] ?></span> <?= $row1['n_price'] ?></p>
            <p class="product-desc"><?= $row1['description'] ?></p>



            <div class="select-box d-flex mt-50 mb-30">
                <label for="" class="mr-1">Select Quantity</label>
    <select id="quantity" name="quantity" class="mr-5">
        <option value="1" selected>1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
    <input type="text" class="form-control" name="exampletotal" id="exampletotal" value="<?= $row1['n_price'] ?>" placeholder="Total Amount ₹">
    <label for="" class="ml-1">Total Amount ₹</label>
</div>

                <div class="cart-fav-box d-flex align-items-center">

                    <button type="submit" name="addtocart" value="5" class="btn essence-btn mr-auto">Chackout</button>
                    <!-- <button type="submit" name="addcart"class="btn btn-success border rounded-0 px-4 py-2 ml-auto">Add to cart</button> -->

                </div>
            </form>
        </div>
    </section>
    <!-- ---------------------------  card section code ------------------------------------------ -->
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

                                    <!-- <div class="product-sorting d-flex">
                                        <p>Sort by:</p>
                                        <form action="#" method="get">
                                            <select name="select" id="sortByselect">
                                                <option value="value">Highest Rated</option>
                                                <option value="value">Newest</option>
                                                <option value="value">Price: $$ - $</option>
                                                <option value="value">Price: $ - $$</option>
                                            </select>
                                            <input type="submit" class="d-none" value>
                                        </form>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php 
                            //  if(isset($_POST['search_submit'])){
                            //     if(!empty($search)){
                            //     $sql1="SELECT * FROM `book_ticket` WHERE agent_name='$name' AND (name LIKE '%$search%' OR category LIKE '%$search%' OR description LIKE '%$search%' OR price LIKE '%$search%' OR n_price LIKE '%$search%')";
                            //     } else {
                            //         $sql1="SELECT * FROM `book_ticket` WHERE agent_name='$name'";
                            //     }
                            // } else {
                                $cat = $row1['category'];
                                $agent_name = $row1['agent_name'];
                                $sql1="SELECT * FROM `book_ticket` WHERE agent_name='$agent_name' AND category='$cat'";
                            // }
                             
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
                                        <p class="product-price"><span class="old-price"><?= $row1['price']?></span id=""><?= $row1['n_price']?></p>

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
    <!-- ------------------------------------------------- card section code ------------------------------------------ -->

        <!-- ---------------------------------------- include footer section ----------------------------------- -->

        <?php include('footer.php') ?>

<!-- ---------------------------------------- include footer section ----------------------------------- -->



<!-- ---------------------------------------- include footer_link ----------------------------------- -->

<?php include('footerlink.php') ?>

<!-- ---------------------------------------- include footer_link ----------------------------------- -->

</body>

<!-- Mirrored by HTTrack Website Copier/3.x [XR/YP'2000] -->
<script>
$(document).ready(function(){ 
    $("#quantity").on('change', function(){
        var stotal = parseFloat($("#exampletotal").val()); // Parse as float
        var qtity = parseFloat($("#quantity").val());
        var total = qtity * stotal;
        $("#exampletotal").val(total);
    });
});
</script>
</html>