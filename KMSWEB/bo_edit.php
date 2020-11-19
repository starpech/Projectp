<?php 
require_once 'php/connect.php';
debug($_POST);
$updateQuery = array();
$updateQuery[] = "
UPDATE `{$prefix_po}main` as p set 
p.`{$prefix_po}date`='{$_POST[$prefix_po.'date']}',
p.`{$prefix_po}SupplierID`= '{$_POST['supplier_id']}',
p.`{$prefix_po}SupplierName` = (select c.comp_name from comp as c where c.comp_code = '{$_POST['supplier_id']}'),

p.bo_RecieveID='{$_POST['bo_RecieveID']}',
p.bo_RecieveName=(select c.comp_name from comp as c where c.comp_code = '{$_POST['bo_RecieveID']}'),
p.remark_inv='{$_POST['remark_inv']}'


WHERE p.{$prefix_po}id='{$_POST[$prefix_po.'id']}'  ";

foreach($_POST[$prefix_po.'order_no'] as $k=>$v){

$_POST['product_ids'][$k] = explode("|",$_POST['product_ids'][$k]);
$_POST['product_ids'][$k] = $_POST['product_ids'][$k][0];


$updateQuery[] = "
UPDATE {$prefix_po}detail as pd 
set
    pd.`product_id`='{$_POST['product_ids'][$k]}',
    pd.`product_name`=(select c.product_name from product as c where c.product_code='{$_POST['product_ids'][$k]}'),
    pd.`quantity`='{$_POST['amounts'][$k]}',
    pd.`unit_price`='{$_POST['priceunits'][$k]}',
    pd.`amount`='{$_POST['totals'][$k]}'
WHERE pd.`{$prefix_po}detail_no` = '{$v}'
";

}

$updateQuery = implode(";",$updateQuery).";";

$conn->multi_query ($updateQuery);


/*
 UPDATE `pr_main` as p set 
    p.`pr_date`='2020-09-28',
    p.`pr_SupplierID`= '08',
    p.`pr_SupplierName` = (select c.comp_name from comp as c where c.comp_code = '08')
WHERE p.pr_id='NP63640002' ;
 */

/*
UPDATE pr_detail as pd 
set
    pd.`product_id`='xxxx',
    pd.`product_name`=(select c.product_name from product as c where c.product_code='xxx'),
    pd.`quantity`='',
    pd.`unit_price`='',
    pd.`amount`=''
WHERE pd.`pr_detail_no` = '2';

*/
//$query = "update pr_main set flag_delete = 1 where pr_id  = '{$_GET['id']}' ";
//$conn->query($query);
//echo "<script>alert('แก้ไขเรียบร้อย');</script>";

header('location: '.$prefix_po.'gen.php');