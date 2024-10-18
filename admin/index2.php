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

 if(isset($_POST['search_flight'])){
    $way = $_POST['flight-type'];
    $from_destination = $_POST['from_destination'];
    $to_destination = $_POST['to_destination'];
    $j_date = $_POST['j_date'];
    $adult = $_POST['adult'];
    $children = $_POST['children'];
    $infant = $_POST['infant'];
    $class = $_POST['class'];
    $r_date = $_POST['r_date'];
   
    if($way == 'one-way'){
    
    if(!empty($from_destination) && !empty($to_destination) && !empty($j_date) && !empty($adult) && !empty($class)){
    
        $query="UPDATE `book_ticket` SET `way_type`='$way',`f_location`='$from_destination',`t_location`='$to_destination',`j_date`='$j_date',`adult`='$adult',`children`='$children',`infant`='$infant',`class`='$class' WHERE `unique_id`='$uniqueid'";  
        $run=mysqli_query($con ,$query); 
        
          if($run)
          {
              $_SESSION['msg']='<b> Ticket Info Added Success !! Please proceed. ! </b>';
               $last_id = mysqli_insert_id($con);
               if(isset($_REQUEST['uniqid'])){
                header("location:price_section.php?uniqid=$uniqueid");
             } else {
                header("location:price_section.php");
             }
           //  header("location:details.php?id=$last_id");
             session_regenerate_id(true);
             exit();
          }
          else
          {
             echo $_SESSION['error']='<b> Error ! Ticket Info Failed ! Try Again !! </b>';
          } 


    } else {
     $_SESSION['error']='<b> Error ! All Field Required </b>'; 
       
    }

    } elseif($way == 'round-way') {
        if(!empty($from_destination) && !empty($to_destination) && !empty($j_date) && !empty($adult) && !empty($class) && !empty($r_date)){
            $query="UPDATE `book_ticket` SET `way_type`='$way',`f_location`='$from_destination',`t_location`='$to_destination',`j_date`='$j_date',`r_date`='$r_date',`adult`='$adult',`children`='$children',`infant`='$infant',`class`='$class' WHERE `unique_id`='$uniqueid'";  
            $run=mysqli_query($con ,$query); 
            
              if($run)
              {
                  $_SESSION['msg']='<b> Ticket Info Added Success !! Please proceed. ! </b>';
                   $last_id = mysqli_insert_id($con);
                   if(isset($_REQUEST['uniqid'])){
                    header("location:price_section.php?uniqid=$uniqueid");
                 } else {
                    header("location:price_section.php");
                 }
               //  header("location:details.php?id=$last_id");
                 session_regenerate_id(true);
                 exit();
              }
              else
              {
                 echo $_SESSION['error']='<b> Error ! Ticket Info Failed ! Try Again !! </b>';
              } 
        } else {
         $_SESSION['error']='<b> Error ! All Field Required </b>'; 
           
        }
    } elseif($way == 'multi-city'){
          //    foreach($_POST['from_destination_clon'] as $selected){
    //     echo $selected . " is selected.<br>";
    //      }
    //        die();
        $from_destination_clon = implode(',',$_POST['from_destination_clon']);   
    
        $to_destination_clon = implode(',',$_POST['to_destination_clon']);
        $j_date_clon = implode(',',$_POST['j_date_clon']);

        if(!empty($from_destination) && !empty($to_destination) && !empty($j_date) && !empty($adult) && !empty($class) && !empty($from_destination_clon) && !empty($to_destination_clon) && !empty($j_date_clon)){
          
            $query="UPDATE `book_ticket` SET `way_type`='$way',`f_location`='$from_destination',`t_location`='$to_destination',`j_date`='$j_date',`r_date`='$r_date',`adult`='$adult',`children`='$children',`infant`='$infant',`class`='$class',`clone_f_location`='$from_destination_clon',`clone_t_location`='$to_destination_clon',`clone_j_date`='$j_date_clon' WHERE `unique_id`='$uniqueid'";  
            $run=mysqli_query($con ,$query); 
            
              if($run)
              {
                  $_SESSION['msg']='<b> Ticket Info Added Success !! Please proceed. ! </b>';
                   $last_id = mysqli_insert_id($con);
                   if(isset($_REQUEST['uniqid'])){
                    header("location:price_section.php?uniqid=$uniqueid");
                 } else {
                    header("location:price_section.php");
                 }
               //  header("location:details.php?id=$last_id");
                 session_regenerate_id(true);
                 exit();
              }
              else
              {
                 echo $_SESSION['error']='<b> Error ! Ticket Info Failed ! Try Again !! </b>';
              } 

        } else {
         $_SESSION['error']='<b> Error ! All Field Required </b>';   
        }
    } 
    //  header("location:price_section.php");
 }

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from live.themewild.com/mytrip/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:13:00 GMT -->

<head>
<?php include("headerlink.php"); ?>
</head>

<body>

    
    <?php include("header.php"); ?>
    </header>

    <main class="main">

        <div class="hero-section">
            <div class="hero-slider owl-carousel owl-theme">
                <div class="hero-single" style="background: url(assets/img/hero/hero-2.jpg)">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-12 mx-auto">
                                <div class="hero-content text-center">
                                    <div class="hero-content-wrapper">
                                        <h2 class="hero-title" data-animation="fadeInUp" data-delay=".25s">Explore The
                                            World Together</h2>
                                        <p data-animation="fadeInUp" data-delay=".50s">Find awesome flight, hotel, tour,
                                            car and packages</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-single" style="background: url(assets/img/hero/hero-3.jpg)">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-12 mx-auto">
                                <div class="hero-content text-center">
                                    <div class="hero-content-wrapper">
                                        <h1 class="hero-title" data-animation="fadeInUp" data-delay=".25s">Explore The
                                            World Together</h1>
                                        <p data-animation="fadeInUp" data-delay=".50s">Find awesome flight, hotel, tour,
                                            car and packages</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-single" style="background: url(assets/img/hero/hero-7.jpg)">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-12 mx-auto">
                                <div class="hero-content text-center">
                                    <div class="hero-content-wrapper">
                                        <h1 class="hero-title" data-animation="fadeInUp" data-delay=".25s">Explore The
                                            World Together</h1>
                                        <p data-animation="fadeInUp" data-delay=".50s">Find awesome flight, hotel, tour,
                                            car and packages</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="search-area">
            <div class="container">
                <div class="search-wrapper">

                    <div class="search-header">
                        <div class="search-nav">
                            <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-tab-1" data-bs-toggle="pill"
                                        data-bs-target="#pills-1" type="button" role="tab" aria-controls="pills-1"
                                        aria-selected="true"><i class="far fa-plane-departure"></i>Flights</button>
                                </li>
                             
                            </ul>
                        </div>
                    </div>


                    <div class="tab-content" id="pills-tabContent">
                    <a href="index.php?uniqid=<?= $uniqueid ?>" class="theme-btn p-2" style="font-size:10px;"> <i class="fas fa-long-arrow-left"></i> Back Page
                            </a>
                    <!-- <div class="col-6">  -->
    <?php include('alertmsg.php'); ?>
<!-- </div> -->
                        <div class="tab-pane fade show active" id="pills-1" role="tabpanel"
                            aria-labelledby="pills-tab-1" tabindex="0">
                            
                            <div class="flight-search">
                                <div class="search-form">
                                    <form action="" method="post">
                                          <?php
                                            if(isset($_REQUEST['uniqid'])){
                                                ?>

<div class="flight-type">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" <?php if($row['way_type'] == 'one-way'){echo "checked"; } ?>  value="one-way"
                                                    name="flight-type" id="flight-type1">
                                                <label class="form-check-label" for="flight-type1">
                                                    One Way
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" value="round-way" <?php if($row['way_type'] == 'round-way'){echo "checked"; } ?>
                                                    name="flight-type" id="flight-type2">
                                                <label class="form-check-label" for="flight-type2">
                                                    Round Way
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" value="multi-city"
                                                    name="flight-type" id="flight-type3" <?php if($row['way_type'] == 'multi-city'){echo "checked"; } ?>>
                                                <label class="form-check-label" for="flight-type3">
                                                Multicity Layer
                                                </label>
                                            </div>
                                        </div>

                                               <?php
                                             } else {
                                                 ?>

<div class="flight-type">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" checked  value="one-way"
                                                    name="flight-type" id="flight-type1">
                                                <label class="form-check-label" for="flight-type1">
                                                    One Way
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" value="round-way"
                                                    name="flight-type" id="flight-type2">
                                                <label class="form-check-label" for="flight-type2">
                                                    Round Way
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" value="multi-city"
                                                    name="flight-type" id="flight-type3">
                                                <label class="form-check-label" for="flight-type3">
                                                Multicity Layer
                                                </label>
                                            </div>
                                        </div>

                                              <?php
                                             }
                                          ?>
                                        

                                         <?php if(isset($_REQUEST['uniqid'])){ ?>
                                        <div class="flight-search-wrapper">
                                            <div class="flight-search-content">

                                                <div class="flight-search-item">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>From</label>
                                                                <div class="form-group-icon">
                                                                    <input type="text" name="from_destination"
                                                                        class="form-control swap-from" value="<?= $row['f_location'] ?>">
                                                                    <i class="fal fa-plane-departure"></i>
                                                                </div>
                                                                <p>From Destination
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <div class="search-form-swap"><i
                                                                        class="far fa-repeat"></i>
                                                                </div>
                                                                <label>To</label>
                                                                <div class="form-group-icon">
                                                                    <input type="text" name="to_destination"
                                                                        class="form-control swap-to"
                                                                        value="<?= $row['t_location'] ?>">
                                                                    <i class="fal fa-plane-arrival"></i>
                                                                </div>
                                                                <p>To Destination</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <div class="search-form-date">
                                                                    <div class="search-form-journey">
                                                                        <label>Journey Date</label>
                                                                        <div class="form-group-icon">
                                                                            <input type="text" name="j_date"
                                                                                class="form-control date-picker journey-date" value="<?= $row['j_date'] ?>">
                                                                            <i class="fal fa-calendar-days"></i>
                                                                        </div>
                                                                        <p class="journey-day-name"></p>
                                                                    </div>
                                                                    <div class="search-form-return" style="<?php if($row['way_type'] == 'round-way'){ echo 'display: block';} ?>;">
                                                                        <label>Return Date</label>
                                                                        <div class="form-group-icon" value="<?= $row['r_date'] ?>">
                                                                            <input type="text" name="r_date"
                                                                                class="form-control date-picker return-date">
                                                                        </div>
                                                                        <p class="return-day-name"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group dropdown passenger-box">
                                                                <div class="passenger-class" role="menu"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <label>Passenger, Class</label>
                                                                    <div class="form-group-icon">
                                                                        <div class="passenger-total"><span
                                                                                class="passenger-total-amount"><?= $row['adult'] + $row['children'] + $row['infant'] ?></span>
                                                                            Passenger
                                                                        </div>
                                                                        <i class="fal fa-user-plus"></i>
                                                                    </div>
                                                                    <p class="passenger-class-name"><?= $row['class'] ?></p>
                                                                </div>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <div class="dropdown-item">
                                                                        <div class="passenger-item">
                                                                            <div class="passenger-info">
                                                                                <h6>Adults</h6>
                                                                                <p>12+ Years</p>
                                                                            </div>
                                                                            <div class="passenger-qty">
                                                                                <button type="button"
                                                                                    class="minus-btn"><i
                                                                                        class="far fa-minus"></i></button>
                                                                                <input type="text" name="adult"
                                                                                    class="qty-amount passenger-adult"
                                                                                    value="<?= $row['adult'] ?>" readonly>
                                                                                <button type="button"
                                                                                    class="plus-btn"><i
                                                                                        class="far fa-plus"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <div class="passenger-item">
                                                                            <div class="passenger-info">
                                                                                <h6>Children</h6>
                                                                                <p>2-12 Years</p>
                                                                            </div>
                                                                            <div class="passenger-qty">
                                                                                <button type="button"
                                                                                    class="minus-btn"><i
                                                                                        class="far fa-minus"></i></button>
                                                                                <input type="text" name="children"
                                                                                    class="qty-amount passenger-children"
                                                                                    value="<?= $row['children'] ?>" readonly>
                                                                                <button type="button"
                                                                                    class="plus-btn"><i
                                                                                        class="far fa-plus"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <div class="passenger-item">
                                                                            <div class="passenger-info">
                                                                                <h6>Infant</h6>
                                                                                <p>Below 2 Years</p>
                                                                            </div>
                                                                            <div class="passenger-qty">
                                                                                <button type="button"
                                                                                    class="minus-btn"><i
                                                                                        class="far fa-minus"></i></button>
                                                                                <input type="text" name="infant"
                                                                                    class="qty-amount passenger-infant"
                                                                                    value="<?= $row['infant'] ?>" readonly>
                                                                                <button type="button"
                                                                                    class="plus-btn"><i
                                                                                        class="far fa-plus"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <h6 class="mb-3 mt-2">Cabin Class</h6>
                                                                        <div class="passenger-class-info">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="radio" value="Economy" <?php if($row['class'] == 'Economy'){ echo 'checked';} ?>
                                                                                    name="class"
                                                                                    id="cabin-class1">
                                                                                <label class="form-check-label"
                                                                                    for="class1">
                                                                                    Economy
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="radio" value="Premium Economy"
                                                                                    name="class"
                                                                                    id="cabin-class1" <?php if($row['class'] == 'Premium Economy'){ echo 'checked';} ?>>
                                                                                <label class="form-check-label"
                                                                                    for="class1">
                                                                                    Premium Economy
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" 
                                                                                    type="radio" value="Business"
                                                                                    name="class"
                                                                                    id="cabin-class2" <?php if($row['class'] == 'Business'){ echo 'checked';} ?>>
                                                                                <label class="form-check-label"
                                                                                    for="cabin-class2">
                                                                                    Business
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="radio" value="First Class"
                                                                                    name="class"
                                                                                    id="cabin-class3" <?php if($row['class'] == 'First Class'){ echo 'checked';} ?>>
                                                                                <label class="form-check-label"
                                                                                    for="cabin-class3">
                                                                                    First Class
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="flight-search-item flight-multicity-item have-to-clone" style="<?php if($row['way_type'] == 'multi-city'){echo "display: block"; } ?>;">
                                                 
<?php $city = $row['clone_f_location'];
    $delimiter = ",";
    $cities = explode($delimiter, $city);
    $tcity = $row['clone_t_location'];
    $tcities = explode($delimiter, $tcity);
    $cjdate = $row['clone_j_date'];
    $c_jdate = explode($delimiter, $cjdate);
    
    $counter = 0; // Initialize counter

    while ($counter < max(count($cities), count($tcities), count($c_jdate))) {
        $fvalue = isset($cities[$counter]) ? $cities[$counter] : '';
        $tvalue = isset($tcities[$counter]) ? $tcities[$counter] : '';
        $c_j_date = isset($c_jdate[$counter]) ? $c_jdate[$counter] : '';
        ?> 
        <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>From</label>
                                                                <div class="form-group-icon">
                                                                    <input type="text" name="from_destination_clon[]"
                                                                        class="form-control swap-from" value="<?= $fvalue ?>">
                                                                    <i class="fal fa-plane-departure"></i>
                                                                </div>
                                                                <p>From Destination
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <div class="search-form-swap"><i
                                                                        class="far fa-repeat"></i>
                                                                </div>
                                                                <label>To</label>
                                                                <div class="form-group-icon">
                                                                    <input type="text" name="to_destination_clon[]"
                                                                        class="form-control swap-to"
                                                                        value="<?= $tvalue ?>">
                                                                    <i class="fal fa-plane-arrival"></i>
                                                                </div>
                                                                <p>To Destination</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <div class="search-form-date">
                                                                    <div class="search-form-journey">
                                                                        <label>Journey Date</label>
                                                                        <div class="form-group-icon">
                                                                            <input type="text" name="j_date_clon[]"
                                                                                class="form-control date-picker journey-date" value="<?= $c_j_date ?>">
                                                                            <i class="fal fa-calendar-days"></i>
                                                                        </div>
                                                                        <p class="journey-day-name"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <div class="multicity-btn">
                                                                    <i class="fal fa-plus-circle"></i> Add
                                                                    Another Flight
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        <?php
        $counter++; // Increment counter
    }
 ?>

                                                


                                            </div>
                                            <div class="search-btn">
                                                <button  type="submit" class="theme-btn" name="search_flight"> Continue <span
                                                        class="far fa-arrow-right"></span></button>
                                            </div>
                                        </div>

                                        <?php } else { 
                                        ?>

                                        <div class="flight-search-wrapper">
                                            <div class="flight-search-content">

                                                <div class="flight-search-item">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>From</label>
                                                                <div class="form-group-icon">
                                                                    <input type="text" name="from_destination"
                                                                        class="form-control swap-from" value="New Yourk">
                                                                    <i class="fal fa-plane-departure"></i>
                                                                </div>
                                                                <p>From Destination
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <div class="search-form-swap"><i
                                                                        class="far fa-repeat"></i>
                                                                </div>
                                                                <label>To</label>
                                                                <div class="form-group-icon">
                                                                    <input type="text" name="to_destination"
                                                                        class="form-control swap-to"
                                                                        value="Los Angeles">
                                                                    <i class="fal fa-plane-arrival"></i>
                                                                </div>
                                                                <p>To Destination</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <div class="search-form-date">
                                                                    <div class="search-form-journey">
                                                                        <label>Journey Date</label>
                                                                        <div class="form-group-icon">
                                                                            <input type="text" name="j_date"
                                                                                class="form-control date-picker journey-date">
                                                                            <i class="fal fa-calendar-days"></i>
                                                                        </div>
                                                                        <p class="journey-day-name"></p>
                                                                    </div>
                                                                    <div class="search-form-return">
                                                                        <label>Return Date</label>
                                                                        <div class="form-group-icon">
                                                                            <input type="text" name="r_date"
                                                                                class="form-control date-picker return-date">
                                                                        </div>
                                                                        <p class="return-day-name"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group dropdown passenger-box">
                                                                <div class="passenger-class" role="menu"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <label>Passenger, Class</label>
                                                                    <div class="form-group-icon">
                                                                        <div class="passenger-total"><span
                                                                                class="passenger-total-amount">2</span>
                                                                            Passenger
                                                                        </div>
                                                                        <i class="fal fa-user-plus"></i>
                                                                    </div>
                                                                    <p class="passenger-class-name">Business</p>
                                                                </div>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <div class="dropdown-item">
                                                                        <div class="passenger-item">
                                                                            <div class="passenger-info">
                                                                                <h6>Adults</h6>
                                                                                <p>12+ Years</p>
                                                                            </div>
                                                                            <div class="passenger-qty">
                                                                                <button type="button"
                                                                                    class="minus-btn"><i
                                                                                        class="far fa-minus"></i></button>
                                                                                <input type="text" name="adult"
                                                                                    class="qty-amount passenger-adult"
                                                                                    value="2" readonly>
                                                                                <button type="button"
                                                                                    class="plus-btn"><i
                                                                                        class="far fa-plus"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <div class="passenger-item">
                                                                            <div class="passenger-info">
                                                                                <h6>Children</h6>
                                                                                <p>2-12 Years</p>
                                                                            </div>
                                                                            <div class="passenger-qty">
                                                                                <button type="button"
                                                                                    class="minus-btn"><i
                                                                                        class="far fa-minus"></i></button>
                                                                                <input type="text" name="children"
                                                                                    class="qty-amount passenger-children"
                                                                                    value="0" readonly>
                                                                                <button type="button"
                                                                                    class="plus-btn"><i
                                                                                        class="far fa-plus"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <div class="passenger-item">
                                                                            <div class="passenger-info">
                                                                                <h6>Infant</h6>
                                                                                <p>Below 2 Years</p>
                                                                            </div>
                                                                            <div class="passenger-qty">
                                                                                <button type="button"
                                                                                    class="minus-btn"><i
                                                                                        class="far fa-minus"></i></button>
                                                                                <input type="text" name="infant"
                                                                                    class="qty-amount passenger-infant"
                                                                                    value="0" readonly>
                                                                                <button type="button"
                                                                                    class="plus-btn"><i
                                                                                        class="far fa-plus"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <h6 class="mb-3 mt-2">Cabin Class</h6>
                                                                        <div class="passenger-class-info">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="radio" value="Economy"
                                                                                    name="class"
                                                                                    id="cabin-class1">
                                                                                <label class="form-check-label"
                                                                                    for="class1">
                                                                                    Economy
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="radio" value="Premium Economy"
                                                                                    name="class"
                                                                                    id="cabin-class1">
                                                                                <label class="form-check-label"
                                                                                    for="class1">
                                                                                    Premium Economy
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" checked
                                                                                    type="radio" value="Business"
                                                                                    name="class"
                                                                                    id="cabin-class2">
                                                                                <label class="form-check-label"
                                                                                    for="cabin-class2">
                                                                                    Business
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="radio" value="First Class"
                                                                                    name="class"
                                                                                    id="cabin-class3">
                                                                                <label class="form-check-label"
                                                                                    for="cabin-class3">
                                                                                    First Class
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="flight-search-item flight-multicity-item have-to-clone">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label>From</label>
                                                                <div class="form-group-icon">
                                                                    <input type="text" name="from_destination_clon[]"
                                                                        class="form-control swap-from" value="New York">
                                                                    <i class="fal fa-plane-departure"></i>
                                                                </div>
                                                                <p>From Destination
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <div class="search-form-swap"><i
                                                                        class="far fa-repeat"></i>
                                                                </div>
                                                                <label>To</label>
                                                                <div class="form-group-icon">
                                                                    <input type="text" name="to_destination_clon[]"
                                                                        class="form-control swap-to"
                                                                        value="Los Angeles">
                                                                    <i class="fal fa-plane-arrival"></i>
                                                                </div>
                                                                <p>To Destination</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <div class="search-form-date">
                                                                    <div class="search-form-journey">
                                                                        <label>Journey Date</label>
                                                                        <div class="form-group-icon">
                                                                            <input type="text" name="j_date_clon[]"
                                                                                class="form-control date-picker journey-date">
                                                                            <i class="fal fa-calendar-days"></i>
                                                                        </div>
                                                                        <p class="journey-day-name"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <div class="multicity-btn">
                                                                    <i class="fal fa-plus-circle"></i> Add
                                                                    Another Flight
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="search-btn">
                                                <button  type="submit" class="theme-btn" name="search_flight"> Continue <span
                                                        class="far fa-arrow-right"></span></button>
                                            </div>
                                        </div>

                                        <?php
                                        } ?>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="feature-area pt-120 pb-80">
            <div class="container">
                <div class="feature-wrapper">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="feature-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                                <div class="feature-icon">
                                    <i class="flaticon-global-1"></i>
                                </div>
                                <h4 class="feature-title">Worldwide Coverage</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="feature-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
                                <div class="feature-icon">
                                    <i class="flaticon-medal"></i>
                                </div>
                                <h4 class="feature-title">Best Quality Services</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="feature-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
                                <div class="feature-icon">
                                    <i class="flaticon-customer-service"></i>
                                </div>
                                <h4 class="feature-title">24/7 Customer Service</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- 
        <div class="destination-area pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto wow fadeInDown" data-wow-duration="1s" data-wow-delay=".25s">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline">Destination</span>
                            <h2 class="site-title">Our Most Popular Destinations</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-12 col-lg-6">
                        <div class="destination-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                            <div class="destination-img">
                                <img src="assets/img/destination/01.jpg" alt>
                            </div>
                            <div class="destination-info">
                                <h4>New York City</h4>
                                <div class="destination-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fal fa-star"></i>
                                    <span>(2.5k Reviews)</span>
                                </div>
                                <div class="destination-more-info">
                                    <ul>
                                        <li><i class="far fa-earth-americas"></i> 30 Tour</li>
                                        <li><i class="far fa-hotel"></i> 35 Hotel</li>
                                        <li><i class="far fa-ship"></i> 15 Cruise</li>
                                    </ul>
                                </div>
                            </div>
                            <a href="#" class="destination-btn"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="destination-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
                            <div class="destination-img">
                                <img src="assets/img/destination/02.jpg" alt>
                            </div>
                            <div class="destination-info">
                                <h4>San Francisco</h4>
                                <div class="destination-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fal fa-star"></i>
                                    <span>(2.5k Reviews)</span>
                                </div>
                                <div class="destination-more-info">
                                    <ul>
                                        <li><i class="far fa-earth-americas"></i> 30 Tour</li>
                                        <li><i class="far fa-hotel"></i> 35 Hotel</li>
                                        <li><i class="far fa-ship"></i> 15 Cruise</li>
                                    </ul>
                                </div>
                            </div>
                            <a href="#" class="destination-btn"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="destination-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
                            <div class="destination-img">
                                <img src="assets/img/destination/03.jpg" alt>
                            </div>
                            <div class="destination-info">
                                <h4>Las Vegas</h4>
                                <div class="destination-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fal fa-star"></i>
                                    <span>(2.5k Reviews)</span>
                                </div>
                                <div class="destination-more-info">
                                    <ul>
                                        <li><i class="far fa-earth-americas"></i> 30 Tour</li>
                                        <li><i class="far fa-hotel"></i> 35 Hotel</li>
                                        <li><i class="far fa-ship"></i> 15 Cruise</li>
                                    </ul>
                                </div>
                            </div>
                            <a href="#" class="destination-btn"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="destination-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                            <div class="destination-img">
                                <img src="assets/img/destination/04.jpg" alt>
                            </div>
                            <div class="destination-info">
                                <h4>Los Angeles</h4>
                                <div class="destination-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fal fa-star"></i>
                                    <span>(2.5k Reviews)</span>
                                </div>
                                <div class="destination-more-info">
                                    <ul>
                                        <li><i class="far fa-earth-americas"></i> 30 Tour</li>
                                        <li><i class="far fa-hotel"></i> 35 Hotel</li>
                                        <li><i class="far fa-ship"></i> 15 Cruise</li>
                                    </ul>
                                </div>
                            </div>
                            <a href="#" class="destination-btn"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="destination-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
                            <div class="destination-img">
                                <img src="assets/img/destination/05.jpg" alt>
                            </div>
                            <div class="destination-info">
                                <h4>Sydney</h4>
                                <div class="destination-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fal fa-star"></i>
                                    <span>(2.5k Reviews)</span>
                                </div>
                                <div class="destination-more-info">
                                    <ul>
                                        <li><i class="far fa-earth-americas"></i> 30 Tour</li>
                                        <li><i class="far fa-hotel"></i> 35 Hotel</li>
                                        <li><i class="far fa-ship"></i> 15 Cruise</li>
                                    </ul>
                                </div>
                            </div>
                            <a href="#" class="destination-btn"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="destination-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
                            <div class="destination-img">
                                <img src="assets/img/destination/06.jpg" alt>
                            </div>
                            <div class="destination-info">
                                <h4>New Orleans</h4>
                                <div class="destination-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fal fa-star"></i>
                                    <span>(2.5k Reviews)</span>
                                </div>
                                <div class="destination-more-info">
                                    <ul>
                                        <li><i class="far fa-earth-americas"></i> 30 Tour</li>
                                        <li><i class="far fa-hotel"></i> 35 Hotel</li>
                                        <li><i class="far fa-ship"></i> 15 Cruise</li>
                                    </ul>
                                </div>
                            </div>
                            <a href="#" class="destination-btn"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->


        <!-- <div class="counter-area pt-80 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="counter-box">
                            <div class="icon">
                                <i class="fal fa-check-circle"></i>
                            </div>
                            <div class="counter-content">
                                <div class="counter-number">
                                    <span class="counter" data-count="+" data-to="120" data-speed="3000">120</span>
                                    <span class="counter-sign">k</span>
                                </div>
                                <h6 class="title">Booking Done</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="counter-box">
                            <div class="icon">
                                <i class="fal fa-earth-americas"></i>
                            </div>
                            <div class="counter-content">
                                <div class="counter-number">
                                    <span class="counter" data-count="+" data-to="200" data-speed="3000">200</span>
                                    <span class="counter-sign">+</span>
                                </div>
                                <h6 class="title">Our Destination</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="counter-box">
                            <div class="icon">
                                <i class="fal fa-smile"></i>
                            </div>
                            <div class="counter-content">
                                <div class="counter-number">
                                    <span class="counter" data-count="+" data-to="40" data-speed="3000">40</span>
                                    <span class="counter-sign">k</span>
                                </div>
                                <h6 class="title">Happy Clients</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="counter-box">
                            <div class="icon">
                                <i class="fal fa-users"></i>
                            </div>
                            <div class="counter-content">
                                <div class="counter-number">
                                    <span class="counter" data-count="+" data-to="180" data-speed="3000">180</span>
                                    <span class="counter-sign">+</span>
                                </div>
                                <h6 class="title">Our Partners</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->


        <!-- <div class="flight-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto wow fadeInDown" data-wow-duration="1s" data-wow-delay=".25s">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline">Flight</span>
                            <h2 class="site-title">Our Most Popular Flights</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6 col-lg-3">
                        <div class="flight-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                            <div class="flight-img">
                                <img src="assets/img/flight/01.jpg" alt>
                                <a href="#" class="add-wishlist"><i class="far fa-heart"></i></a>
                            </div>
                            <div class="flight-content">
                                <div class="flight-title">
                                    <div class="flight-title-info">
                                        <img src="assets/img/flight/airline-1.png" alt>
                                        <h4><a href="#">New York <i class="far fa-exchange"></i> Los Angeles</a></h4>
                                    </div>
                                    <p class="flight-date"><i class="far fa-calendar-days"></i> Aug 01, 2022 - Aug 30,
                                        2022</p>
                                </div>
                                <div class="flight-bottom">
                                    <div class="flight-price">
                                        From <span>$300</span>
                                    </div>
                                    <div class="flight-text-btn">
                                        <a href="flight-single.php">See Details <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="flight-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
                            <div class="flight-img">
                                <span class="badge">Featured</span>
                                <img src="assets/img/flight/02.jpg" alt>
                                <a href="#" class="add-wishlist"><i class="far fa-heart"></i></a>
                            </div>
                            <div class="flight-content">
                                <div class="flight-title">
                                    <div class="flight-title-info">
                                        <img src="assets/img/flight/airline-2.png" alt>
                                        <h4><a href="#">New York <i class="far fa-exchange"></i> Los Angeles</a></h4>
                                    </div>
                                    <p class="flight-date"><i class="far fa-calendar-days"></i> Aug 01, 2022 - Aug 30,
                                        2022</p>
                                </div>
                                <div class="flight-bottom">
                                    <div class="flight-price">
                                        From <span>$450</span>
                                    </div>
                                    <div class="flight-text-btn">
                                        <a href="flight-single.php">See Details <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="flight-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
                            <div class="flight-img">
                                <img src="assets/img/flight/03.jpg" alt>
                                <a href="#" class="add-wishlist"><i class="far fa-heart"></i></a>
                            </div>
                            <div class="flight-content">
                                <div class="flight-title">
                                    <div class="flight-title-info">
                                        <img src="assets/img/flight/airline-3.png" alt>
                                        <h4><a href="#">New York <i class="far fa-exchange"></i> Los Angeles</a></h4>
                                    </div>
                                    <p class="flight-date"><i class="far fa-calendar-days"></i> Aug 01, 2022 - Aug 30,
                                        2022</p>
                                </div>
                                <div class="flight-bottom">
                                    <div class="flight-price">
                                        From <span>$520</span>
                                    </div>
                                    <div class="flight-text-btn">
                                        <a href="flight-single.php">See Details <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="flight-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                            <div class="flight-img">
                                <img src="assets/img/flight/04.jpg" alt>
                                <a href="#" class="add-wishlist"><i class="far fa-heart"></i></a>
                            </div>
                            <div class="flight-content">
                                <div class="flight-title">
                                    <div class="flight-title-info">
                                        <img src="assets/img/flight/airline-4.png" alt>
                                        <h4><a href="#">New York <i class="far fa-exchange"></i> Los Angeles</a></h4>
                                    </div>
                                    <p class="flight-date"><i class="far fa-calendar-days"></i> Aug 01, 2022 - Aug 30,
                                        2022</p>
                                </div>
                                <div class="flight-bottom">
                                    <div class="flight-price">
                                        From <span>$630</span>
                                    </div>
                                    <div class="flight-text-btn">
                                        <a href="flight-single.php">See Details <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="flight-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                            <div class="flight-img">
                                <img src="assets/img/flight/05.jpg" alt>
                                <a href="#" class="add-wishlist"><i class="far fa-heart"></i></a>
                            </div>
                            <div class="flight-content">
                                <div class="flight-title">
                                    <div class="flight-title-info">
                                        <img src="assets/img/flight/airline-5.png" alt>
                                        <h4><a href="#">New York <i class="far fa-exchange"></i> Los Angeles</a></h4>
                                    </div>
                                    <p class="flight-date"><i class="far fa-calendar-days"></i> Aug 01, 2022 - Aug 30,
                                        2022</p>
                                </div>
                                <div class="flight-bottom">
                                    <div class="flight-price">
                                        From <span>$780</span>
                                    </div>
                                    <div class="flight-text-btn">
                                        <a href="flight-single.php">See Details <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="flight-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
                            <div class="flight-img">
                                <span class="badge badge-discount">25% Save</span>
                                <img src="assets/img/flight/06.jpg" alt>
                                <a href="#" class="add-wishlist"><i class="far fa-heart"></i></a>
                            </div>
                            <div class="flight-content">
                                <div class="flight-title">
                                    <div class="flight-title-info">
                                        <img src="assets/img/flight/airline-6.png" alt>
                                        <h4><a href="#">New York <i class="far fa-exchange"></i> Los Angeles</a></h4>
                                    </div>
                                    <p class="flight-date"><i class="far fa-calendar-days"></i> Aug 01, 2022 - Aug 30,
                                        2022</p>
                                </div>
                                <div class="flight-bottom">
                                    <div class="flight-price">
                                        From <span>$680</span>
                                    </div>
                                    <div class="flight-text-btn">
                                        <a href="flight-single.php">See Details <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="flight-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
                            <div class="flight-img">
                                <img src="assets/img/flight/07.jpg" alt>
                                <a href="#" class="add-wishlist"><i class="far fa-heart"></i></a>
                            </div>
                            <div class="flight-content">
                                <div class="flight-title">
                                    <div class="flight-title-info">
                                        <img src="assets/img/flight/airline-1.png" alt>
                                        <h4><a href="#">New York <i class="far fa-exchange"></i> Los Angeles</a></h4>
                                    </div>
                                    <p class="flight-date"><i class="far fa-calendar-days"></i> Aug 01, 2022 - Aug 30,
                                        2022</p>
                                </div>
                                <div class="flight-bottom">
                                    <div class="flight-price">
                                        From <span>$580</span>
                                    </div>
                                    <div class="flight-text-btn">
                                        <a href="flight-single.php">See Details <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="flight-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                            <div class="flight-img">
                                <img src="assets/img/flight/08.jpg" alt>
                                <a href="#" class="add-wishlist"><i class="far fa-heart"></i></a>
                            </div>
                            <div class="flight-content">
                                <div class="flight-title">
                                    <div class="flight-title-info">
                                        <img src="assets/img/flight/airline-2.png" alt>
                                        <h4><a href="#">New York <i class="far fa-exchange"></i> Los Angeles</a></h4>
                                    </div>
                                    <p class="flight-date"><i class="far fa-calendar-days"></i> Aug 01, 2022 - Aug 30,
                                        2022</p>
                                </div>
                                <div class="flight-bottom">
                                    <div class="flight-price">
                                        From <span>$490</span>
                                    </div>
                                    <div class="flight-text-btn">
                                        <a href="flight-single.php">See Details <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                        <a href="flight-full-width.php" class="theme-btn">Discover More<i class="far fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div> -->



        <!-- <div class="banner-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="banner-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                            <div class="banner-img">
                                <img src="assets/img/banner/01.jpg" alt>
                            </div>
                            <div class="banner-content">
                                <h3>First Booking <span>Get 70%</span> Discount!</h3>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout.</p>
                                <a href="#" class="theme-btn">Learn More<i class="far fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="banner-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
                            <div class="banner-img">
                                <img src="assets/img/banner/02.jpg" alt>
                            </div>
                            <div class="banner-content">
                                <h3>Summer Deals <span>Up To 50%</span> Discount!</h3>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout.</p>
                                <a href="#" class="theme-btn">Learn More<i class="far fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->


<!-- 
        <div class="video-area">
            <div class="container-fluid px-0">
                <div class="video-content" style="background-image: url(assets/img/video/01.jpg);">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="video-wrapper">
                                <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v=ckHzmP1evNU">
                                    <i class="fas fa-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->


        <div class="partner-area pt-100 pb-80">
            <div class="container">
                <div class="partner-wrapper partner-slider owl-carousel owl-theme">
                    <img src="assets/img/partner/01.png" alt="thumb">
                    <img src="assets/img/partner/02.png" alt="thumb">
                    <img src="assets/img/partner/01.png" alt="thumb">
                    <img src="assets/img/partner/02.png" alt="thumb">
                    <img src="assets/img/partner/01.png" alt="thumb">
                    <img src="assets/img/partner/02.png" alt="thumb">
                    <img src="assets/img/partner/01.png" alt="thumb">
                </div>
            </div>
        </div>


        <!-- <div class="testimonial-area bg py-120">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 mx-auto wow fadeInDown" data-wow-duration="1s" data-wow-delay=".25s">
                        <div class="site-heading">
                            <span class="site-title-tagline">Testimonials</span>
                            <h2 class="site-title">What Our Customers Are Saying Us?</h2>
                            <p>There are many variations of passages contrary to popular belief available the but the
                                majority have suffered alteration in some form by injected humour or randomised words
                                which don't look even slightly going use a passage believable.</p>
                            <a href="#" class="theme-btn mt-30">Explore More<i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="testimonial-slider owl-carousel owl-theme wow fadeInUp" data-wow-duration="1s"
                            data-wow-delay=".25s">
                            <div class="testimonial-single">
                                <div class="testimonial-content">
                                    <div class="testimonial-author-img">
                                        <img src="assets/img/testimonial/01.jpg" alt>
                                    </div>
                                    <div class="testimonial-author-info">
                                        <h4>Sylvia H Green</h4>
                                        <p>Clients</p>
                                    </div>
                                </div>
                                <div class="testimonial-quote">
                                    <p>
                                        There are many variations passages of available but to the majority have
                                        suffered alteration in some form injected humour words which look even slig
                                        believable.
                                    </p>
                                    <div class="testimonial-quote-icon">
                                        <img src="assets/img/icon/quote.svg" alt>
                                    </div>
                                </div>
                                <div class="testimonial-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <div class="testimonial-single">
                                <div class="testimonial-content">
                                    <div class="testimonial-author-img">
                                        <img src="assets/img/testimonial/02.jpg" alt>
                                    </div>
                                    <div class="testimonial-author-info">
                                        <h4>Gordo Novak</h4>
                                        <p>Clients</p>
                                    </div>
                                </div>
                                <div class="testimonial-quote">
                                    <p>
                                        There are many variations passages of available but to the majority have
                                        suffered alteration in some form injected humour words which look even slig
                                        believable.
                                    </p>
                                    <div class="testimonial-quote-icon">
                                        <img src="assets/img/icon/quote.svg" alt>
                                    </div>
                                </div>
                                <div class="testimonial-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <div class="testimonial-single">
                                <div class="testimonial-content">
                                    <div class="testimonial-author-img">
                                        <img src="assets/img/testimonial/03.jpg" alt>
                                    </div>
                                    <div class="testimonial-author-info">
                                        <h4>Reid E Butt</h4>
                                        <p>Clients</p>
                                    </div>
                                </div>
                                <div class="testimonial-quote">
                                    <p>
                                        There are many variations passages of available but to the majority have
                                        suffered alteration in some form injected humour words which look even slig
                                        believable.
                                    </p>
                                    <div class="testimonial-quote-icon">
                                        <img src="assets/img/icon/quote.svg" alt>
                                    </div>
                                </div>
                                <div class="testimonial-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <div class="testimonial-single">
                                <div class="testimonial-content">
                                    <div class="testimonial-author-img">
                                        <img src="assets/img/testimonial/04.jpg" alt>
                                    </div>
                                    <div class="testimonial-author-info">
                                        <h4>Parker Jimenez</h4>
                                        <p>Clients</p>
                                    </div>
                                </div>
                                <div class="testimonial-quote">
                                    <p>
                                        There are many variations passages of available but to the majority have
                                        suffered alteration in some form injected humour words which look even slig
                                        believable.
                                    </p>
                                    <div class="testimonial-quote-icon">
                                        <img src="assets/img/icon/quote.svg" alt>
                                    </div>
                                </div>
                                <div class="testimonial-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <div class="testimonial-single">
                                <div class="testimonial-content">
                                    <div class="testimonial-author-img">
                                        <img src="assets/img/testimonial/05.jpg" alt>
                                    </div>
                                    <div class="testimonial-author-info">
                                        <h4>Heruli Nez</h4>
                                        <p>Clients</p>
                                    </div>
                                </div>
                                <div class="testimonial-quote">
                                    <p>
                                        There are many variations passages of available but to the majority have
                                        suffered alteration in some form injected humour words which look even slig
                                        believable.
                                    </p>
                                    <div class="testimonial-quote-icon">
                                        <img src="assets/img/icon/quote.svg" alt>
                                    </div>
                                </div>
                                <div class="testimonial-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->


    </main>

    <footer class="footer-area">
     <?php include("footer.php"); ?>
    </footer>


    <?php include("footerlink.php"); ?>
</body>

<!-- Mirrored from live.themewild.com/mytrip/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:14:38 GMT -->

</html>