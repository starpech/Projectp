<?php 
require_once 'php/connect.php';
debug($_POST);
$p = $_POST;
$updateQuery = array();


// add pr_main
$insPrMainSQL = "
insert into `pr_main` (`pr_SupplierID`,`pr_SupplierName`,`pr_DeliveryTo`,`pr_detail_no`,site_no)
(SELECT 
'{$p['comp_code']}' as comp_code,
(select c.comp_name from comp as c where c.comp_code='{$p['supplier_id']}') as pr_SupplierName,
(select c.comp_addr from comp as c where c.comp_code ='{$p['comp_code']}') as pr_DeliveryTo,
'' as pr_detail_no, '{$p['comp_code']}' as site_no 
);

update pr_main as p set p.pr_id = (
 SELECT 
    concat(
        (select c.comp_nickname from comp as c where c.comp_code = x.site_no),
        'PO','6364',RIGHT(concat('00000',x.row_num),4)) 
 from ( 
     SELECT pr_no,site_no, ( ROW_NUMBER() OVER (PARTITION BY site_no ORDER BY site_no,pr_no)) AS row_num FROM pr_main ) as x  where p.pr_no = x.pr_no 
   
   );
     
   SET @pr_no = LAST_INSERT_ID();


";

//$conn->multi_query($insPrMainSQL);
$pr_no = ($conn->insert_id);

$insPrDetailSQL = "";
foreach($p['products'] as $k=>$v){
$product_code = explode("|",$v);
$product_code = $product_code[0];
$insPrDetailSQL .= "
insert into pr_detail (pr_main_id,product_id,product_name,quantity,unit_price,amount,unit)
( SELECT 
@pr_no as pr_main_id,
    '{$product_code}' as Product_code, 
    (SELECT p.product_name FROM `product` as p WHERE p.product_code = '{$product_code}' ) as Product_name, 
    '{$p['amounts'][$k]}' as Product_amount, 
    '{$p['priceunits'][$k]}' as Product_price, 
    '{$p['totals'][$k]}' as Product_total ,
    (SELECT p.product_unit FROM `product` as p WHERE p.product_code = '{$product_code}' ) as unit
);

update pr_main set pr_detail_add=1 where pr_no = @pr_no;

";
}

$conn->multi_query($insPrMainSQL.$insPrDetailSQL);


header('location: pr_gen.php');