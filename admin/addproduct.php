<?php include("connection.php"); 
include("function.php"); 
if(!isset($_SESSION['admin_uniqueid']) && !isset($_SESSION['admin_username']))
{
     header("location:login.php");
}
$user_name = $_SESSION['admin_username'];
 if(isset($_REQUEST['uniqid'])){
    $uniqid = $_REQUEST['uniqid'];
    $sel ="SELECT * FROM `book_ticket` WHERE `unique_id`='$uniqid'";
    $runquery = mysqli_query($con,$sel);
  $row = mysqli_fetch_array($runquery);
    $uniqueid = $row['unique_id'];
 } 
 


if(isset($_POST['contact_info'])){
    $user_name = $_SESSION['admin_username'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $old_price = $_POST['old_price'];
    $n_price = $_POST['n_price'];
    $f_image=$_FILES['f_image']['name'];
    $s_image=$_FILES['s_image']['name'];
    $description = $_POST['description'];


    

    if(!empty($name) && !empty($old_price) && !empty($n_price) && !empty($f_image) && !empty($s_image) && !empty($description)){

        $tmpf_image=$_FILES['f_image']['tmp_name'];  
    $folder='assets/img/product/'.$f_image;
    move_uploaded_file($tmpf_image, $folder);

    $tmps_image=$_FILES['s_image']['tmp_name'];  
    $folder2='assets/img/product/'.$s_image;
    move_uploaded_file($tmps_image, $folder2);

      
        $unique_id=uniqid();
        date_default_timezone_set("Asia/Kolkata");
        $date_time= date("Y-M-d h:i:s");  
        if(isset($uniqueid)){
            $query="UPDATE `book_ticket` SET `name`='$name',`category`='$category',`description`='$description',`price`='$old_price',`n_price`='$n_price',`image1`='$f_image',`image`='$s_image' WHERE `unique_id`='$uniqueid'"; 
        }  else {
            $query="INSERT INTO `book_ticket`(`unique_id`, `agent_name`, `name`, `category`, `description`, `price`, `n_price`, `image1`, `image`, `status`, `date`, `quantity`) VALUES ('$unique_id','$user_name','$name','$category','$description','$old_price','$n_price','$f_image','$s_image','0','$date_time','1')"; 
        }
        
      $run=mysqli_query($con ,$query); 
      
        if($run)
        {
            $_SESSION['msg']='<b> Product Info Added Success !! Please proceed. ! </b>';
                header("location:index.php");
           session_regenerate_id(true);
           exit();
        }
        else
        {
           echo $_SESSION['error']='<b> Error ! Product Info Failed ! Try Again !! </b>';
        } 


    } else {

        if(isset($row)){
            if(!empty($name) && !empty($old_price) && !empty($n_price) && !empty($description)){      
                $unique_id=uniqid();
                date_default_timezone_set("Asia/Kolkata");
                $date_time= date("Y-M-d h:i:s");  
    
                if(isset($uniqueid)){
                    $query="UPDATE `book_ticket` SET `name`='$name',`category`='$category',`description`='$description',`price`='$old_price',`n_price`='$n_price' WHERE `unique_id`='$uniqueid'"; 
                }  else {
                    $query="INSERT INTO `book_ticket`(`unique_id`, `agent_name`, `name`, `category`, `description`, `price`, `n_price`, `image1`, `image`, `status`, `date`) VALUES ('$unique_id','$user_name','$name','$category','$description','$old_price','$n_price','$f_image','$s_image','0','$date_time')"; 
                }
                
              $run=mysqli_query($con ,$query); 
              
                if($run)
                {
                    $_SESSION['msg']='<b> Product Info Added Success !! Please proceed. ! </b>';
                        header("location:index.php");
                   session_regenerate_id(true);
                   exit();
                }
                else
                {
                   echo $_SESSION['error']='<b> Error ! Product Info Failed ! Try Again !! </b>';
                } 
        
        
            } else {
                   echo $_SESSION['error']='<b> Error ! All Field Required </b>'; 
                }
         } else {
            echo $_SESSION['error']='<b> Error ! All Field Required </b>';
         }

       


        }
    

  
     
}

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from live.themewild.com/mytrip/flight-booking.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:16:41 GMT -->

<head>

<?php include("headerlink.php"); ?>
</head>

<body>


    <?php include("header.php"); ?>
    </header>

    <main class="main">

        <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title"> <?php
                                     if(isset($row)){
                                        echo "Update Product";
                                     } else {
                                        echo "Add New Product";
                                     }
                                        ?></h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><?php
                                     if(isset($row)){
                                        echo "Update Product";
                                     } else {
                                        echo "Add New Product";
                                     }
                                        ?></li>
                </ul>
            </div>
        </div>

        <div class="search-area">
            <div class="container">
                <div class="search-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                  
                        <div class="booking-widget">
                        <a href="index.php" class="theme-btn p-2" style="font-size:10px;"> <i class="fas fa-long-arrow-left"></i> Back Page
                            </a>
                       
    <?php include('alertmsg.php'); ?>

                            <h4 class="booking-widget-title">Product Info</h4>
                            <div class="booking-form">
                                <form action="#" method="post" enctype="multipart/form-data">
                                    <?php
                                     if(isset($row)){
                                        ?>
                                   <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Product Title</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" name="name" placeholder="Product Title" value="<?= $row['name'] ?>" required>
                                                    <i class="fal fa-shopping-bag"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Product Category</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" name="category" placeholder="Product Category" value="<?= $row['category'] ?>">
                                                    <i class="fal fa-shopping-bag"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Old Price</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" name="old_price" placeholder="Old Price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="12" required value="<?= $row['price'] ?>"> 
                                                    <i class="fa fa-inr"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>New Price</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" name="n_price" placeholder="New Price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="12" required value="<?= $row['n_price'] ?>">
                                                    <i class="fa fa-inr"></i>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Product Image First</label>
                                                <div class="form-group-icon">
                                                    <input type="file" class="form-control" placeholder="Product Image First" name="f_image" >
                                                    <i class="fa fa-file-image"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Product Image Second</label>
                                                <div class="form-group-icon">
                                                    <input type="file" class="form-control" placeholder="Product Image Second" name="s_image" >
                                                    <i class="fa fa-file-image"></i>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Product Description</label>
                                                <div class="form-group-icon">
                                                    <textarea class="form-control" cols="30" rows="5"
                                                        placeholder="Product Description" name="description"><?= $row['description'] ?></textarea required>
                                                    <i class="far fa-pen"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                                        <div class="form-group mt-2">
                                                            <button type="submit" class="theme-btn" name="contact_info">Save</button>
                                                        </div>
                                                    </div>
                                    </div>
                                        <?php
                                     } else {
                                        ?>
                                       <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Product Title</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" name="name" placeholder="Product Title" required>
                                                    <i class="fal fa-shopping-bag"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Product Category</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" name="category" placeholder="Product Category">
                                                    <i class="fal fa-shopping-bag"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Old Price</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" name="old_price" placeholder="Old Price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="12" required>
                                                    <i class="fa fa-inr"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>New Price</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" name="n_price" placeholder="New Price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="12" required>
                                                    <i class="fa fa-inr"></i>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Product Image First</label>
                                                <div class="form-group-icon">
                                                    <input type="file" class="form-control" placeholder="Product Image First" name="f_image" required >
                                                    <i class="fa fa-file-image"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Product Image Second</label>
                                                <div class="form-group-icon">
                                                    <input type="file" class="form-control" placeholder="Product Image Second" name="s_image" required >
                                                    <i class="fa fa-file-image"></i>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Product Description</label>
                                                <div class="form-group-icon">
                                                    <textarea class="form-control" cols="30" rows="5"
                                                        placeholder="Product Description" name="description"></textarea required>
                                                    <i class="far fa-pen"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                                        <div class="form-group mt-2">
                                                            <button type="submit" class="theme-btn" name="contact_info">Save</button>
                                                        </div>
                                                    </div>
                                    </div>
                                        <?php
                                     }
                                    ?>
                                    
                                </form>
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

<!-- Mirrored from live.themewild.com/mytrip/flight-booking.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:16:43 GMT -->

</html>