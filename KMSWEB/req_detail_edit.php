<?php 
require_once "php/connect.php";
$p = $_POST;
debug($p);

$comp_code_n = (int)$p['comp_code'];

$query = "

update  req_detail{$p['comp_code']}  as d

set 

    d.`Quota_id`= '{$p['quota_id']}',
    d.`Quota_name`= '{$p['quota_name']}',
    d.`Quota_ket` = '{$p['quota_ket']}',
    d.`Quota_place` =  '{$p['quota_place']}',
    d.`comp_code` =  '{$p['comp_code']}',
    d.`Product_code` = '{$p['product_code']}',
    d.`Product_name` = (select x.product_name from product as x where x.product_code = '{$p['product_code']}'),
    d.`Product_amount` = '{$p['product_amount']}',
    d.`Product_price` = (select x.product_price{$comp_code_n} from product as x where x.product_code = '{$p['product_code']}'),
    d.`Product_total` = ((select x.product_price{$comp_code_n} from product as x where x.product_code = '{$p['product_code']}')*{$p['product_amount']})

where d.req_detail_id = '{$p['req_detail_id']}';    

";

//echo $query;

$conn->query($query);

header('location: req_edit.php');