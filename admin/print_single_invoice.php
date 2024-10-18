<?php
include("connection.php"); 
include("function.php"); 

$uniquid = $_GET['uniqid'] ?? ''; // Use GET instead of REQUEST for clarity and security

if (!empty($uniquid)) {
    $query = "SELECT * FROM invoice_tbl WHERE `unique_id`='$uniquid'"; 

    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        $new_uniq_id = $row['unique_id'];
        $GST = $row['GST'];
        $sub_total = $row['sub_total'];
        $name = $row['f_name'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $p_mobile_a = $row['p_mobile_a'];
        $dob = $row['dob'] ?? '';
        $p_billing_address = $row['p_billing_address'];
        $total = $row['total'];
        $invoice_detail = $row['invoice_detail'];
        $Quantity = $row['invoice_quantity'];
        $invoice_rate = $row['invoice_rate'];
        $invoice_sub_total = $row['invoice_sub_total'];

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

        // Output the HTML directly
        echo $comment;
    } else {
        echo "error";
    }
} else {
    echo "No unique ID provided.";
}
?>
