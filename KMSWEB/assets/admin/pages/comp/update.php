<?php 
include_once('../authen.php');
include_once('../../connect.php');
?>
<?php

//echo '<pre>',print_r ($_POST),'<pre>';
//echo $mem_image;
$comp_id=$_POST['comp_id'];
$comp_code=$_POST['comp_code'];
$comp_name=$_POST['comp_name'];
$comp_nickname=$_POST['comp_nickname'];
$comp_addr=$_POST['comp_addr'];
$comp_tel=$_POST['comp_tel'];
$comp_fax=$_POST['comp_fax'];
$comp_email=$_POST['comp_email'];
$comp_type=$_POST['comp_type'];
$sql="UPDATE comp SET comp_code = '$comp_code',
                        comp_name = '$comp_name',
						comp_nickname = '$comp_nickname',
						comp_addr = '$comp_addr',
						comp_tel =  '$comp_tel',
						comp_fax =  '$comp_fax' ,
						comp_email = '$comp_email' ,
						comp_type = '$comp_type' WHERE comp_id = $comp_id ";
if(mysqli_query($conn,$sql)){
    echo '<script> alert("แก้ไขข้อมูลเสร็จสิ้น!")</script>'; 
    header('Refresh:0; url=index.php');
}else{
    echo "Sql Error:ไม่สามารถแก้ไขข้อมูลได้".$sql; 
    header('Refresh:50; url=index.php');
}
    //echo '<pre>'.print_r($_POST),'<pre>';

?>