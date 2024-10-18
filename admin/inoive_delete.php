<?php
include("connection.php"); 
include("function.php"); 
$uniquid = $_REQUEST['uniqid'];

$query="DELETE FROM invoice_tbl WHERE `unique_id`='$uniquid'"; 
      $run=mysqli_query($con ,$query); 
      
        if($run)
        {
            $_SESSION['msg']='<b> Invoice Delete Success. !! </b>';
                header("location:all_invoice.php");
           session_regenerate_id(true);
           exit();
        }
        else
        {
           echo $_SESSION['error']='<b> Error ! Invoice Delete Failed ! Try Again !! </b>';
        } 

?>