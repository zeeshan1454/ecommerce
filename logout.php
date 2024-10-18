<?php
ob_start();
error_reporting(0);
include('opendb.php');
session_start();
if(isset($_SESSION['mobile']))
{
    $mobile=$_SESSION['mobile'];
    session_destroy();
    header("Location: login.php");



}


?>