<?php
@session_start();
date_default_timezone_set('Asia/Bangkok');
$conn=mysqli_connect("localhost","root","kslitc@1234","kms_web_db");
use PHPMailer\PHPMailer\PHPMailer;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';
$mem_email = $_SESSION["mem_email"];
$mem_name = $_SESSION["mem_fname"].' '.$_SESSION["mem_lname"];
$comp_code = $_SESSION["comp_code"];
$datelogin = date('d-m-Y H:i:s');

$mail = new PHPMailer(true);
try{
    $mail->CharSet = "utf-8";
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'kms.adm01@gmail.com'; // Gmail address which you want to use as SMTP server
    $mail->Password = 'Sawaddee@1234'; // Gmail address Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = '587';
     

    $mail->setFrom('kms.adm01@gmail.com'); // Gmail address which you used as SMTP server
    $sql="select * from members where mem_status = 'officer' ";
	//echo $sql;
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0)
    {
        //$mail->addReplyTo("sarat@kslgroup.com");
        while($x=mysqli_fetch_assoc($res))
        {
            $mail->addAddress($x['mem_email']); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)
        }
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'รายการแจ้งเตือน มีรายการใบส่งของสร้างใหม่ในระบบ KMSWeb';
        $mail->Body = 'เรียน คุณ &nbsp; <h4>$mem_name</h4><br>
        มีรายการใบส่งของใหม่ในระบบ KMS Web ที่ผู้ขายสร้างในระบบ &nbsp; <br>ขอแสดงความนับถือ <br><br> จดหมายนี้ออกจากระบบอัตโนมัติ
        &nbsp; KMSWeb';
        $mail->AltBody = 'This is for non-html content';
        if($mail->send())
        {
            echo "Success";
        }
        else {
            echo "Failure";
        }

    }
    else {
        echo "No Data Found";
    }



} catch (phpmailerException $e) {
    echo $e->errorMessage(); //Pretty error messages from PHPMailer
  } catch (Exception $e) {
    echo $e->getMessage(); //Boring error messages from anything else!
}   

?>