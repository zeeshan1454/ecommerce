<?php

include("connection.php"); 
include("function.php");
if(isset($_POST['varifyotp'])){
    $newotp = $_SESSION['newotp'];
    $otp = $_POST['otp'];
     $uniqueid = $_REQUEST['uniqueid'];
    
    if($otp === $newotp){
        $_SESSION['msg']='<b> Create New Password ! Proceed Next </b>';
      header('location:forpass.php?uniqueid=' . $uniqueid . '');
      session_regenerate_id(true);
      exit();
    } else {

        $_SESSION['error']='<b> Error ! OTP not match ! Failed ! Try Again!</b>';
       
    }
   

}
 
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from live.themewild.com/mytrip/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:28 GMT -->

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
                            <img src="assets/img/logo/logo-dark.png" alt>
                            <p>Reset your account password</p>
                        </div>
                        <?php include('alertmsg.php'); ?>
                        <form action="forgot-password.php" method='post' id='submitform'>
                            <div class="form-group">
                                <label>OTP Varification</label>
                                <div class="form-group-icon">
                                    <input type="number" class="form-control" id='otpnew' name='otp' placeholder="Enter Your OTP" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="6">
                                    <i class="far fa-envelope"></i>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="theme-btn" name="varifyotp" id='submitbtn'><i class="far fa-key"></i> Resnd OTP</button>
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

<script>
$(document).ready(function () {
    $("#otpnew").on('input', function(){
        if ($(this).val().length == 5) {
            $("#submitbtn").text('Submit').attr('value', 'Submit');
            $("#submitform").attr('action', '#');
        }
    });
});


	</script>

</html>