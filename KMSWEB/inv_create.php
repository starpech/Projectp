<?php 
require_once 'php/connect.php';
//debug($_POST);
$p = $_POST;
$updateQuery = array();


// add ${$prefix_inv}main
$insPrMainSQL = "
insert into `{$prefix_inv}main` (`{$prefix_inv}SupplierID`,`{$prefix_inv}SupplierName`,`{$prefix_inv}DeliveryTo`,
`{$prefix_inv}detail_no`,site_no,{$prefix_inv}id,inv_RecieveID,inv_RecieveName,remark_po)
(SELECT 
'{$p['comp_code']}' as comp_code,
(select c.comp_name from comp as c where c.comp_code='{$p['supplier_id']}') as {$prefix_inv}SupplierName,
(select c.comp_addr from comp as c where c.comp_code ='{$p['comp_code']}') as {$prefix_inv}DeliveryTo,
'' as {$prefix_inv}detail_no, 
'{$p['comp_code']}' as site_no , 
'6364' as {$prefix_inv}id,
'{$p['inv_RecieveID']}' as inv_RecieveID,
(select c.comp_name from comp as c where c.comp_code='{$p['inv_RecieveID']}') as inv_RecieveName,
'{$p['remark_po']}' as remark_po


);

update {$prefix_inv}main as p set p.{$prefix_inv}id = (
 SELECT 
    concat(
        (select c.comp_nickname from comp as c where c.comp_code = x.site_no),
        '6364',RIGHT(concat('00000',x.row_num),4)) 
 from ( 
     SELECT {$prefix_inv}no,site_no, ( ROW_NUMBER() OVER (PARTITION BY site_no ORDER BY site_no,{$prefix_inv}no)) AS row_num FROM {$prefix_inv}main ) as x  where p.{$prefix_inv}no = x.{$prefix_inv}no 
   
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
header('location: '.$prefix_inv.'gen.php');