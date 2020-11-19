<?php 
include_once "php/connect.php";
$SupplyID = $_GET['sid'];

$query = "update pr_main set approved = 1 where pr_id='{$_GET['id']}'; ";
$conn->query($query);

echo "กรุณารอสักครู่.....ระบบกำลังส่งเมลแจ้ง Supplier..";

// send mail
echo "
<script src=\"assets/admin/plugins/jquery/jquery.min.js\"></script>
<script>
$.post('php/sendemailToSupply.php?sid={$SupplyID}',function(retData){
    console.log(retData);

    if(retData == 'Success'){
        alert('ส่งเมลแจ้งกับ Supplier เรียบร้อยแล้ว');
    }else{
        alert('ไม่สามารถส่งเมลได้.');
    }
window.location = 'pr_gen.php';

}); </script>";

//header('location: pr_gen.php');

//echo $query;