<?php
date_default_timezone_set('Asia/Bangkok');
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

//echo (extension_loaded('openssl') ? 'SSL loaded' : 'SSL not loaded') . "\n";

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "kks.cctv.2018@gmail.com";
$mail->Password = "kc@@2018";
$mail->CharSet = 'UTF-8';

$mail->setFrom('sarat@gmail.com', 'iReport');
$mail->AddCC('sarat@kslgroup.com', 'sarat');
$mail->addAddress('sarat_ch@hotmail.com', 'sarat');
$mail->Subject = 'iReport.Kslgroup.com test email ' . date("d-m-Y H:i:s น.");
$mail->msgHTML("Test email by iReport.Kslgroup.com ทดสอบภาษาไทย");
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
