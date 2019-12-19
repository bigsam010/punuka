<?php
require 'phpmailer/PHPMailerAutoload.php';
include "db_conn.php";
$currentdate=date('Y-m-d');
/* $emails = unserialize($_GET['mail_ids']);
//$titles = unserialize($_GET['title']);
$names = unserialize($_GET['name']);


var_dump($_GET['title']);
var_dump($_GET['name']);

die();
$arrlength = count($emails);
var_dump($names);
var_dump($titles); */





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


$mail->Password = 'SAMson2020';                            // SMTP password

$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted


$mail->Port = '587';                                    // TCP port to connect to


$mail->setFrom('libraryapp@punuka.com ', 'Punuka Digital Library');


//$mail->addAddress($uemail, $fname." ".$lname);     // Add a recipient
$resultset = $mysqli->query("SELECT * FROM borrowers where due_date <=('$currentdate') AND status=''");

$foundnum = $resultset->num_rows; 
if($resultset->num_rows !=0){
	 while($rows = $resultset->fetch_assoc()){
		$data[] = $rows;
}	

foreach($data as $rows){
	$mails[] = $rows ['e_mail'];
	$names[] = $rows ['full_name'];
	$titles[] = $rows ['title'];
	

}

$arrlength = count($mails);
for($x = 0; $x < $arrlength; $x++){

$email = $mails[$x];
$title = $titles[$x];
$name = $names[$x];



$mail->addAddress($email, "Users");                // name is optional




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



$mail->Subject = "Remainder";
$mail->Body    = "Dear ".$name." \n"."Please be reminded that the book you borrowed by name: ".$title." is now overdue for return";
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';






if(!$mail->send()) {
     echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Booking has been successfully submitted';
}

}

}








?>