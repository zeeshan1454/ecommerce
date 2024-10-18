<?php

$uniq_id = $_POST["id"];
$qtyval = $_POST["val"];

require("connection.php");

$sql = "UPDATE `book_ticket` SET `quantity`='$qtyval' WHERE `unique_id`='$uniq_id'";

if(mysqli_query($con, $sql)){
  echo 1;
}else{
  echo 0;
}


?>