<?php 
include_once('../authen.php');
include_once('../../connect.php');
?>
<?php
//echo '<pre>',print_r ($_POST),'<pre>';
$payment_id=$_POST['payment_id'];
$sql="UPDATE `payment` SET `payment_status` = 'ชำระแล้ว' WHERE `payment`.`payment_id` = $payment_id";
if(mysqli_query($conn,$sql)){
    echo '<script> alert("แก้ไขข้อมูลเสร็จสิ้น!")</script>'; 
    header('Refresh:0; url=index.php');
}else{
    echo "Sql Error:ไม่สามารถแก้ไขข้อมูลได้".$sql; 
    header('Refresh:5; url=index.php');
}
    //echo '<pre>'.print_r($_POST),'<pre>';

?>