<?php include("connection.php"); 

if(isset($_POST['signup'])){
    
    $mobile = $_POST['mobile'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    if(!empty($name) && !empty($email) && !empty($password) && !empty($c_password) && !empty($mobile) ){
      if($password == $c_password){
        $secure_admin_password = password_hash($password, PASSWORD_BCRYPT); 
        $uniqueid = uniqid();
        date_default_timezone_set("Asia/Kolkata");
        $date= date("Y-m-d"); 
        
        $update = "INSERT INTO `admin`(`admin_uniqueid`, `admin_email`, `admin_mobile`, `admin_password`, `admin_username`, `admin_status`) VALUES ('$uniqueid','$email','$mobile','$secure_admin_password','$name','0')";
        $update_run = mysqli_query($con, $update);
        if($update_run)
        {
              $_SESSION['msg']='<b> Agent Add Success !  </b>';
              header("location:agent.php");
        }
        else
        {
             $_SESSION['error']='<b> Agent Add  Failed ! Try Carefully ! </b>';
        }

      } else {
        $_SESSION['error']='<b> Password Not Match ! Try Carefully ! </b>';
      }
    } else {
        echo $_SESSION['error']='<b> Error ! All Field Required ! </b>';
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from live.themewild.com/mytrip/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:28 GMT -->

<head>

<?php include("headerlink.php"); ?>
</head>

<body>

  

    <?php include("header.php"); ?>
    </header>

    <main class="main">

        <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/02.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Add New Agent</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="agent.php">All Agent</a></li>
                    <li class="active">Add New Agent</li>
                </ul>
            </div>
        </div>

        <div class="search-area">
            <div class="container">
                <div class="search-wrapper col-md-5 mx-auto mb-5">
                    <div class="login-form">
                    <a href="agent.php" class="theme-btn p-1 mb-3" style="font-size:10px; float:right;"> <i class="fas fa-long-arrow-left"></i> Back Page
                            </a>
                        <div class="login-header">
                        <h2 class="text-center">Agent Dashboard</h2>
                            <p>Create Agent Account</p>
                        </div>
                        
                        <?php include('alertmsg.php'); ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Full Name</label>
                                <div class="form-group-icon">
                                    <input type="text" class="form-control" placeholder="Your Name" name="name" required>
                                    <i class="far fa-user"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="form-group-icon">
                                    <input type="email" class="form-control" placeholder="Your Email" name="email" required>
                                    <i class="far fa-envelope"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <div class="form-group-icon">
                                    <input type="text" class="form-control" placeholder="Your Phone Mumber" name="mobile" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="12" required>
                                    <i class="far fa-phone"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="form-group-icon">
                                    <input type="password" class="form-control" placeholder="Your Password" name="password" required>
                                    <i class="far fa-lock"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <div class="form-group-icon">
                                    <input type="password" class="form-control" placeholder="Confirm Password" name="c_password" required>
                                    <i class="far fa-lock"></i>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <button type="submit" class="theme-btn" name="signup"><i class="far fa-paper-plane"></i> Sign
                                    Up</button>
                            </div>
                        </form>
                        
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

<!-- Mirrored from live.themewild.com/mytrip/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:28 GMT -->

</html>