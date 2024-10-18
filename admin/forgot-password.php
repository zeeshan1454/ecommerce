<?php include("connection.php"); 
include("function.php");
 if(isset($_POST['sendemail'])){
    
    function ticketId($length = 5) {
        $chars = '0123456789';
        $count = strlen($chars);
        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= substr($chars, $index, 1);
        }
        return $result;
    }
    $email = $_POST['email'];
    $otp = ticketId();
    $_SESSION['newotp'] = $otp;

    $real_estate = "SELECT * FROM admin WHERE admin_email='$email'";
    $real_estate_run=mysqli_query($con, $real_estate);
    if(mysqli_num_rows($real_estate_run) > 0){
        $row = mysqli_fetch_array($real_estate_run);
         $uniqid = $row['admin_uniqueid'];
          
         $style = "
         <style>
         body {
             font-family: Arial, sans-serif;
             line-height: 1.6;
             margin: 0;
             padding: 0;
             background-color: #f4f4f4;
         }
     
         #containermail {
             max-width: 600px;
             margin: auto;
             padding: 20px;
             background-color: #EEEEEE;
             border-radius: 10px;
             box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
             margin-top: 30px;
         }
     
         .header {
             text-align: center;
             padding: 20px;
             background-color: #51b175;
             border-top-left-radius: 10px;
             border-top-right-radius: 10px;
         }
     
         .header img {
             max-width: 200px;
         }
     
         h1,
         h2,
         p {
             margin-bottom: 20px;
         }
     
         a {
             color: #007bff;
             text-decoration: none;
         }
     
         .contact-info {
             margin-top: 20px;
         }
     
         .contact-info p {
             margin: 10px;
         }
         span{
             background-color: #fff;
         }
     
         .footer {
             background-color: #51b175;
             color: #fff;
             text-align: center;
             padding: 10px;
             border-bottom-left-radius: 10px;
             border-bottom-right-radius: 10px;
         }
         .span {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #04de58;
            font-size: 40px;
            font-weight: bold;
            
           
        }
        span {
                   
                   align-items: center;
                   justify-content: center;
                   background-color: #04de58;
                  
               }
        
     
         </style>
     ";
         $comment = "<head> 
         $style
       </head>
         <body>
         <div id='containermail'>
         <div class='header'>
         <img src='https://next2call.com/winet_ticket/assets/img/shariqlogo.png' alt=\"Shariq Logo\">
             <h1 style='color: #fff;'>Shariq Grocery Shop Password Reset OTP</h1>
         </div>
         <h2>Password Reset OTP</h2>
         <p>Dear User,</p>
         <p>Please use the following OTP to reset your password:</p>
         <div class='span'><span>$otp</span></div>

     <!-- Add more content here -->

     <div class='contact-info'>
         <p>Best Regards</p>
         <p><a href='tel:6395630844'>+91 6395630844</a></p>
         <p><a href='https://nov-i.com/' style='color: #007bff;'>2023 Shariq Grocery Shop</a></p>
         <p></p>
         <p><a href='mailto:mohdzeeshan1454@gmail.com' style='color: #007bff;'>mohdzeeshan1454@gmail.com</a></p>
     </div>
     <div class='footer'>
         &copy; 2023 Shariq Grocery Shop
     </div>
</body>";
$encodedComment = urlencode($comment);
echo "<script>window.location.href = 'test.php?email=$email&subject=Shariq Grocery Store Reset Acount OTP.&comment=$encodedComment&title=Send OTP Successful&text=Your data has been Send successfully&uniqid=$uniqid';</script>";
       

    } else {
        $_SESSION['error']='<b>Error ! Email Not Exist ! Failed ! Try Again!</b>';   
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

        <!-- <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/02.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Forgot Password</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Forgot Password</li>
                </ul>
            </div>
        </div> -->

        <div class="login-area py-120">
            <div class="container">
                <div class="col-md-5 mx-auto">
                    <div class="login-form">
                        <div class="login-header">
                            <img src="assets/img/logo/logo-dark.png" alt>
                            <p>Reset your account password</p>
                        </div>
                        <?php include('alertmsg.php'); ?>
                        <form action="#" method='post'>
                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="form-group-icon">
                                    <input type="email" class="form-control" name='email' placeholder="Your Email" required>
                                    <i class="far fa-envelope"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <div class="form-check">
                                    <!-- <input class="form-check-input" type="checkbox" value id="remember">
                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label> -->
                                </div>
                                <a href="login.php" class="forgot-pass">Log In</a>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="theme-btn" name="sendemail"><i class="far fa-key"></i> Send Reset
                                    Link</button>
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

<!-- Mirrored from live.themewild.com/mytrip/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:17:28 GMT -->

</html>