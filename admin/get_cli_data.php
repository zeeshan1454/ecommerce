<?php
include("connection.php"); 
include("function.php"); 
$id=$_POST['id'];


$m_query = "SELECT * FROM `user` WHERE id='$id'";
$run = mysqli_query($con,$m_query);
$alldata=array();
while($row=mysqli_fetch_array($run)){

    array_push($alldata,$row);
}

echo json_encode($alldata);

?>