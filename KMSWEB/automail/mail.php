<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<?
$mail= 'ekkapon@kslgroup.com, boonyadol@kslgroup.com';
echo $mail;

$subject = "Questionnaire Online Alert!!";
$to = $mail;
$umail = "ireportserver";

$Headers = "MIME-Version: 1.0\r\n" ;
$Headers .= "Content-type: text/html; charset=UTF-8\r\n" ;
$Headers .= "From: ".$umail." <".$umail.">\r\n" ;
$Headers .= "Reply-to: ".$umail." <".$umail.">\r\n" ;
$Headers .= "X-Priority: 3\r\n" ;
$Headers .= "X-Mailer: PHP mailer\r\n" ;
$message = "เรียนทุกท่านโปรดทราบ<br/>";
$message .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เนื่องจากแบบสำรวจที่ท่านได้ทำการตอบไปแล้วนั้น ยังทำการตอบไม่เสร็จสมบูรณ์<br />"; 
$message .= "ดังนั้นรบกวนท่านที่ได้รับ E-Mail ฉบับนี้ เข้าไปตอบแบบสอบถามได้ที่<br />";
$message .= "ลิ้งค์แบบสำรวจ : <a href='http://hr4poll.kslgroup.com/poll_input.php?caid'>http://hr4poll.kslgroup.com/poll_input.php?caid=</a><br /><br/>" ;
$message .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จึงเรียนมาเพื่อดำเนินการ<br />" ;
ini_set("sendmail_from", "$umail" );  // xxx@abc.com คือเมล์ของผู้ส่ง สามารถเปลี่ยนแปลงได้ 
ini_set("smtp_port","587");

//$mail_ok =  mail($to, $subject, $message, $Headers);
if(mail($to, $subject, $message, $Headers)){
echo "suceess";
} else {
echo "fail";
}
?>
</body>
</html>
