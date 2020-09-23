<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
use PHPMailer\PHPMailer\PHPMailer;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';
$mem_email = $_SESSION["mem_email"];
$mem_name = $_SESSION["mem_fname"].' '.$_SESSION["mem_lname"];
$datelogin = date('d-m-Y H:i:s');

$mail = new PHPMailer(true);

    $mail->CharSet = "utf-8";
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'kms.adm01@gmail.com'; // Gmail address which you want to use as SMTP server
    $mail->Password = 'Sawaddee@1234'; // Gmail address Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = '587';
     

    $mail->setFrom('kms.adm01@gmail.com'); // Gmail address which you used as SMTP server
    $mail->addAddress($mem_email); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)

    $mail->isHTML(true);
    $mail->Subject = 'แจ้งเตือนการ Login เข้าแอป KMSWeb / Notice of KMSWeb Login';
    $mail->Body = " เรียน คุณ &nbsp; <h3>$mem_name</h3><br>
    คุณได้ทำการ &nbsp; Login &nbsp; เข้าสู่ &nbsp; KMSWeb &nbsp; ครั้งล่าสุดเมื่อวันที่ <h3>$datelogin</h3><br>หากคุณไม่ได้เข้าสู่ระบบ &nbsp; ในวันเวลาดังกล่าว &nbsp;&nbsp; กรุณาแจ้งเจ้าหน้าที่ดูแลระบบ <br><br> ขอแสดงความนับถือ <br><br>
    เจ้าหน้าที่ดูแลระบบ&nbsp; KMSWeb";
    
    $mail->send();
?>