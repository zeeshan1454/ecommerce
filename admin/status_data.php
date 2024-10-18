<?php
include("connection.php"); 
$uniqueid=$_POST['id'];
$sql="SELECT status FROM `book_ticket` WHERE `unique_id`='$uniqueid'";
$res=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($res);
echo $row['status'];

?>