<?php
session_start();
$localhost="localhost";
$user="root";
$pwd="";//vicidialnow
$database="ecommerce";//asterisk
	$con = mysqli_connect($localhost, $user, $pwd) or die(mysqli_error());
	mysqli_select_db($con,$database) or die(mysqli_error());
?>