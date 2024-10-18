<?php 

include("connection.php"); 
include("function.php");
if(isset($_SESSION['admin_uniqueid']) && isset($_SESSION['admin_username']))
{
     header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from live.themewild.com/mytrip/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:28 GMT -->

<head>

<?php include("headerlink.php"); ?>
</head>

<body>

    
    <?php include("header.php"); ?>
    </header>

    <main class="main">

        <!-- <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/02.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Login</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index-2.html">Home</a></li>
                    <li class="active">Login</li>
                </ul>
            </div>
        </div> -->

        <div class="login-area py-120 mt-5">
            <div class="container">
                <div class="col-md-5 mx-auto">
                    <div class="login-form">
                        <div class="login-header">
                            <img src="../img/core-img/rizwanlogo.png" alt>
                            <h3 class="text-center">Admin Dashboard</h3>
                            <!-- <p>Login with your Acount</p> -->
                        </div>
                        <?php include('alertmsg.php'); ?>
                                    <form action="valid-login.php" method="post" class="needs-validation" novalidate>
                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="form-group-icon">
                                    <input type="email" class="form-control" placeholder="Your Email" name="user_email" required>
                                    <i class="far fa-envelope"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="form-group-icon">
                                    <input type="password" class="form-control" placeholder="Your Password" name="user_password" required>
                                    <i class="far fa-lock"></i>
                                </div>
                            </div>
                            <input type="hidden" name="token" value="<?= login_token(); ?>">
                            <div class="d-flex justify-content-between mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value id="remember">
                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                                <a href="forgot-password.php" class="forgot-pass">Forgot Password?</a>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" name="submit" class="theme-btn"><i class="far fa-sign-in"></i> Login</button>
                            </div>
                        </form>
                        <!-- <div class="login-footer">
                            <div class="login-divider"><span>Or</span></div>
                            <div class="social-login">
                                <a href="#" class="btn-fb"><i class="fab fa-facebook"></i> Login With Facebook</a>
                                <a href="#" class="btn-gl"><i class="fab fa-google"></i> Login With Google</a>
                            </div>
                            <p>Don't have an account? <a href="register.html">Sign Up.</a></p>
                        </div> -->
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

<!-- Mirrored from live.themewild.com/mytrip/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:28 GMT -->

</html>