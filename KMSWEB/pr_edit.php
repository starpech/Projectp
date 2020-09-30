<?php 
require_once 'php/connect.php';
debug($_POST);
$updateQuery = array();
$updateQuery[] = "
UPDATE `pr_main` as p set 
p.`pr_date`='{$_POST['pr_date']}',
p.`pr_SupplierID`= '{$_POST['supplier_id']}',
p.`pr_SupplierName` = (select c.comp_name from comp as c where c.comp_code = '{$_POST['supplier_id']}')
WHERE p.pr_id='{$_POST['pr_id']}'  ";

foreach($_POST['pr_order_no'] as $k=>$v){

$updateQuery[] = "
UPDATE pr_detail as pd 
set
    pd.`product_id`='{$_POST['product_ids'][$k]}',
    pd.`product_name`=(select c.product_name from product as c where c.product_code='{$_POST['product_ids'][$k]}'),
    pd.`quantity`='{$_POST['amounts'][$k]}',
    pd.`unit_price`='{$_POST['priceunits'][$k]}',
    pd.`amount`='{$_POST['totals'][$k]}'
WHERE pd.`pr_detail_no` = '{$v}'
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

header('location: pr_gen.php');