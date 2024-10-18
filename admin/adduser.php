<?php include("connection.php"); 
include("function.php"); 
if(!isset($_SESSION['admin_uniqueid']) && !isset($_SESSION['admin_username']))
{
     header("location:login.php");
}

$agent_name = $_SESSION['admin_username'];
if(isset($_POST['contact_info'])){
   
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $mobile2 = $_POST['mobile2'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $unique_id=uniqid();
    date_default_timezone_set("Asia/Kolkata");
    $date_time= date("Y-M-d h:i:s");  
    
    if(!empty($name) && !empty($mobile) && !empty($agent_name)){
         
    
            $query="INSERT INTO `user`(`unique_id`, `user_name`, `agent_name`, `user_email`, `mobile`, `status`, `date`, `mobile2`, `dob`, `address`) VALUES ('$unique_id','$name','$agent_name','$email','$mobile','0','$date_time','$mobile2','$dob','$address')"; 
      $run=mysqli_query($con ,$query); 
      
        if($run)
        {
            $_SESSION['msg']='<b> User Info Add Success !! </b>';
                header("location:user.php");
           session_regenerate_id(true);
           exit();
        }
        else
        {
           echo $_SESSION['error']='<b> Error ! User Info Add Failed ! Try Again !! </b>';
        } 
   

    } else {
           echo $_SESSION['error']='<b> Error ! All Field Required </b>'; 
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
                <h2 class="breadcrumb-title">Add User</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="admin.php">Home</a></li>
                    <li><a href="user.php">User</a></li>
                    <li class="active">Add User</li>
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

                            <h4 class="booking-widget-title">User Info <a href="user.php" class="theme-btn p-1 mb-3" style="font-size:10px; float:right;"> <i class="fas fa-long-arrow-left"></i> Back Page
                            </a></h4>
                            <div class="booking-form">
                                <form action="#" method="post">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                                                    <i class="far fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Phone Number" name="mobile" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="12" required>
                                                    <i class="far fa-phone"></i>
                                                </div>
                                            </div>
                                        </div>    
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Alternate Phone Number</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Alternate Phone Number" name="mobile2" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="12">
                                                    <i class="far fa-phone"></i>
                                                </div>
                                            </div>
                                        </div>    
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <div class="form-group-icon">
                                                    <input type="email" class="form-control"
                                                        placeholder="Email Address" name="email">
                                                    <i class="far fa-envelopes"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Date Of Birth</label>
                                                <div class="form-group-icon">
                                                    <input type="date" class="form-control"
                                                        placeholder="Enter Date Of Birt" name="dob">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Address" name="address">
                                                    <i class="fab fa-pagelines"></i>
                                                </div>
                                            </div>
                                        </div>
                                           
                                        <div class="col-lg-6">
                                                        <div class="form-group mt-2">
                                                            <button type="submit" class="theme-btn" name="contact_info">Save<i
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