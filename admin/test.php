<?php
include('../smtp/PHPMailerAutoload.php');

//  $email=$_REQUEST['email'];
 $emails = explode(',', $_REQUEST['email']);
  $subject=$_REQUEST['problome'];
  $description=$_REQUEST['comment'];
  
  foreach ($emails as $to) {
    smtp_mailer($to, $subject, $description);
}
// echo smtp_mailer($email,$subject,$description);
function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.hostinger.com";
	$mail->Subject = $subject;
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	//$mail->SMTPDebug = 2; 
	$mail->Username = "zeeshan.ansari@next2call.com";
	$mail->Password = "Xwf32dt$";
	$mail->SetFrom("zeeshan.ansari@next2call.com", "Rziwan Drinks");
	$mail->Body =$msg;
	$mail->addAttachment('mytrip.pptx'); // Check file path
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		$text = $mail->ErrorInfo;
		$title=$_REQUEST['title'];
		$uniqueid=$_REQUEST['uniqueid'];
	   echo '
	   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.js"></script>
	   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css">
	   
	   <script>
	   window.onload = function() {
		 Swal.fire({
		   title: "' . $title . '",
		   text: "' . $text . '",
		   icon: "success",
		   confirmButtonText: "OK"
		 }).then(function() {
		   window.location.href = "invoice.php?uniqid=' . $uniqueid . '#card_data";
		 });
	   }
	   </script>
	   ';
	}else{
		 $title=$_REQUEST['title'];
		 $text=$_REQUEST['text'];
		 $uniqueid=$_REQUEST['uniqueid'];
	
		echo '
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.js"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css">
		
		<script>
		window.onload = function() {
		  Swal.fire({
			title: "' . $title . '",
			text: "' . $text . '",
			icon: "success",
			confirmButtonText: "OK"
		  }).then(function() {
			window.location.href = "invoice.php?uniqid=' . $uniqueid . '";
		  });
		}
		</script>
		';

	}
}

// create ticket :  header("location:test.php?email=$email&problome=$problome&comment=Create Your Ticket&title=Entry Successfull&text=Your data has been saved successfully");

// update ticket :  header("location:test.php?email=$email&problome=$probloms&comment=$comment&title=Tickets Update&text=Tickets Update is successfullly");

// Close Ticket : header("location:test.php?email=$email&problome=$probloms&comment=Your Work is Done&title=Tickets Close&text=Tickets Close is successfullly");

?>