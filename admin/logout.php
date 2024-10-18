<?php
session_start();
$session_id=$_SESSION['admin_uniqueid'];
$session_user=$_SESSION['admin_username'];
// session_unset($_SESSION['admin_username']);
if(isset($session_id) && isset($session_user)){
    session_destroy();
    header("location:login.php?error=<b>Logout Success !! Visit Again !! <b>");
}

?>