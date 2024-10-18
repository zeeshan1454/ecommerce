<?php include ("connection.php");
include ("function.php");
require_once('../TCPDF/tcpdf.php');
if (!isset($_SESSION['admin_uniqueid']) && !isset($_SESSION['admin_username'])) {
    header("location:login.php");
}
$user_name = $_SESSION['admin_username'];
if (isset($_REQUEST['uniqid'])) {
    $uniqid = $_REQUEST['uniqid'];
    $sel = "SELECT * FROM `invoice_tbl` WHERE `unique_id`='$uniqid'";
} else {
    $sel = "SELECT * FROM `invoice_tbl` WHERE `unique_id`='0000000' ORDER BY id DESC LIMIT 1";
}

$runquery = mysqli_query($con, $sel);
$row = mysqli_fetch_array($runquery);
$uniqueid = $row['unique_id'] ?? '';

function generateRandomID($length = 6) {
    // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $randomString = '';

   for ($i = 0; $i < $length; $i++) {
       $randomString .= $characters[rand(0, strlen($characters) - 1)];
   }

   return $randomString;
}

$style = "
<style>
body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

#containermail {
    max-width: 600px;
    margin: auto;
    padding: 20px;
    background-color: #F3F2F2;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-top: 30px;
}

.header {
    text-align: center;
    padding: 20px;
    background-color: #13F8EA;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.header img {
    max-width: 200px;
    display: block;
    margin: auto;
}

h1 {
    color: #fff;
    margin-bottom: 10px;
}

p {
    margin-bottom: 10px;
}

.contact-info {
    margin-top: 20px;
}

.contact-info p {
    margin: 0;
}

span {
    font-weight: bold;
    background-color: #fff;
    padding: 3px 5px;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
}

.table th, .table td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: left;
}

.footer {
    background-color: #13F8EA;
    color: #fff;
    text-align: center;
    padding: 10px;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 10px;
}

.btn.no {
    background-color: #dc3545;
}

.flex {
    margin-top: 2%;
    font-size: 17px;
    display: flex;
    justify-content: space-between;
}

.term {
    background-color: black;
    padding: 5px;
    color: white;
}
</style>
";

if (isset($_POST['passenger_details']) || isset($_POST['send_save'])) {
    $new_uniq_id = generateRandomID();
    $GST = $_POST['GST'];
    $sub_total = $_POST['sub_total'];
    $userid = $_POST['f_name'];
    
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $p_mobile_a = $_POST['p_mobile_a'];
    $dob = $_POST['dob'] ?? '';
    $p_billing_address = $_POST['p_billing_address'];
    $total = $_POST['total'];
    $invoice_detail = implode(',', $_POST['invoice_detail']);
    $Quantity = implode(',', $_POST['invoice_quantity']);
    $invoice_rate = implode(',', $_POST['invoice_rate']);
    $invoice_sub_total = implode(',', $_POST['invoice_sub_total']);
    $sel_name = "SELECT user_name FROM user where id = '$userid'";
    $run_sql = mysqli_query($con,$sel_name);
     $user_row = mysqli_fetch_array($run_sql);  
     $name = $user_row["user_name"];


    if (!empty($name) && !empty($email) && !empty($invoice_detail)) {
        if (!isset($_REQUEST['uniqid'])) {
            // Insert new record
            $uniq_id = $new_uniq_id;
            $query = "INSERT INTO invoice_tbl (unique_id, GST, sub_total, name, email, mobile, p_mobile_a, dob, p_billing_address, total, invoice_detail, Quantity, invoice_rate, invoice_sub_total) 
                      VALUES ('$new_uniq_id', '$GST', '$sub_total', '$name', '$email', '$mobile', '$p_mobile_a', '$dob', '$p_billing_address', '$total', '$invoice_detail', '$Quantity', '$invoice_rate', '$invoice_sub_total')";
        } else {
            // Update existing record
            $uniqid = $_REQUEST['uniqid'];
            $uniq_id  = $uniqid;
            $query = "UPDATE invoice_tbl SET 
                      GST = '$GST', 
                      sub_total = '$sub_total', 
                      name = '$name', 
                      email = '$email', 
                      mobile = '$mobile', 
                      p_mobile_a = '$p_mobile_a', 
                      dob = '$dob', 
                      p_billing_address = '$p_billing_address', 
                      total = '$total', 
                      invoice_detail = '$invoice_detail', 
                      Quantity = '$Quantity', 
                      invoice_rate = '$invoice_rate', 
                      invoice_sub_total = '$invoice_sub_total',
                      updated_at = CURRENT_TIMESTAMP
                      WHERE unique_id = '$uniqid'";
        }
        $run = mysqli_query($con, $query);

        if ($run) {
            if(isset($_POST['send_save'])) { 

                //     $new_uniq_id = generateRandomID();
                // $GST = $_POST['GST'];
                // $sub_total = $_POST['sub_total'];
                // $name = $_POST['f_name'];
                // $email = $_POST['email'];
                // $mobile = $_POST['mobile'];
                // $p_mobile_a = $_POST['p_mobile_a'];
                // $dob = $_POST['dob'] ?? '';
                // $p_billing_address = $_POST['p_billing_address'];
                // $total = $_POST['total'];
                // $invoice_detail = implode(',', $_POST['invoice_detail']);
                // $Quantity = implode(',', $_POST['invoice_quantity']);
                // $invoice_rate = implode(',', $_POST['invoice_rate']);
                // $invoice_sub_total = implode(',', $_POST['invoice_sub_total']);
                
                $items = '';
                $details = explode(',', $invoice_detail);
                $quantities = explode(',', $Quantity);
                $rates = explode(',', $invoice_rate);
                $sub_totals = explode(',', $invoice_sub_total);
                
                for ($i = 0; $i < count($details); $i++) {
                    $items .= "<tr>
                        <td>" . ($i + 1) . "</td>
                        <td>" . htmlspecialchars($details[$i]) . "</td>
                        <td>" . htmlspecialchars($rates[$i]) . "</td>
                        <td>" . htmlspecialchars($quantities[$i]) . "</td>
                        <td>" . htmlspecialchars($sub_totals[$i]) . "</td>
                    </tr>";
                }
                
                $comment = "<head> 
                    $style
                  </head>
                  <body>
                    <div id='containermail'>
                        <div class='header'>
                            <img src='https://next2call.com/assets/img/logo/rizwanlogo.png' alt='Invoice Logo'>
                            <h1>Your Invoice</h1>
                        </div>
                        <div class='flex'>
                            <div>Hi $name,</div>
                            <div><a href='tel:916395630844'>+91 6395630844</a></div>
                        </div>
                        <p>Thank you for your purchase!</p>
                        <p>Your Invoice <span>$new_uniq_id</span> is now confirmed. Please find the details below. We recommend saving this email for your records.</p>
                        <p><span>Charges Description:</span></p>
                        <p>Sub Total Amount: INR $sub_total</p>
                        <p>GST : % $GST</p>
                        <p>Total Amount: INR $total</p>
                        <p><span>Invoice Details:</span></p>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>S. No.</th>
                                    <th>Item</th>
                                    <th>Rate</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                $items
                            </tbody>
                        </table>
                        <h4 class='term'>Terms & Conditions</h4>
                        <p>Please review the invoice details carefully. If you have any questions, feel free to contact us.</p>
                        <h5>Best Regards</h5>
                        <p><a href='mailto:zeeshan.ansari@next2call.com'>zeeshan.ansari@next2call.com</a></p>
                        <div class='footer'>
                            &copy; Rizwan Drinks
                        </div>
                    </div>
                  </body>
                ";
                
                $encodedComment = urlencode($comment);
                // echo $comment;
                // die();
                header("Location: test.php?email=$email&problome=Your Billing id $uniq_id&comment=$encodedComment&title=Email Send Successfull&text=Your data has been saved successfully&uniqueid=$uniq_id");
                } else {
                    $_SESSION['msg'] = '<b> Invoice Info Added Successfully! </b>';
                     header("Location: all_invoice.php");
                }
            session_regenerate_id(true);
            exit();
        } else {
            $_SESSION['error'] = '<b> Error! Items Info Failed! Try Again!! </b>';
        }
    } else {
        $_SESSION['error'] = '<b> Error! All Fields are Required </b>';
    }
}


if (isset($_POST['download_pdf'])) {
    function generateRandomID() {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 10);
    }

    $new_uniq_id = generateRandomID();
    $GST = $_POST['GST'];
    $sub_total = $_POST['sub_total'];
    $name = $_POST['f_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $p_mobile_a = $_POST['p_mobile_a'];
    $dob = $_POST['dob'] ?? '';
    $p_billing_address = $_POST['p_billing_address'];
    $total = $_POST['total'];
    $invoice_detail = implode(',', $_POST['invoice_detail']);
    $Quantity = implode(',', $_POST['invoice_quantity']);
    $invoice_rate = implode(',', $_POST['invoice_rate']);
    $invoice_sub_total = implode(',', $_POST['invoice_sub_total']);

    $items = '';
    $details = explode(',', $invoice_detail);
    $quantities = explode(',', $Quantity);
    $rates = explode(',', $invoice_rate);
    $sub_totals = explode(',', $invoice_sub_total);

    for ($i = 0; $i < count($details); $i++) {
        $items .= "<tr>
            <td>" . ($i + 1) . "</td>
            <td>" . htmlspecialchars($details[$i]) . "</td>
            <td>" . htmlspecialchars($rates[$i]) . "</td>
            <td>" . htmlspecialchars($quantities[$i]) . "</td>
            <td>" . htmlspecialchars($sub_totals[$i]) . "</td>
        </tr>";
    }

    $html = "
    <style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
    }
    .header {
        text-align: center;
        padding: 20px;
        background-color: #151ECA;
        color: #fff;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .header img {
        max-width: 200px;
        display: block;
        margin: auto;
    }
    .flex {
        margin-top: 2%;
        font-size: 17px;
        display: flex;
        justify-content: space-between;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }
    .table th, .table td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }
    .term {
        background-color: black;
        padding: 5px;
        color: white;
    }
    .footer {
        background-color: #151ECA;
        color: #fff;
        text-align: center;
        padding: 10px;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }
    </style>
    <body>
        <div class='header'>
            <img src='https://next2call.com/assets/img/logo/rizwanlogo.png' alt='Invoice Logo'>
            <h1>Your Invoice</h1>
        </div>
        <div class='flex'>
            <div>Hi $name,</div>
            <div><a href='tel:18669916989'>+91 6395630844</a></div>
        </div>
        <p>Thank you for your purchase!</p>
        <p>Your Invoice <span>$new_uniq_id</span> is now confirmed. Please find the details below. We recommend saving this email for your records.</p>
        <p><span>Charges Description:</span></p>
        <p>Sub Total Amount: INR $sub_total</p>
        <p>GST: $GST%</p>
        <p>Total Amount: INR $total</p>
        <p><span>Invoice Details:</span></p>
        <table class='table'>
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Item</th>
                    <th>Rate</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                $items
            </tbody>
        </table>
        <h4 class='term'>Terms & Conditions</h4>
        <p>Please review the invoice details carefully. If you have any questions, feel free to contact us.</p>
        <h5>Best Regards</h5>
        <p><a href='mailto:zeeshan.ansari@next2call.com'>zeeshan.ansari@next2call.com</a></p>
        <div class='footer'>
            &copy; Rizwan Drinks
        </div>
    </body>
    ";

    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Rizwan Drinks');
    $pdf->SetTitle('Invoice');
    $pdf->SetSubject('Invoice PDF');
    $pdf->SetKeywords('TCPDF, PDF, invoice, Rizwan Drinks');

    // set default header data
    $pdf->SetHeaderData('', 0, 'Invoice', '');

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set font
    $pdf->SetFont('dejavusans', '', 10);

    // add a page
    $pdf->AddPage();

    // output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');

    // Close and output PDF document
    $pdf->Output('invoice.pdf', 'D');
}



if (isset($_POST['print'])) { 
    $new_uniq_id = generateRandomID();
    $GST = $_POST['GST'];
    $sub_total = $_POST['sub_total'];
    $name = $_POST['f_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $p_mobile_a = $_POST['p_mobile_a'];
    $dob = $_POST['dob'] ?? '';
    $p_billing_address = $_POST['p_billing_address'];
    $total = $_POST['total'];
    $invoice_detail = implode(',', $_POST['invoice_detail']);
    $Quantity = implode(',', $_POST['invoice_quantity']);
    $invoice_rate = implode(',', $_POST['invoice_rate']);
    $invoice_sub_total = implode(',', $_POST['invoice_sub_total']);
    
    $items = '';
    $details = explode(',', $invoice_detail);
    $quantities = explode(',', $Quantity);
    $rates = explode(',', $invoice_rate);
    $sub_totals = explode(',', $invoice_sub_total);
    
    for ($i = 0; $i < count($details); $i++) {
        $items .= "<tr>
            <td>" . ($i + 1) . "</td>
            <td>" . htmlspecialchars($details[$i]) . "</td>
            <td>" . htmlspecialchars($rates[$i]) . "</td>
            <td>" . htmlspecialchars($quantities[$i]) . "</td>
            <td>" . htmlspecialchars($sub_totals[$i]) . "</td>
        </tr>";
    }
    
    $comment = "
    <html>
    <head> 
        <style>
            body { font-family: Arial, sans-serif; }
            .header { text-align: center; }
            .header img { max-width: 150px; }
            .header h1 { margin: 0; }
            .flex { display: flex; justify-content: space-between; }
            .table { width: 100%; border-collapse: collapse; }
            .table th, .table td { border: 1px solid #000; padding: 8px; text-align: left; }
            .term { margin-top: 20px; }
            .footer { text-align: center; margin-top: 20px; }
        </style>
    </head>
    <body>
        <div id='containermail'>
            <div class='header'>
                <img src='https://next2call.com/assets/img/logo/rizwanlogo.png' alt='Invoice Logo'>
                <h1>Your Invoice</h1>
            </div>
            <div class='flex'>
                <div>Hi $name,</div>
                <div><a href='tel:916395630844'>+91 6395630844</a></div>
            </div>
            <p>Thank you for your purchase!</p>
            <p>Your Invoice <span>$new_uniq_id</span> is now confirmed. Please find the details below. We recommend saving this email for your records.</p>
            <p><span>Charges Description:</span></p>
            <p>Sub Total Amount: INR $sub_total</p>
            <p>GST : % $GST</p>
            <p>Total Amount: INR $total</p>
            <p><span>Invoice Details:</span></p>
            <table class='table'>
                <thead>
                    <tr>
                        <th>S. No.</th>
                        <th>Item</th>
                        <th>Rate</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    $items
                </tbody>
            </table>
            <h4 class='term'>Terms & Conditions</h4>
            <p>Please review the invoice details carefully. If you have any questions, feel free to contact us.</p>
            <h5>Best Regards</h5>
            <p><a href='mailto:zeeshan.ansari@next2call.com'>zeeshan.ansari@next2call.com</a></p>
            <div class='footer'>
                &copy; Rizwan Drinks
            </div>
        </div>
    </body>
    </html>
    ";
    
    $encoded_comment = rawurlencode($comment);

    echo "<script>
        function printInvoice() {
            var myWindow = window.open('', 'Print Invoice', 'height=600,width=800');
            myWindow.document.write(decodeURIComponent('$encoded_comment'));
            myWindow.document.close();
            myWindow.focus();
            myWindow.print();
            myWindow.close();
        }
        printInvoice();
    </script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from live.themewild.com/mytrip/flight-booking.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:16:41 GMT -->

<head>

    <?php include ("headerlink.php"); ?>
    <style>
        .email_icon {
            cursor: pointer;
        }

        .phone_icon {
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="preloader">
        <div class="loader">
            <span style="--i:1;"></span>
            <span style="--i:2;"></span>
            <span style="--i:3;"></span>
            <span style="--i:4;"></span>
            <span style="--i:5;"></span>
            <span style="--i:6;"></span>
            <span style="--i:7;"></span>
            <span style="--i:8;"></span>
            <span style="--i:9;"></span>
            <span style="--i:10;"></span>
            <span style="--i:11;"></span>
            <span style="--i:12;"></span>
            <span style="--i:13;"></span>
            <span style="--i:14;"></span>
            <span style="--i:15;"></span>
            <span style="--i:16;"></span>
            <span style="--i:17;"></span>
            <span style="--i:18;"></span>
            <span style="--i:19;"></span>
            <span style="--i:20;"></span>
            <div class="loader-plane"></div>
        </div>
    </div>


    <header class="header">

        <?php include ("header.php"); ?>
    </header>

    <main class="main">

        <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Invoice Section</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Invoice Section</li>
                </ul>
            </div>
        </div>

        <div class="search-area">
            <div class="container">
                <div class="search-wrapper row">
                    <div class="col-lg-12">
                        <div class="booking-widget">
                            <a href="all_invoice.php" class="theme-btn p-2" style="font-size:10px;"> <i
                                    class="fas fa-long-arrow-left"></i> Back Page
                            </a>
                            <?php include ('alertmsg.php'); ?>
                            <h4 class="booking-widget-title">Items Info</h4>
                            <div class="booking-form">
                                <form action="#" method="post" calss="btn_passsnger">
                                    <div class="row append_passsnger">
                                        <h4 class="booking-widget-title">Billing Info</h4>
                                        <div class="col-lg-4 add_on_price_input">
                                            <div class="form-group">
                                                <label>GST</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" name="GST" id="gst"
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                        maxlength="12" value="<?= $row['GST'] ?? '' ?>"
                                                        placeholder="Enter GST">
                                                    <i class="fa fa-percent"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Sub Total Amount</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" placeholder="Total Amount"
                                                        id="sub_total_doller" readonly name="sub_total"
                                                        value="<?= $row['sub_total'] ?? '' ?>">
                                                    <i class="far fa-inr"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Total Amount</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control" placeholder="Total Amount"
                                                        id="total_doller" readonly name="total"
                                                        value="<?= $row['total'] ?? '' ?>">
                                                    <i class="far fa-inr"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label> Select Client</label>
                                                <!-- <div class="form-group-icon">
                                                    <input type="text" class="form-control" name="f_name"
                                                        value='<?= $row['name'] ?? '' ?>' placeholder="Full Name" required>
                                                    <i class="far fa-user"></i>
                                                </div> -->
                                                <div class="form-group-icon">
                                                <select name="f_name" class="form-control" id="client_name">
                                      <option value=""> Select Client</option>
                                        <?php
                                  $m_query = "SELECT * FROM user where status='0' AND user_name != '' ORDER BY id DESC";
						$run = mysqli_query($con,$m_query);
				        while($row=mysqli_fetch_array($run)){
                            ?>
                            <option value="<?= $row['id'] ?? '' ?>"><?= $row['user_name'] ?? '' ?></option>
                            <?php
                        }
                                        ?>
                                      
                                      </select> 
                                      <i class="far fa-user"></i>
                                      </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <div class="form-group-icon">
                                                    <input type="<?php if (!empty($row['email'] ?? '')) {
                                                        echo "password";
                                                    } else {
                                                        echo "email";
                                                    } ?>" class="form-control cli_email" placeholder="Email Address"
                                                        value="<?= $row['email'] ?? '' ?>" name="email" id='p_email_val'>
                                                    <i class="<?php if (!empty($row['email'] ?? '')) {
                                                        echo "fa fa-eye-slash";
                                                    } else {
                                                        echo "far fa-envelopes";
                                                    } ?> email_icon" data-email="<?= $row['email'] ?? '' ?>"
                                                        data-ticket_id="<?= $uniqueid ?>"
                                                        data-view_type="View Email" ></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <div class="form-group-icon">
                                                    <input type="<?php if (!empty($row['p_mobile'] ?? '')) {
                                                        echo "password";
                                                    } else {
                                                        echo "text";
                                                    } ?>" class="form-control cli_mobile" placeholder="Phone Number"
                                                        value="<?= $row['mobile'] ?? '' ?>"
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                        maxlength="12" name="mobile" required>
                                                    <i class="<?php if (!empty($row['mobile'] ?? '')) {
                                                        echo "fa fa-eye-slash";
                                                    } else {
                                                        echo "far fa-phone";
                                                    } ?> phone_icon" data-phone="<?= $row['mobile'] ?? '' ?>"
                                                        data-ticket_id="<?= $uniqueid ?>"
                                                        data-view_type="View Phone Number"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Alternate Phone Number</label>
                                                <div class="form-group-icon">
                                                    <input type="<?php if (!empty($row['p_mobile_a'] ?? '')) {
                                                        echo "password";
                                                    } else {
                                                        echo "text";
                                                    } ?>" class="form-control cli_mobile2" placeholder="Alternate Phone Number"
                                                        value="<?= $row['p_mobile_a'] ?? '' ?>"
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                        maxlength="12" name="p_mobile_a" required>
                                                    <i class="<?php if (!empty($row['p_mobile_a'] ?? '')) {
                                                        echo "fa fa-eye-slash";
                                                    } else {
                                                        echo "far fa-phone";
                                                    } ?> phone_icon" data-phone="<?= $row['p_mobile_a'] ?>"
                                                        data-ticket_id="<?= $uniqueid ?>"
                                                        data-view_type="View Phone Number"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Date Of Birth</label>
                                                <div class="form-group-icon">
                                                    <input type="date" class="form-control birthday cli_dob" name="dob"
                                                        placeholder="Age" value="<?= $row['dob'] ?? '' ?>">
                                                    <i class="far fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Billing Address</label>
                                                <div class="form-group-icon">
                                                    <input type="text" class="form-control cli_address" name="p_billing_address"
                                                        value='<?= $row['p_billing_address'] ?? '' ?>'
                                                        placeholder="Billing Address" required>
                                                    <i class="fab fa-pagelines"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mt-2">
                                                <button type="submit" name="passenger_details"
                                                    class="theme-btn bg-light text-dark">Save</button>

                                                <button type="submit" name="send_save"
                                                    class="theme-btn ml-3">Save and Send<i
                                                        class="far fa-arrow-right"></i></button>

                                                <button type="submit" name="print"
                                                    class="theme-btn ml-3 bg-light text-dark">Print<i
                                                        class="far fa-arrow-right"></i></button>

                                                <!-- <button type="submit" name="download_pdf"
                                                    class="theme-btn ml-3 bg-info">Download Pdf<i
                                                        class="far fa-arrow-right"></i></button> -->
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
        <?php include ("footer.php"); ?>
    </footer>


    <?php include ("footerlink.php"); ?>

</body>
<script>
    $(document).ready(function () {

        $(".add_on_price_input").hide();
        $(".add_on_qty").hide();
        $(".add_on_qty2").hide();
        $(".add_on_price_input2").hide();
        $(".add_on_select_2").hide();
        <?php
        if (!empty($row['p_add_on'])) {
            ?>
            $(".add_on_select_input").removeClass('col-lg-4').addClass('col-lg-2');
            $(".mco").removeClass('col-lg-4').addClass('col-lg-2');
            $(".add_on_price_input").show();
            $(".add_on_qty").show();
            $(".add_on_select_2").show();
            <?php
        }
        ?>
        <?php
        if (!empty($row['p_add_on2'])) {
            ?>
            $(".add_on_select_2").removeClass('col-lg-4').addClass('col-lg-4');
            $(".add_on_qty2").show();
            $(".add_on_price_input2").show();
            <?php
        }
        ?>
        $("#add_on_item").on('change', function () {
            var add_on_item = $("#add_on_item").val();

            if (add_on_item !== '') {
                $(".add_on_select_input").removeClass('col-lg-4').addClass('col-lg-2');
                $(".mco").removeClass('col-lg-4').addClass('col-lg-2');
                $(".add_on_price_input").show();
                $(".add_on_qty").show();
                $(".add_on_select_2").show();
                $("#add_on").val("<?= $row['p_add_on'] ?>");
                $("#add_on_qty").val("<?= $row['add_on_qty'] ?>");
            } else {
                $(".add_on_select_input").removeClass('col-lg-2').addClass('col-lg-4');
                $(".mco").removeClass('col-lg-2').addClass('col-lg-4');
                $(".add_on_price_input").hide();
                $(".add_on_qty").hide();
                $(".add_on_select_2").hide();
                $(".add_on_price_input2").hide();
                $(".add_on_qty2").hide();
                $("#add_on").val("");
                $("#add_on_qty").val("");
                $("#add_on2").val("");
                $("#add_on_qty2").val("");
            }
        });

        $("#add_on_item2").on('change', function () {
            var add_on_item2 = $("#add_on_item2").val();

            if (add_on_item2 !== '') {
                $(".add_on_select_2").removeClass('col-lg-4').addClass('col-lg-4');
                $(".add_on_price_input2").show();
                $(".add_on_qty2").show();
                $("#add_on2").val("<?= $row['p_add_on2'] ?>");
                $("#add_on_qty2").val("<?= $row['add_on_qty2'] ?>");
            } else {
                $(".add_on_select_input2").removeClass('col-lg-2').addClass('col-lg-4');
                $(".add_on_price_input2").hide();
                $(".add_on_qty2").hide();
                $("#add_on2").val("");
                $("#add_on_qty2").val("");
            }
        });


        var infantAvailability = <?php echo $row['infant']; ?>;
        var childrenAvailability = <?php echo $row['children']; ?>;
        var adultAvailability = <?php echo $row['adult']; ?>;

        if (infantAvailability) {
            $(".Infant_Fair").show();
        } else {
            $(".Infant_Fair").hide();
        }

        if (childrenAvailability) {
            $(".Children_Fair").show();
        } else {
            $(".Children_Fair").hide();
        }

        if (adultAvailability) {
            $(".Adult_Fair").show();
        } else {
            $(".Adult_Fair").hide();
        }

        $("#fair, #mco, #no_pas, #add_on, #add_on_qty, #add_on2, #add_on_qty2, #Children_Fair, #Infant_Fair, #add_on_item, #add_on_item2").on('keyup change', function () {
            var no_pas = parseInt($("#no_pas").val());
            var qval_em = parseFloat($("#fair").val());
            var qval = isNaN(qval_em) ? 0 : qval_em;
            var Children_F = parseFloat($("#Children_Fair").val());
            var Children_Fair = isNaN(Children_F) ? 0 : Children_F;
            var Infant_F = parseFloat($("#Infant_Fair").val());
            var Infant_Fair = isNaN(Infant_F) ? 0 : Infant_F;
            var mco = parseFloat($("#mco").val());
            var add_on = parseFloat($("#add_on").val());
            var add_on_qty = parseFloat($("#add_on_qty").val());
            var add_on2 = parseFloat($("#add_on2").val());
            var add_on_qty2 = parseFloat($("#add_on_qty2").val());

            var add_on_qty_new = isNaN(add_on_qty) ? 0 : add_on_qty;
            var add_on_new = isNaN(add_on) ? 0 : add_on;

            var add_on_qty_new2 = isNaN(add_on_qty2) ? 0 : add_on_qty2;
            var add_on_new2 = isNaN(add_on2) ? 0 : add_on2;

            // Calculate total based on availability
            var total = (Infant_Fair * infantAvailability) + (Children_Fair * childrenAvailability) + (qval * adultAvailability) + (mco * no_pas) + (add_on_new * add_on_qty_new) + (add_on_new2 * add_on_qty_new2);

            // Use the ternary operator to handle the case where total is NaN
            var ttotal = isNaN(total) ? (Infant_Fair * infantAvailability) + (Children_Fair * childrenAvailability) + (qval * adultAvailability) + (add_on_new * add_on_qty_new) + (add_on_new2 * add_on_qty_new2) : total;

            $("#total_doller").val(ttotal);
        });


    });
</script>
<script>
    $(document).ready(function () {

        var formbutton2 = `
    <div class="col-lg-12 d-flex">
        <div class="form-group mt-2 float-right">
            <button id="appendButton" type="button" class="theme-btn ml-auto"><i class="fa fa-plus"></i></button>
        </div>
    </div>
`;

        $(".append_passsnger").prepend(formbutton2);

        $("#appendButton").click(function () {
            appendPassenger();
        });

        function appendPassenger(invoice_detail = '', invoice_sub_total = '', invoice_rate = '', invoice_quantity = 1) {
            var cardHtml = `
        <div class="row remove_pasenger_section">
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="form-group">
                            <label>Item Detals</label>
                            <div class="form-group-icon">
                                <input type="text" class="form-control" value="${invoice_detail}" name="invoice_detail[]" placeholder="Item Detals" required>
                                <i class="far fa-globe"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Quantity</label>
                            <div class="form-group-icon">
                                <input type="number" class="form-control invoice_quantity" value="${invoice_quantity}" name="invoice_quantity[]" placeholder="Quantity">
                                <i class="far fa-sort"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Rate</label>
                            <div class="form-group-icon">
                                <input type="text" class="form-control invoice_rate" value="${invoice_rate}" name="invoice_rate[]" placeholder="Rate" required>
                                <i class="far fa-inr"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="form-group">
                            <label>Total</label>
                            <div class="form-group-icon">
                                <input type="text" class="form-control invoice_sub_total" value="${invoice_sub_total}" name="invoice_sub_total[]" placeholder="Total" readonly>
                                <i class="far fa-inr"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <div class="col-lg-12 d-flex">
                                <div class="form-group mt-2 float-right">
                                    <button type="button" class="theme-btn ml-auto mt-4 remove-passenger"><i class="fa fa-close"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
            $(".append_passsnger").prepend(cardHtml);
        }

        $(document).on('click', '.remove-passenger', function () {
            $(this).closest('.remove_pasenger_section').remove();
        });

        $(document).on('keyup change', '.invoice_quantity, .invoice_rate, #gst', function () {
            var $row = $(this).closest('.remove_pasenger_section');
            var invoice_quantity = parseInt($row.find(".invoice_quantity").val());
            var invoice_rate = parseFloat($row.find(".invoice_rate").val());
            var invoice_quantity_new = isNaN(invoice_quantity) ? 0 : invoice_quantity;
            var invoice_rate_new = isNaN(invoice_rate) ? 0 : invoice_rate;
            var invoice_sub_total = (invoice_rate_new * invoice_quantity_new).toFixed(2);
            $row.find(".invoice_sub_total").val(invoice_sub_total);
            updateInvoiceTotals();
        });

        function updateInvoiceTotals() {
            var total = 0;
            $(".invoice_sub_total").each(function () {
                total += parseFloat($(this).val()) || 0;
            });

            var gst = parseFloat($("#gst").val());
            var gst_percentage = isNaN(gst) ? 0 : gst;
            var gst_amount = (total * gst_percentage / 100).toFixed(2);
            var total_with_gst = (total + parseFloat(gst_amount)).toFixed(2);

            $("#sub_total_doller").val(total.toFixed(2));
            $("#total_doller").val(total_with_gst);
            $("#gst_amount").val(gst_amount); // Optionally show the GST amount separately
        }



        var formbutton = `
    <div class="col-lg-12">
        <div class="form-group mt-2 d-flex">
            <button type="submit" name="passenger_details" class="theme-btn ml-auto">Booking Now<i class="far fa-arrow-right"></i></button>
        </div>
    </div>
`;

        // $(".append_passsnger").append(formbutton);


        <?php
        if (!empty($row['invoice_detail'])) {
            $pass_name_e = $row['invoice_detail'];
            $delimiter_e = ",";
            $pass_names_e = explode($delimiter_e, $pass_name_e);
            $pass_quantity_e = $row['Quantity'];
            $pass_quantities_e = explode($delimiter_e, $pass_quantity_e);
            $pass_rate_e = $row['invoice_rate'];
            $pass_rates_e = explode($delimiter_e, $pass_rate_e);
            $pass_sub_total_e = $row['invoice_sub_total'];
            $pass_sub_totals_e = explode($delimiter_e, $pass_sub_total_e);
            $counter_e = 0;

            while ($counter_e < max(count($pass_names_e), count($pass_quantities_e), count($pass_rates_e), count($pass_sub_totals_e))) {
                $pass_p_value_e = isset($pass_names_e[$counter_e]) ? $pass_names_e[$counter_e] : '';
                $pass_quantity_value_e = isset($pass_quantities_e[$counter_e]) ? $pass_quantities_e[$counter_e] : '';
                $pass_rate_value_e = isset($pass_rates_e[$counter_e]) ? $pass_rates_e[$counter_e] : '';
                $pass_sub_total_value_e = isset($pass_sub_totals_e[$counter_e]) ? $pass_sub_totals_e[$counter_e] : '';
                ?>
                appendPassenger("<?= $pass_p_value_e ?>", "<?= $pass_sub_total_value_e ?>", "<?= $pass_rate_value_e ?>", "<?= $pass_quantity_value_e ?>");
                <?php
                $counter_e++;
            }
        } else {
            ?>
            appendPassenger();
            <?php
        }
        ?>
    });

</script>
<!-- date picker start -->
<script>
    $(document).ready(function () {
        var today = new Date().toISOString().split("T")[0];
        $('.birthday').attr('max', today);
    });

    $(document).ready(function () {
        var today = new Date();
        var maxDate = new Date(today);
        maxDate.setFullYear(maxDate.getFullYear() - 12);

        var maxDateString = maxDate.toISOString().split("T")[0];
        $('.Adult').attr('max', maxDateString);
    });

    $(document).ready(function () {
        var today = new Date();
        var maxDate = new Date(today);
        var minDate = new Date(today);

        maxDate.setFullYear(maxDate.getFullYear() - 0);
        minDate.setFullYear(minDate.getFullYear() - 2);

        var maxDateString = maxDate.toISOString().split("T")[0];
        var minDateString = minDate.toISOString().split("T")[0];

        $('.Infant').attr('max', maxDateString);
        $('.Infant').attr('min', minDateString);
    });

    $(document).ready(function () {
        var today = new Date();
        var maxDate = new Date(today);
        var minDate = new Date(today);

        maxDate.setFullYear(maxDate.getFullYear() - 2);
        minDate.setFullYear(minDate.getFullYear() - 12);

        var maxDateString = maxDate.toISOString().split("T")[0];
        var minDateString = minDate.toISOString().split("T")[0];

        $('.Children').attr('max', maxDateString);
        $('.Children').attr('min', minDateString);
    });

</script>

<script>
    $(document).on("click", ".email_icon", function () {
        var ticket_uniq_id = $(this).data("ticket_id");
        var email = $(this).data("email");
        var view_type = $(this).data("view_type");
        let inputtype = $(this).parent().find('input');

        // Toggle input type between email and password
        if (inputtype.prop('type') === 'email') {
            inputtype.prop('type', 'password');
            inputtype.val(email);
            $(this).removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        } else {
            inputtype.prop('type', 'email');
            inputtype.val(email);
            $(this).removeClass('fa fa-eye-slash').addClass('fa fa-eye');

            jQuery.ajax({
                url: "ticket_log_ins.php", // Assuming you have a separate PHP file to handle the request
                type: "POST",
                data: { ticket_uniq_id: ticket_uniq_id, email: email, view_type: view_type },
                success: function (result) {
                    // alert(result);
                    if (result == 0) {
                        alert('Error');
                    }
                }
            });

        }
    });
    $(document).on("click", ".phone_icon", function () {
        var ticket_uniq_id = $(this).data("ticket_id");
        var email = $(this).data("phone");
        var view_type = $(this).data("view_type");
        let inputtype = $(this).parent().find('input');

        // Toggle input type between email and password
        if (inputtype.prop('type') === 'text') {
            inputtype.prop('type', 'password');
            inputtype.val(email);
            $(this).removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        } else {
            inputtype.prop('type', 'text');
            inputtype.val(email);
            $(this).removeClass('fa fa-eye-slash').addClass('fa fa-eye');

            jQuery.ajax({
                url: "ticket_log_ins.php", // Assuming you have a separate PHP file to handle the request
                type: "POST",
                data: { ticket_uniq_id: ticket_uniq_id, email: email, view_type: view_type },
                success: function (result) {
                    // alert(result);
                    if (result == 0) {
                        alert('Error');
                    }
                }
            });

        }
    });


</script>
<script>
    	$(document).ready(function(){
		jQuery('#client_name').change(function(){
			var id=jQuery(this).val();
            
				jQuery.ajax({
					type:'post',
					url:'get_cli_data.php',
					data:'id='+id,
					success:function(result){
						
						// alert(result);
                        var myObject = JSON.parse(result);
                         var name = myObject[0].user_name;
                         var email = myObject[0].user_email;
                         var mobile = myObject[0].mobile;
                         var mobile2 = myObject[0].mobile2;
                         var dob = myObject[0].dob;
                         var address = myObject[0].address;
                        $(".cli_email").val(email);
                        $(".cli_mobile").val(mobile);
                        $(".cli_mobile2").val(mobile2);
                        $(".cli_dob").val(dob);
                        $(".cli_address").val(address);
                        
					}
				});
			
		});

        });
   </script>
<!-- Mirrored from live.themewild.com/mytrip/flight-booking.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Sep 2023 11:16:43 GMT -->

</html>