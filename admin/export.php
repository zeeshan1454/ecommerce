<?php
include("connection.php"); 
include("function.php"); 

date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");

$unique_id = isset($_REQUEST['uniqid']) ? $_REQUEST['uniqid'] : null;

if ($unique_id) {
    $sql = "SELECT * FROM invoice_tbl WHERE unique_id='$unique_id'";
} else {
    $sql = "SELECT * FROM invoice_tbl WHERE created_at LIKE '%$date%'";
}

$qur = mysqli_query($con, $sql);

$filename = "Invoice_Report.csv";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: text/csv");

$display = fopen("php://output", 'w');
$flag = false;

while ($row = mysqli_fetch_assoc($qur)) {
    if (!$flag) {
        // Display field/column names as the first row
        $header = array('Invoice ID', 'Name', 'Email', 'Mobile', 'Additional Mobile', 'DOB', 'Billing Address', 'GST', 'Sub Total', 'Total', 'Created At', 'Updated At', 'Item', 'Rate', 'Quantity', 'Item Total');
        fputcsv($display, $header, ",", '"');
        $flag = true;
    }

    $invoice_id = $row['unique_id'];
    $name = $row['name'];
    $email = $row['email'];
    $mobile = $row['mobile'];
    $p_mobile_a = $row['p_mobile_a'];
    $dob = $row['dob'];
    $p_billing_address = $row['p_billing_address'];
    $GST = $row['GST'];
    $sub_total = $row['sub_total'];
    $total = $row['total'];
    $created_at = $row['created_at'];
    $updated_at = $row['updated_at'];
    $invoice_details = explode(',', $row['invoice_detail']);
    $quantities = explode(',', $row['Quantity']);
    $rates = explode(',', $row['invoice_rate']);
    $sub_totals = explode(',', $row['invoice_sub_total']);

    for ($i = 0; $i < count($invoice_details); $i++) {
        $item_row = array(
            $invoice_id,
            $name,
            $email,
            $mobile,
            $p_mobile_a,
            $dob,
            $p_billing_address,
            $GST,
            $sub_total,
            $total,
            $created_at,
            $updated_at,
            $invoice_details[$i],
            $rates[$i],
            $quantities[$i],
            $sub_totals[$i]
        );
        fputcsv($display, $item_row, ",", '"');
    }
}

fclose($display);
?>
