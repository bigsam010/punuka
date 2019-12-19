<?php
session_start();
include "db_conn.php";
require_once './class.phpmailer.php';
$currentdate = date('Y-m-d');
 $resultset = $mysqli->query("SELECT * FROM borrowers where due_date <=('$currentdate') AND status=''");
 while ($rows = $resultset->fetch_assoc()) {
     $html="<p>Dear ".$rows["full_name"].", </p>";
     $html="<p>This is to notify you that the book: ".$rows["title"]." you borrowed from Punuka Library is due for return. <br>Warm regards</p>";
     sendMail($rows["e_mail"], "Book Overdue Alert", $html);
 }
function sendMail($email, $subject, $message) {
        $mail = new PHPMailer();
        $mail->Host = "localhost";
        $mail->SMTPAuth = true;
        $mail->SMTPKeepAlive = true;
        $mail->Username = "registration@certmart.net";
        $mail->Password = "Gl@ry1234";
        $mail->From = "noreply@pronact.com";
        $mail->FromName = "Pronact";
        $mail->Subject = $subject;
        $mail->AddAddress($email);
        $mail->MsgHTML($message);
        $mail->Sender = "Pronact";
        $mail->Send();
    }
    
    