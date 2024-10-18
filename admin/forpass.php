
<?php include("connection.php"); 
include("function.php");

$uniqueid = $_REQUEST['uniqueid'];

if(isset($_POST['signup'])){
    
   
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    if(!empty($uniqueid) && !empty($password) && !empty($c_password)){
      if($password == $c_password){
        $secure_admin_password = password_hash($password, PASSWORD_BCRYPT); 
        date_default_timezone_set("Asia/Kolkata");
        $date= date("Y-m-d"); 
        
        $update = "UPDATE `admin` SET `admin_password`='$secure_admin_password' WHERE `admin_uniqueid`='$uniqueid'";
        $update_run = mysqli_query($con, $update);
        if($update_run)
        {
              $_SESSION['msg']='<b> Login With New Password !! </b>';
              header("location:login.php");
              session_regenerate_id(true);
              exit();
        }
        else
        {
             $_SESSION['error']='<b> Agent Password Failed ! Try Carefully ! </b>';
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

       
     

        <div class="login-area py-120">
            <div class="container">
                <div class="col-md-5 mx-auto">
                    <div class="login-form">
                        <div class="login-header">
                        <h2 class="text-center">Agent Dashboard</h2>
                            <p>Create Agent Password</p>
                        </div>
                        
                        <?php include('alertmsg.php'); ?>
                        <form action="" method="post">
                            
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