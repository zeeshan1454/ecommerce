<?php
ob_start();
session_start();
$localhost="localhost";
$user="root";
$pwd="";
$database="ecommerce";
	$con = mysqli_connect($localhost, $user, $pwd) or die(mysqli_error());
	mysqli_select_db($con,$database) or die(mysqli_error());
  
  if(isset($_POST['mobile'])){
    $mobile=$_POST['mobile'];
  }

  if(isset($_POST['ssubmit'])){
  
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
    $status = "Wrong mobile number !";
  }

  }


?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored by HTTrack Website Copier/3.x [XR/YP'2000] -->

<head>
   <!-- ------------------include headerlink---------------------------------  -->

<?php include('headerlink.php') ?>

<!-- ------------------include headerlink---------------------------------  -->

</head>
<!-- ------------------include headerlink---------------------------------  -->



<!-- ------------------include headerlink---------------------------------  -->

<body>
    <section class="">
    <div class="container-fluat mt-5">
    <div class="row">
      <div class="col-sm-3"></div>  
      <div class="col-sm-6 mt-5 mb-5 mx-2">
        <div class="card">
          <form action="" method="post">
          <div class="card-header bg-secondary">
            <h4 class="text-center">
              Login
            </h4>
            <h6 class="text-center">
              SHARIQ KIRANA STORE
            </h6>

          </div>
          <div class="card-body">
           <?php if(isset($status)){ ?>
            <div class="alert alert-danger" role="alert">
                <?= $status ?>
            </div>
            <?php } ?>            

            <input type="text" name="mobile" class="form-control" id="" placeholder="Enter mobile No." required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10"><br>
            <!-- <input type="text" name="password" class="form-control" id="" placeholder="Enter Password" required> -->
          </div>
          <div class="card-footer text-center">
            <button type="submit" class="btn btn-danger" name="ssubmit" >Submit</button>
          </div>
         </form>
        </div>
      </div>
      <div class="col-sm-3"></div>
    </div>
  </div>
 
   </section>

        <!-- ---------------------------------------- include footer section ----------------------------------- -->

        <?php include('footer.php') ?>

<!-- ---------------------------------------- include footer section ----------------------------------- -->



<!-- ---------------------------------------- include footer_link ----------------------------------- -->

<?php include('footerlink.php') ?>

<!-- ---------------------------------------- include footer_link ----------------------------------- -->


</body>

<!-- Mirrored by HTTrack Website Copier/3.x [XR/YP'2000] -->

</html>