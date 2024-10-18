
<?php
ob_start();
session_start();
require("connection.php");
  
  if(isset($_POST['mobile'])){
    $mobile=$_POST['mobile'];
  }

  if(isset($_POST['ssubmit'])){
    if(strlen($mobile) >= 10 ){
   
    // $sql="SELECT * FROM `login_tbl` WHERE username='$username' AND password='$password'";  
    $sql="SELECT * FROM `user` WHERE mobile='$mobile'";  
    $query = mysqli_query($con,$sql);
    $row=mysqli_fetch_array($query);
    $count = mysqli_num_rows($query);
    if ($count == 1)
	 {
    $_SESSION['mobile']=$mobile;
       header("Location:index.php");
  }else{
    $sqla="SELECT * FROM `admin` WHERE admin_status=1 ";  
    $querya = mysqli_query($con,$sqla);
    $rowa=mysqli_fetch_array($querya);
    $agent_name = $rowa['admin_username'];

    $unique_id=uniqid();
    date_default_timezone_set("Asia/Kolkata");
    $date_time= date("Y-M-d h:i:s");  

    $queryi="INSERT INTO `user`(`unique_id`, `agent_name`, `mobile`, `status`, `date`) VALUES ('$unique_id','$agent_name','$mobile','0','$date_time')"; 
      $runi=mysqli_query($con ,$queryi);
    
      if($runi){
        $_SESSION['mobile']=$mobile;
        header("Location:index.php");
      } else {
       $status = "Error !! Wrong mobile number !";
      }
    
    
  }

}else {
    $status = "Error !! Invalid mobile number !";    
}

  }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rizwan Drinks Wholseller</title>

    <link rel="icon" href="img/core-img/fav_icon.png">
  
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            padding: 10px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .header {
            text-align: center;
            padding: 5px;
            background-color: #14CFBE;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .header img {
            max-width: 200px;

        }

        .content {
            padding: 20px;
        }

        .content h2 {
            color: #333333;
            text-align: center;
        }

        .otp-container {
            background-color: #EEEEEE;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .otp-input {
            width: 96%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .otp-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #14CFBE;
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            cursor: pointer;
            border:2px solid;

            
        }
        .otp-button:hover {
  background-color: #6AB2AD;
  
}


        .footer {
            background-color: #14CFBE;
            color: #fff;
            text-align: center;
            padding: 10px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .custom-alert {
            padding: 15px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            border-radius: 4px;
            margin-bottom: 15px;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="header">
            <img src="img/core-img/rizwanlogo.png"  alt="Rizwan Logo">
            <h1 style='color: #fff; margin-top:-3px;'>Log In</h1>
            <h3 style='color: #fff;'>Rizwan Wholseller</h3>
        </div>
        <div class="content">
            <h2>Log In With Phone Number</h2>
            
            <div class="otp-container">
                <form action="" method="post">
                <?php if(isset($status)){ ?>
            <div class="custom-alert" role="alert">
                <?= $status ?>
            </div>
            <?php } ?>            
                <input type="text" class="otp-input" name="mobile" placeholder="Enter Your Phone Number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10">
                <button type="submit" name="ssubmit" class="otp-button" >Log In</button>
            </form>
            </div>
        </div>
        <div class='footer'>
            &copy; 2023 Rizwan Wholseller
        </div>
    </div>
</body>

</html>
