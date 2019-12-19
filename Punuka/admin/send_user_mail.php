<?php
require 'phpmailer/PHPMailerAutoload.php';
$fname = $_GET['fname'];
$email = $_GET['email'];
$mail_title = $_GET['mail_title'];
$mail_content = $_GET['mail_content'];



$mail = new PHPMailer;


//$mail->SMTPDebug = 2;
//$mail1->SMTPDebug = 2;  
//$mail2->SMTPDebug = 2;                                 // Enable verbose debug output
//$mail3->SMTPDebug = 2;

$mail->isMail();    
$mail->IsSMTP();

$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers

$mail->SMTPAuth = true;                               // Enable SMTP authentication

$mail->Username = 'nwokikesamson@gmail.com';                 // SMTP username


$mail->Password = 'SAMson2020';                           // SMTP password

$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted


$mail->Port = '587';                                    // TCP port to connect to


$mail->setFrom('libraryapp@punuka.com ', 'Punuka Digital Library');


//$mail->addAddress($uemail, $fname." ".$lname);     // Add a recipient
$mail->addAddress($email, $fname);


//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('info@example.com', 'Information');

//$mail->addCC('cc@example.com');
//$mail1->addCC('cc@example.com');
//$mail2->addCC('cc@example.com');
//$mail3->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail1->addBCC('bcc@example.com');
//$mail2->addBCC('bcc@example.com');
//$mail3->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail1->addAttachment('/var/tmp/file.tar.gz');
//$mail2->addAttachment('/var/tmp/file.tar.gz');
//$mail3->addAttachment('/var/tmp/file.tar.gz');

//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//$mail1->addAttachment('/tmp/image.jpg', 'new.jpg');
//$mail2->addAttachment('/tmp/image.jpg', 'new.jpg');
//$mail3->addAttachment('/tmp/image.jpg', 'new.jpg');

$mail->isHTML(true);                                  // Set email format to HTML



$mail->Subject = $mail_title;
$mail->Body    = "Dear ".$fname.",\n".$mail_content;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';






if(!$mail->send()) {
     echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Booking has been successfully submitted';
}











?>