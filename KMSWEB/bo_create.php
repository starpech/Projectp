<?php 
require_once 'php/connect.php';
//debug($_POST);
$p = $_POST;
$updateQuery = array();
$fyear = '6364';
$prefix ='BO';

// add ${$prefix_po}main
$insPrMainSQL = "
insert into `{$prefix_po}main` (`{$prefix_po}SupplierID`,`{$prefix_po}SupplierName`,
`{$prefix_po}DeliveryTo`,`{$prefix_po}detail_no`,site_no,
bo_RecieveID,bo_RecieveName,remark_inv,{$prefix_po}id)
(SELECT 
'{$p['supplier_id']}' as supplier_id,
(select c.comp_name from comp as c where c.comp_code='{$p['supplier_id']}') as {$prefix_po}SupplierName,
(select c.comp_addr from comp as c where c.comp_code ='{$p['bo_RecieveID']}') as {$prefix_po}DeliveryTo,
'' as {$prefix_po}detail_no, '{$p['comp_code']}' as site_no ,
'{$p['bo_RecieveID']}' as bo_RecieveID,
(select c.comp_name from comp as c where c.comp_code='{$p['bo_RecieveID']}') as bo_RecieveName,
'{$p['remark_inv']}' as remark_inv,
concat(
      (select c.comp_nickname from comp as c where c.comp_code = '{$p['comp_code']}'),
      '{$prefix}',
	  '{$fyear}',
      RIGHT(concat('00000',(CONVERT(RIGHT(IF(max(bo.bo_id) is null , 'XXBOYYYY0000', max(bo.bo_id)),4),int)+1)),4)
     ) as bo_id 
from bo_main as bo 
where bo.site_no = '{$p['comp_code']}'
);

SET @{$prefix_po}no = LAST_INSERT_ID();


";

//$conn->multi_query($insPrMainSQL);
//$pr_no = ($conn->insert_id);

$insPrDetailSQL = "";
foreach($p['products'] as $k=>$v){
$product_code = explode("|",$v);
$product_code = $product_code[0];
$insPrDetailSQL .= "
insert into {$prefix_po}detail ({$prefix_po}main_id,product_id,product_name,quantity,unit_price,amount,unit)
( SELECT 
@{$prefix_po}no as {$prefix_po}main_id,
    '{$product_code}' as Product_code, 
    (SELECT p.product_name FROM `product` as p WHERE p.product_code = '{$product_code}' ) as Product_name, 
    '{$p['amounts'][$k]}' as Product_amount, 
    '{$p['priceunits'][$k]}' as Product_price, 
    '{$p['totals'][$k]}' as Product_total ,
    (SELECT p.product_unit FROM `product` as p WHERE p.product_code = '{$product_code}' ) as unit
);

update {$prefix_po}main set {$prefix_po}detail_add=1 where {$prefix_po}no = @{$prefix_po}no;

";
}
//echo $insPrMainSQL.$insPrDetailSQL;
$conn->multi_query($insPrMainSQL.$insPrDetailSQL);
header('location: '.$prefix_po.'gen.php');