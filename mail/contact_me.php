<?php
require 'class.phpmailer.php';
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$to = 'mkidushim@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
$mail = new PHPMailer;
$mail->IsSMTP();
$mail->Host ='smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = $to;
$mail->Password = 'MTKshibby16';
$mail->SMTPSecure = 'tls';

// Create the email and send the message
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$mail->AddAddress($to);
$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = $email_subject;
$mail->Body = $email_body;
if (!$mail->Send()){
   $response['content'] = 'Message count not be sent<br>Mailer Error:'.$mail->ErrorInfo;
   echo json_encode($response);
   exit;
}

$response['status'] = "OK";
$response['content'] = "successfully emailed";
echo json_encode($response);
exit;
?>
