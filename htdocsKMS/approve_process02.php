<?php
//delete.php
session_start();
global $connect;
$connect = mysqli_connect("localhost", "root", "", "KMS_WEB_DB");


 $query = "SELECT pr_no,pr_detail_no FROM pr_main WHERE pr_detail_add = 0;";
 $result = mysqli_query($connect, $query);
 print_r($result);
 
 $insPrDetailSQL="";
 //if(mysqli_num_rows($result) > 0)
 while($row = mysqli_fetch_array($result))
 { 
    $insPrDetailSQL .= "
    insert into pr_detail (pr_main_id,product_id,product_name,quantity,unit_price,amount,unit)
(SELECT 
'{$row['pr_no']}' as pr_main_id,
r.Product_code, 
r.Product_name, 
sum(r.Product_amount) as Product_amount, 
avg(r.Product_price) as Product_price, 
sum(r.Product_total) as Product_total ,
(SELECT p.product_unit FROM `product` as p WHERE p.product_code = r.product_code ) as unit
FROM `req_detail` as r
where r.id_no in ({$row['pr_detail_no']})
group by r.Product_code, r.Product_name, r.comp_code);

update pr_main set pr_detail_add=1 where pr_no = {$row['pr_no']};

    ";

 }
 mysqli_multi_query($connect, $insPrDetailSQL);

 echo "ok";

?>