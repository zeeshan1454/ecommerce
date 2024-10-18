<?php include("connection.php"); 
include("function.php"); 
if(!isset($_SESSION['admin_uniqueid']) && !isset($_SESSION['admin_username']))
{
     header("location:login.php");
}
$user_name = $_SESSION['admin_username'];
if(isset($_REQUEST['uniqid'])){
    $uniqid = $_REQUEST['uniqid'];
    $sel ="SELECT * FROM `book_ticket` WHERE `unique_id`='$uniqid'";
 } else {
    $sel ="SELECT * FROM `book_ticket` WHERE `agent_name`='$user_name' ORDER BY id DESC LIMIT 1";
 }
$runquery = mysqli_query($con,$sel);
 $row = mysqli_fetch_array($runquery);
 $uniqueid = $row['unique_id'];

if(isset($_POST['passenger_details'])){
    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $l_name = $_POST['l_name'];
    $name = $f_name. " " .$m_name. " " .$l_name;
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $add_on = $_POST['add_on'];
    $dob = $_POST['dob'];
    $no_passenger = $_POST['no_passenger'];
    $p_fair = $_POST['p_fair'];
    $mco = $_POST['mco'];
    $total = $_POST['total'];
  

    if(!empty($f_name) && !empty($email) && !empty($mobile) && !empty($gender) && !empty($dob) && !empty($no_passenger) && !empty($p_fair) && !empty($mco)){
    
        $query="UPDATE `book_ticket` SET `p_name`='$name',`p_email`='$email',`p_mobile`='$mobile',`p_gender`='$gender',`p_add_on`='$add_on',`p_dob`='$dob',`no_passenger`='$no_passenger',`p_fair`='$p_fair',`mco`='$mco',`total`='$total',`status`='3'  WHERE `unique_id`='$uniqueid'";  
        $run=mysqli_query($con ,$query); 
        
          if($run)
          {
              $_SESSION['msg']='<b> Passenger Info Added Success !! Please proceed To Payment. ! </b>';
               $last_id = mysqli_insert_id($con);
               if(isset($_REQUEST['uniqid'])){
                header("location:flight-booking.php?uniqid=$uniqueid");
             } else {
                header("location:flight-booking.php");
             }
           //  header("location:details.php?id=$last_id");
             session_regenerate_id(true);
             exit();
          }
          else
          {
             echo $_SESSION['error']='<b> Error ! Passenger Info Failed ! Try Again !! </b>';
          } 

        } else {
            $_SESSION['error']='<b> Error ! All Field Required </b>';  
           }
   
} elseif(isset($_POST['cancel'])){
    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $l_name = $_POST['l_name'];
    $name = $f_name. " " .$m_name. " " .$l_name;
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $add_on = $_POST['add_on'];
    $dob = $_POST['dob'];
    $no_passenger = $_POST['no_passenger'];
    $p_fair = $_POST['p_fair'];
    $mco = $_POST['mco'];
    $total = $_POST['total'];
    $query="UPDATE `book_ticket` SET `p_name`='$name',`p_email`='$email',`p_mobile`='$mobile',`p_gender`='$gender',`p_add_on`='$add_on',`p_dob`='$dob',`no_passenger`='$no_passenger',`p_fair`='$p_fair',`mco`='$mco',`total`='$total',`status`='4'  WHERE `unique_id`='$uniqueid'";  

    $run=mysqli_query($con ,$query); 
    
      if($run)
      {
        $_SESSION['msg']='<b> Canceled Your Ticket !! Please proceed New Ticket . ! </b>';
            header("location:index.php");
         session_regenerate_id(true);
         exit();
      }
      else
      {
         echo $_SESSION['error']='<b> Error ! Passenger Info Failed ! Try Again !! </b>';
      } 
} elseif(isset($_POST['exchange'])){

    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $l_name = $_POST['l_name'];
    $name = $f_name. " " .$m_name. " " .$l_name;
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $add_on = $_POST['add_on'];
    $dob = $_POST['dob'];
    $no_passenger = $_POST['no_passenger'];
    $p_fair = $_POST['p_fair'];
    $mco = $_POST['mco'];
    $total = $_POST['total'];
    $query="UPDATE `book_ticket` SET `p_name`='$name',`p_email`='$email',`p_mobile`='$mobile',`p_gender`='$gender',`p_add_on`='$add_on',`p_dob`='$dob',`no_passenger`='$no_passenger',`p_fair`='$p_fair',`mco`='$mco',`total`='$total'  WHERE `unique_id`='$uniqueid'";  

    $run=mysqli_query($con ,$query); 
    
    if($run)
    {
        $_SESSION['msg']='<b> Exchange Your Ticket !! Please proceed . ! </b>';
        header("location:details.php?uniqid=$uniqueid");
        session_regenerate_id(true);
        exit();
    }
    else
    {
       echo $_SESSION['error']='<b> Error ! Exchange Your Ticket Failed ! Try Again !! </b>';
    } 
   
}

//  add_on
//  dob
//  no_passenger
//  p_fair
//  mco
//  total
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from live.themewild.com/mytrip/flight-booking.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:16:41 GMT -->

<head>

<?php include("headerlink.php"); ?>
</head>

<body>

   

    <?php include("header.php"); ?>
    </header>

    <main class="main">

        <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Price Section</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index-2.html">Home</a></li>
                    <li class="active">Price Section</li>
                </ul>
            </div>
        </div>

        <div class="search-area">
            <div class="container">
                <div class="search-wrapper row">
                    <div class="col-lg-12">
                        <div class="booking-widget">
                        <a href="details.php?uniqid=<?= $uniqueid ?>" class="theme-btn p-2" style="font-size:10px;"> <i class="fas fa-long-arrow-left"></i> Back Page
                            </a>
                        <?php include('alertmsg.php'); ?>
                            <h4 class="booking-widget-title">Passenger Info</h4>
                            <div class="booking-form">
                                <form action="#" method="post">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" name="f_name" placeholder="First Name" value="<?= $row['c_name']?>" required>
                                                    <i class="far fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" name="m_name" placeholder="Middle Name">
                                                    <i class="far fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" placeholder="Last Name" name="l_name">
                                                    <i class="far fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <div class="form-group-icon">
                                                    <input type="email" class="form-control"
                                                        placeholder="Email Address" value="<?= $row['p_email']?>" name="email" required>
                                                    <i class="far fa-envelopes"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" placeholder="Phone Number" value="<?= $row['c_mobile']?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="12" name="mobile" required>
                                                    <i class="far fa-phone"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <div class="form-group-icon mt-2">
                                                    <?php
                                                     if(isset($uniqid)){
                                                        ?>
                                                       <input type="radio" <?php if($row['p_gender'] == 'Male'){ echo "checked" ; } ?>  class="mx-2" name="gender" placeholder="Age" value="Male"> Male
                                                         <input type="radio" class="mx-2" name="gender" placeholder="Age" valye="Female" <?php if($row['p_gender'] == 'Female'){ echo "checked"; } ?>> Female
                                                         <input type="radio" class="mx-2" name="gender" placeholder="Age" value="Other" <?php if($row['p_gender'] == 'Other'){ echo "checked"; } ?>> Other
                                                        <?php
                                                     } else {
                                                        ?>
                                                    <input type="radio"  checked class="mx-2" name="gender" placeholder="Age" value="Male">  Male
                                                <input type="radio" class="mx-2" name="gender" placeholder="Age" value="Female"> Female
                                                <input type="radio" class="mx-2" name="gender" placeholder="Age" value="Other"> Other
                                                        <?php
                                                     }
                                                    ?>
                                              
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <div class="form-group-icon">
                                                    <select class="select">
                                                        <option value>Select Gender</option>
                                                        <option value="1">Mail</option>
                                                        <option value="2">Femail</option>
                                                    </select>
                                                    <i class="far fa-user"></i>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Add On</label>
                                                <div class="form-group-icon">

                                                <?php
                                                     if(isset($uniqid)){
                                                        ?>
                                                       <select class="select" id="add_on" name="add_on">
                                                        
                                                        <option value="">Select Item</option>

                                                        <option value="1"
                                                         <?php 
                                                          if($row['p_add_on'] == '1'){
                                                            echo "selected";
                                                          }
                                                         ?>
                                                        >Pet Adding</option>
                                                        <option value="2" 
                                                        <?php 
                                                          if($row['p_add_on'] == '2'){
                                                            echo "selected";
                                                          }
                                                         ?>
                                                        >Wheel chair</option>
                                                        <option value="3"
                                                        <?php 
                                                          if($row['p_add_on'] == '3'){
                                                            echo "selected";
                                                          }
                                                         ?>
                                                        >Conciliation</option>
                                                        <option value="4"
                                                        <?php 
                                                          if($row['p_add_on'] == '4'){
                                                            echo "selected";
                                                          }
                                                         ?>
                                                        >Baggage</option>
                                                        <option value="5" 
                                                        <?php 
                                                          if($row['p_add_on'] == '5'){
                                                            echo "selected";
                                                          }
                                                         ?>
                                                        >Other</option>
                                                    </select>
                                                        <?php
                                                     } else {
                                                        ?>
                                                    <select class="select" id="add_on" name="add_on">
                                                        
                                                        <option value="">Select Item</option>

                                                        <option value="1"
                                                         <?php 
                                                          if($row['c_add_on'] == '1'){
                                                            echo "selected";
                                                          }
                                                         ?>
                                                        >Pet Adding</option>
                                                        <option value="2" 
                                                        <?php 
                                                          if($row['c_add_on'] == '2'){
                                                            echo "selected";
                                                          }
                                                         ?>
                                                        >Wheel chair</option>
                                                        <option value="3"
                                                        <?php 
                                                          if($row['c_add_on'] == '3'){
                                                            echo "selected";
                                                          }
                                                         ?>
                                                        >Conciliation</option>
                                                        <option value="4"
                                                        <?php 
                                                          if($row['c_add_on'] == '4'){
                                                            echo "selected";
                                                          }
                                                         ?>
                                                        >Baggage</option>
                                                        <option value="5" 
                                                        <?php 
                                                          if($row['c_add_on'] == '5'){
                                                            echo "selected";
                                                          }
                                                         ?>
                                                        >Other</option>
                                                    </select>
                                                        <?php
                                                     }
                                                    ?>
                                                   
                                                    <i class="far fa-globe"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Date Of Birth</label>
                                                <div class="form-group-icon">
                                                    <input type="date" class="form-control" name="dob" placeholder="Age" required value="<?= $row['p_dob'] ?>">
                                                    <i class="fab fa-pagelines"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Number Of Passenger</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" placeholder="Number Of Passenger" value="<?= $row['adult'] + $row['children'] ?>" id="no_pas" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="12" required name="no_passenger">
                                                    <i class="far fa-user-tie"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Publisher Fair</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" placeholder="Publisher Fair" id="fair" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="12" required name="p_fair" value="<?= $row['p_fair'] ?>">
                                                    <i class="fa-solid fa-dollar-sign"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Miscellaneous Charges Order</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" placeholder="Miscellaneous Charges Order" id="mco" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="12" name="mco" value="<?= $row['mco'] ?>">
                                                    <i class="fa-solid fa-dollar-sign"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Total Amount</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" placeholder="Total Amount" id="total_doller" readonly name="total" value="<?= $row['total'] ?>">
                                                    <i class="fa-solid fa-dollar-sign"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                                        <div class="form-group mt-2 d-flex">
                                                            <button type="submit" name="passenger_details" class="theme-btn ml-auto">Booking Now<i
                                                                    class="far fa-arrow-right"></i></button>
                                                            <button type="submit" name="exchange" class="btn btn-success mx-auto ">Exchange <i
                                                                    class="far fa-arrow-right"></i></button>
                                                            <button type="submit" name="cancel" class="btn btn-danger mr-auto">Cancellation <i
                                                                    class="far fa-arrow-right"></i></button>
                                                        </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
               
                </div>
            </div>
        </div>

    </main>

    <footer class="footer-area">
    <?php include("footer.php"); ?>
    </footer>


    <?php include("footerlink.php"); ?>
    
</body>
<script>
  $(document).ready(function(){
     $("#fair , #mco ,#no_pas ,#add_on").on('keyup change', function(){
        var no_pas = parseInt($("#no_pas").val());
var qval = parseFloat($("#fair").val());
var mco = parseFloat($("#mco").val());
var add_on = parseFloat($("#add_on").val());

var add_on_new = isNaN(add_on) ? 0 : (add_on == 1 ? 25 : (add_on == 2 ? 50 : add_on == 3 ? 75 : add_on == 4 ? 100 : add_on == 5 ? 120 : 0));
var total = (qval * no_pas) + mco + add_on_new;
var ttotal = isNaN(total) ? (qval * no_pas) + add_on_new : total;
   $("#total_doller").val(ttotal);
     });
  });
</script>
<!-- Mirrored from live.themewild.com/mytrip/flight-booking.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:16:43 GMT -->

</html>