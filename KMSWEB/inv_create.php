<?php 
require_once 'php/connect.php';
//debug($_POST);
$p = $_POST;
$updateQuery = array();
$fyear = '6364';
$prefix="IN";
// add ${$prefix_inv}main
$insPrMainSQL = "
insert into `{$prefix_inv}main` (`{$prefix_inv}SupplierID`,`{$prefix_inv}SupplierName`,`{$prefix_inv}DeliveryTo`,
`{$prefix_inv}detail_no`,site_no,inv_RecieveID,inv_RecieveName,remark_po,inv_id)
(SELECT 
'{$p['supplier_id']}' as supplier_id,
(select c.comp_name from comp as c where c.comp_code='{$p['supplier_id']}') as {$prefix_inv}SupplierName,
(select c.comp_addr from comp as c where c.comp_code ='{$p['comp_code']}') as {$prefix_inv}DeliveryTo,
'' as {$prefix_inv}detail_no, 
'{$p['comp_code']}' as site_no , 
'{$p['inv_RecieveID']}' as inv_RecieveID,
(select c.comp_name from comp as c where c.comp_code='{$p['inv_RecieveID']}') as inv_RecieveName,
'{$p['remark_po']}' as remark_po,
 concat(
      (select c.comp_nickname from comp as c where c.comp_code = '{$p['comp_code']}'),
      '{$prefix}','{$fyear}',
      RIGHT(concat('00000',(CONVERT(RIGHT(IF(max(inv.inv_id) is null , 'XXYYYY0000', max(inv.inv_id)),4),int)+1)),4)
     ) as inv_id 
from inv_main as inv 
where inv.site_no = '{$p['comp_code']}'


);

    
SET @{$prefix_inv}no = LAST_INSERT_ID();


";

//$conn->multi_query($insPrMainSQL);
//$pr_no = ($conn->insert_id);

$insPrDetailSQL = "";
foreach($p['products'] as $k=>$v){
$product_code = explode("|",$v);
$product_code = $product_code[0];
$insPrDetailSQL .= "
insert into {$prefix_inv}detail ({$prefix_inv}main_id,product_id,product_name,quantity,unit_price,amount,unit)
( SELECT 
@{$prefix_inv}no as {$prefix_inv}main_id,
    '{$product_code}' as Product_code, 
    (SELECT p.product_name FROM `product` as p WHERE p.product_code = '{$product_code}' ) as Product_name, 
    '{$p['amounts'][$k]}' as Product_amount, 
    '{$p['priceunits'][$k]}' as Product_price, 
    '{$p['totals'][$k]}' as Product_total ,
    (SELECT p.product_unit FROM `product` as p WHERE p.product_code = '{$product_code}' ) as unit
);

update {$prefix_inv}main set {$prefix_inv}detail_add=1 where {$prefix_inv}no = @{$prefix_inv}no;

";
}
//echo $insPrMainSQL.$insPrDetailSQL;
$conn->multi_query($insPrMainSQL.$insPrDetailSQL);

// send mail
echo "กรุณารอสักครู่...ระบบทำการส่งเมลแจ้งเจ้าหน้ที่ KMS เพื่อรับทราบ";
echo "
<script src=\"assets/admin/plugins/jquery/jquery.min.js\"></script>
<script>
$.post('php/sendemailInvSendKMS.php',function(retData){
    console.log(retData);

    if(retData == 'Success'){
        alert('ส่งเมลแจ้งกับ KMS เรียบร้อยแล้ว');
    }else{
        alert('ไม่สามารถส่งเมลได้.');
    }
window.location = 'inv_gen.php';

}); </script>";

//header('location: '.$prefix_inv.'gen.php');