<?php
include("connection.php"); 
include("function.php"); 
$uniquid = $_REQUEST['uniqid'];

$query="DELETE FROM book_ticket WHERE `unique_id`='$uniquid'"; 
      $run=mysqli_query($con ,$query); 
      
        if($run)
        {
            $_SESSION['msg']='<b> Product Delete Success. !! </b>';
                header("location:index.php");
           session_regenerate_id(true);
           exit();
        }
        else
        {
           echo $_SESSION['error']='<b> Error ! Product Delete Failed ! Try Again !! </b>';
        } 

?>