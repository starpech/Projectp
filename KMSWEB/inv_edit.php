<?php 
require_once 'php/connect.php';
//debug($_POST);
$updateQuery = array();
$updateQuery[] = "
UPDATE `{$prefix_inv}main` as p set 
p.`{$prefix_inv}date`='{$_POST[$prefix_inv.'date']}',
p.`{$prefix_inv}SupplierID`= '{$_POST['supplier_id']}',
p.`{$prefix_inv}SupplierName` = (select c.comp_name from comp as c where c.comp_code = '{$_POST['supplier_id']}'),
p.inv_RecieveID='{$_POST['inv_RecieveID']}',
p.inv_RecieveName=(select c.comp_name from comp as c where c.comp_code = '{$_POST['inv_RecieveID']}'),
p.remark_po='{$_POST['remark_po']}'

WHERE p.{$prefix_inv}id='{$_POST[$prefix_inv.'id']}'  ";

foreach($_POST[$prefix_inv.'order_no'] as $k=>$v){

$updateQuery[] = "
UPDATE {$prefix_inv}detail as pd 
set
    pd.`product_id`='{$_POST['product_ids'][$k]}',
    pd.`product_name`=(select c.product_name from product as c where c.product_code='{$_POST['product_ids'][$k]}'),
    pd.`quantity`='{$_POST['amounts'][$k]}',
    pd.`unit_price`='{$_POST['priceunits'][$k]}',
    pd.`amount`='{$_POST['totals'][$k]}'
WHERE pd.`{$prefix_inv}detail_no` = '{$v}'
";

}

$updateQuery = implode(";",$updateQuery).";";

//echo $updateQuery;
$conn->multi_query ($updateQuery);



header('location: '.$prefix_inv.'gen.php');