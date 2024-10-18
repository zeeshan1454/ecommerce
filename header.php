<?php      
if(isset($_POST['search'])){
   $search=$_POST['search'];
}
if(isset($_REQUEST['deleteid'])){
    $did = $_REQUEST['deleteid'];
    $sql="UPDATE `book_ticket` SET `status`='0' WHERE `unique_id`='$did'";  
   if(mysqli_query($con,$sql)){
    echo "<script>window.location.href='index.php?did'</script>";
   }
    
    
}
if(isset($_POST['chackall'])){
    $total = $_POST['total'];
    $proname = $_POST['proname'];
  
    
    $comment = "
    User Phone Number: $mobile
    $proname
    Total Price ₹: $total
    ";
    
    $whatsappMessage = urlencode($comment);
    
    $whatsappURL = "https://api.whatsapp.com/send?phone=+$adminMobile&text=$whatsappMessage";
    echo "<script>window.location.href='$whatsappURL'</script>";
    // header("location: $whatsappURL");
    exit();
}
?>
<header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">

        <nav class="classy-navbar" id="essenceNav">

            <a class="nav-brand" href="index.php"><img src="img/core-img/rizwanlogo.png" class="logo_image"
                    alt="website_logo"></a>

            <div class="classy-navbar-toggler">
                <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>

            <div class="classy-menu">

                <div class="classycloseIcon">
                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                </div>

                <div class="classynav">
                    <ul>
                        <!-- <li><a href="#">Shop</a>
                                <div class="megamenu">
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Women's Collection</li>
                                        <li><a href="shop.php">Dresses</a></li>
                                        <li><a href="shop.php">Blouses &amp; Shirts</a></li>
                                        <li><a href="shop.php">T-shirts</a></li>
                                        <li><a href="shop.php">Rompers</a></li>
                                        <li><a href="shop.php">Bras &amp; Panties</a></li>
                                    </ul>
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Men's Collection</li>
                                        <li><a href="shop.php">T-Shirts</a></li>
                                        <li><a href="shop.php">Polo</a></li>
                                        <li><a href="shop.php">Shirts</a></li>
                                        <li><a href="shop.php">Jackets</a></li>
                                        <li><a href="shop.php">Trench</a></li>
                                    </ul>
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Kid's Collection</li>
                                        <li><a href="shop.php">Dresses</a></li>
                                        <li><a href="shop.php">Shirts</a></li>
                                        <li><a href="shop.php">T-shirts</a></li>
                                        <li><a href="shop.php">Jackets</a></li>
                                        <li><a href="shop.php">Trench</a></li>
                                    </ul>
                                    <div class="single-mega cn-col-4">
                                        <img src="img/bg-img/bg-6.jpg" alt>
                                    </div>
                                </div>
                            </li> -->
                        <!-- <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="shop.php">Shop</a></li>
                                    <li><a href="single-product-details.php">Product Details</a></li>
                                    <li><a href="checkout.php">Checkout</a></li>
                                    <li><a href="blog.php">Blog</a></li>
                                    <li><a href="single-blog.php">Single Blog</a></li>
                                    <li><a href="regular-page.php">Regular Page</a></li>
                                    <li><a href="contact.php">Contact</a></li>
                                </ul>
                            </li> -->
                        <!-- <li><a href="blog.php">Blog</a></li> -->
                        <li><a href="index.php">Home</a></li>
                        <!-- <li><a href="contact.php">Contact</a></li> -->
                    </ul>
                </div>

            </div>
        </nav>

        <div class="header-meta d-flex clearfix justify-content-end">

            <div class="search-area">
                <form action="" method="post">
                    <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                    <button type="submit" name="search_submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>


            <?php   
                if(isset($_SESSION['mobile'])) 
                      {
                     ?>
            <div class="favourite-area">
                <a href="logout.php"><img src="img/core-img/logout.png" title="Logout" alt></a>
            </div>
            <?php }else{?>
            <div class="user-login-info">
                <a href="login.php"><img src="img/core-img/user.svg" title="login" alt></a>
            </div>
            <?php } ?>

            <?php
                 $sqlc="SELECT * FROM `book_ticket` WHERE agent_name='$name' AND status='$mobile'";
                 $queryc = mysqli_query($con,$sqlc);
                 $numrow=mysqli_num_rows($queryc);
                
                ?>

            <div class="cart-area">
                <a href="#" id="essenceCartBtn"><img src="img/core-img/bag.svg" alt> <span><?= $numrow ?></span></a>
            </div>
        </div>
    </div>
</header>
<form action="#" method="post">
    <div class="cart-bg-overlay"></div>
    <div class="right-side-cart-area <?php if(isset($_REQUEST['did'])){
    echo "cart-on";
} ?>">

        <div class="cart-button">
            <a href="#" id="rightSideCart"><img src="img/core-img/bag.svg" alt> <span><?= $numrow ?></span></a>
        </div>

        <div class="cart-content d-flex">

            <div class="cart-list">


                <?php
                  if($numrow > 0){
                    $total = 0;
                    $proname = "";
                    $i = '1';
                    while($rowc=mysqli_fetch_array($queryc)){
                     ?>

                <div class="single-cart-item">
                    <div class="product-image">
                        <img src="admin/assets/img/product/<?= $rowc['image1'] ?>" class="cart-thumb" alt>

                        <div class="cart-item-desc">
                            <a href="index.php?deleteid=<?= $rowc['unique_id']?>">
                                <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                            </a>
                            <a
                                href="single-product-details.php?unique_id=<?= $rowc['unique_id']?>&category=<?= $rowc['category']?> ">
                                <span class="badge"><?= $rowc['name']?></span>
                                <h6><?= $rowc['category']?></h6>
                                <!-- <h6><?= substr($rowc['description'],0,100) ?></h6> -->
                                <p class="price">₹ <?= $rowc['n_price'] ?></p>
                            </a>
                            <input type="text" name="quantity" data-id='<?= $rowc['unique_id']?>'
                                class="form-control mt-2 quantity" value='<?= $rowc['quantity'] ?>'
                                placeholder="Quantity"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                maxlength="12">

                        </div>
                    </div>
                </div>

                <?php
                     $total += $rowc['n_price'] * $rowc['quantity']; 
                     $proname .= " ". $i ." " . " Product Name ". $rowc['name'] . " . " . " Product ID " . $rowc['unique_id'] . " . " . " Product Quantity " . $rowc['quantity'] . " , ";
                     $i++;
                    }

                  } else {
                    echo "NO Data Add To Cart";
                  }
                 ?>



            </div>

            <div class="cart-amount-summary">
                <h2>Summary</h2>

                <ul class="summary-table">
                    <input type="hidden" name="total" value="<?php echo $total; ?>">
                    <input type="hidden" name="proname" value="<?php echo $proname; ?>">

                    <li><span>subtotal:</span> <span>₹
                            <?php if(isset($total)){ echo $total ; }else { echo '00' ; } ?></span></li>
                    <li><span>delivery:</span> <span>Free</span></li>
                    <!-- <li><span>discount:</span> <span>-15%</span></li> -->
                    <li><span>total:</span> <span>₹
                            <?php if(isset($total)){ echo $total ; }else { echo '00' ; }; ?></span></li>
                </ul>
                <div class="checkout-btn mt-100">


                    <button type="submit" name="chackall" value="5" class="btn essence-btn mr-auto">Chackout</button>

                </div>

            </div>

        </div>
    </div>
</form>