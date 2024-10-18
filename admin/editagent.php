<?php include("connection.php"); 
include("function.php"); 
if(!isset($_SESSION['admin_uniqueid']) && !isset($_SESSION['admin_username']))
{
     header("location:login.php");
}

    $uniqid = $_REQUEST['uniqid'];
    $sel ="SELECT * FROM `admin` WHERE `admin_uniqueid`='$uniqid'";
    $runquery = mysqli_query($con,$sel);
  $row = mysqli_fetch_array($runquery);
    $uniqueid = $row['admin_uniqueid'];
 



if(isset($_POST['contact_info'])){
   
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $image=$_FILES['image']['name'];

    if(!empty($name) && !empty($email) && !empty($password) && !empty($c_password) && !empty($image)){
         
        $tmpimage=$_FILES['image']['tmp_name'];  
        $folder='assets/img/account/'.$image;
        move_uploaded_file($tmpimage, $folder);

        if($password == $c_password){

        $secure_admin_password = password_hash($password, PASSWORD_BCRYPT); 
            $query="UPDATE admin SET admin_username='$name',  admin_email='$email',  admin_password='$secure_admin_password', image='$image' WHERE admin_uniqueid='$uniqueid'"; 
      $run=mysqli_query($con ,$query); 
      
        if($run)
        {
            $_SESSION['msg']='<b> Agent Info Update Success !! </b>';
            if(isset($_REQUEST['editpro'])){ header("location:profile.php"); } else { header("location:agent.php"); } 
           session_regenerate_id(true);
           exit();
        }
        else
        {
           echo $_SESSION['error']='<b> Error ! Agent Info Update Failed ! Try Again !! </b>';
        } 
    } else {
        $_SESSION['error']='<b> Password Not Match ! Try Carefully ! </b>';   
    }

    } else {
       
       
        if(!empty($name) && !empty($email) && !empty($password) && !empty($c_password)){ 
 
            if($password == $c_password){

                $secure_admin_password = password_hash($password, PASSWORD_BCRYPT); 
                    $query="UPDATE admin SET admin_username='$name',  admin_email='$email',  admin_password='$secure_admin_password' WHERE admin_uniqueid='$uniqueid'"; 
              $run=mysqli_query($con ,$query); 
              
                if($run)
                {
                    $_SESSION['msg']='<b> Agent Info Update Success !! </b>';
                    if(isset($_REQUEST['editpro'])){ header("location:profile.php"); } else { header("location:agent.php"); } 
                   session_regenerate_id(true);
                   exit();
                }
                else
                {
                   echo $_SESSION['error']='<b> Error ! Agent Info Update Failed ! Try Again !! </b>';
                } 
            } else {
                $_SESSION['error']='<b> Password Not Match ! Try Carefully ! </b>';   
            }


        } else {
         echo $_SESSION['error']='<b> Error ! All Field Required </b>'; 
        }

        
        }
    // header("location:details.php");

  
     
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
                <h2 class="breadcrumb-title"><?php if(isset($_REQUEST['editpro'])){ echo 'Edit Profile' ; } else { echo 'Edit Agent' ;} ?></h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <?php if(isset($_REQUEST['editpro'])){ ?> 
                        <li><a href="profile.php">Profile</a></li>
                        <?php } else { ?> 
                            <li><a href="agent.php">Agent</a></li>
                            <?php } ?>
                    
                    <li class="active">Edit Agent</li>
                </ul>
            </div>
        </div>

        <div class="search-area">
            <div class="container">
                <div class="search-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                  
                        <div class="booking-widget">
                       
    <?php include('alertmsg.php'); ?>

                            <h4 class="booking-widget-title">Contact Info <a href="<?php if(isset($_REQUEST['editpro'])){ echo 'profile' ; } else { echo 'agent' ;} ?>.php" class="theme-btn p-1 mb-3" style="font-size:10px; float:right;"> <i class="fas fa-long-arrow-left"></i> Back Page
                            </a></h4>
                            <div class="booking-form">
                                <form action="#" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?= $row['admin_username'] ?>">
                                                    <i class="far fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <div class="form-group-icon">
                                                    <input type="email" class="form-control"
                                                        placeholder="Email Address" name="email" value="<?= $row['admin_email'] ?>">
                                                    <i class="far fa-envelopes"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <div class="form-group-icon">
                                                    <input type="password" class="form-control"
                                                        placeholder="Enter Password" name="password">
                                                    <i class="far fa-lock"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <div class="form-group-icon">
                                                    <input type="password" class="form-control"
                                                        placeholder="Confirm Password" name="c_password">
                                                    <i class="far fa-lock"></i>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Profile Photo</label>
                                                <div class="form-group-icon">
                                                    <input type="file" class="form-control"
                                                        placeholder="Profile Photo" name="image">
                                                    <i class="far fa-image"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                                        <div class="form-group mt-2">
                                                            <button type="submit" class="theme-btn" name="contact_info">Update Now<i
                                                                    class="far fa-arrow-right"></i></button>
                                                        </div>
                                                    </div>
                                    </div>
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