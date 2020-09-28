<?php 
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

$mail = new PHPMailer();
$mail->From = 'boonyadol@email.com';
$mail->FromName = 'Mi nombre';
$mail->AddAddress('boonyadol@kslgroup.com');
$mail->Subject = 'Prueba ทดสอบ';
$mail->Body = 'ทดสอบ';
$mail->IsHTML(true);


// Active condition utf-8
$mail->CharSet = 'UTF-8';


// Send mail
$mail->Send();