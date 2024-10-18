<?php
session_start();
include("connection.php"); 
include("function.php");
if(isset($_POST['submit']))
{
	if (empty($_POST['user_email']) || empty($_POST['user_password']))
    {
        $_SESSION['error']='<b> All Field Required !! Try Again </b>';
		header('location:login.php');
        exit();
	}
	else
	{
		$email = mysqli_real_escape_string($con, test_input($_POST['user_email'])); 
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
         {
          $_SESSION['error']='<b> Error ! Invalid Email </b>';
          header('location:login.php');
          exit();
         }
         if($_POST['token'] != $_SESSION['token'])
         {
         $_SESSION['error'] = '<b> Error ! Incorrect Token ! Please Try Again </b>';
         header('location:login.php');
         exit();
         }

		$password = mysqli_real_escape_string($con, test_input($_POST['user_password']));
        $real_estate = "SELECT * FROM admin WHERE admin_email='$email'";
		$real_estate_run=mysqli_query($con, $real_estate);
        $rows = mysqli_num_rows($real_estate_run);
		if($rows==1)
		{
			$go = mysqli_fetch_assoc($real_estate_run);
            $secure_password = $go['admin_password'];
            $check_password = password_verify($password, $secure_password);
            if($check_password)
            {
                 while($go)
                 {	
				        $_SESSION['admin_uniqueid'] = $go['admin_uniqueid'];
                        $_SESSION['admin_username'] = $go['admin_username'];
				        $_SESSION['msg']='<b> Welcome ! Mr. ' .$_SESSION['admin_username']. ' !! </b>';
				        header('location:index.php');
                        session_regenerate_id(true);
                        exit();
                   
			     }
            }
            else
            {
                $_SESSION['error']='<b>Error ! Password not match ! Failed ! Try Again!</b>';
                header('location:login.php');
                exit();
            }
		}
		else 
        {
		     $_SESSION['error']='<b> Error ! Email not match ! Login Failed ! Try Again ! </b>';
             header('location:login.php');
             exit();
		}
	}
}
else
{
     $_SESSION['error']='<b> Error ! Login Failed ! Try Again ! </b>';
	 header('location:login.php');
     exit();
}
mysqli_error($con);
?>