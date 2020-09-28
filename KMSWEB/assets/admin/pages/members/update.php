<?php 
include_once('../authen.php');
include_once('../../connect.php');
?>
<?php

//echo '<pre>',print_r ($_POST),'<pre>';
//echo $mem_image;
$mem_id=$_POST['mem_id'];
$mem_code=$_POST['mem_code'];
$mem_fname=$_POST['mem_fname'];
$mem_lname=$_POST['mem_lname'];
$comp_code=$_POST['comp_code'];
$mem_email=$_POST['mem_email'];
$mem_tel=$_POST['mem_tel'];
$mem_address=$_POST['mem_address'];
$mem_username=$_POST['mem_username'];
$mem_password=$_POST['mem_password'];
$mem_status=$_POST['mem_status'];
$sql="UPDATE members SET mem_code = '$mem_code',
                        mem_fname = '$mem_fname',
						mem_lname = '$mem_lname',
						comp_code = '$comp_code',
						mem_email = '$mem_email',
						mem_tel = '$mem_tel',
						mem_address = '$mem_address',
						mem_username =  '$mem_username',
						mem_password =  '$mem_password' ,
						mem_status = '$mem_status' ,
						flag = '0' WHERE mem_id = $mem_id ";
if(mysqli_query($conn,$sql)){
    echo '<script> alert("แก้ไขข้อมูลเสร็จสิ้น!")</script>'; 
    header('Refresh:0; url=index.php');
}else{
    echo "Sql Error:ไม่สามารถแก้ไขข้อมูลได้".$sql; 
    header('Refresh:50; url=index.php');
}
    //echo '<pre>'.print_r($_POST),'<pre>';

?>