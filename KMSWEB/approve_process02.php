<?php
//delete.php
//session_start();
include_once "php/connect.php";
global $connect;
$connect = mysqli_connect("localhost", "root", "kslitc@1234", "KMS_WEB_DB");
$comp_code = $_SESSION["comp_code"];
//------- GEN AUTO PR_ID ------------
$sql = " select * from pr_main where pr_id is null and site_no = '{$comp_code}'; ";
$result_select = $conn->query($sql);
$CREATE_SQL_GEN_PR_ID = "";
while($row = $result_select->fetch_assoc()) {
   
   $CREATE_SQL_GEN_PR_ID .= "
   set @new_pr_id{$row['pr_no']} = (
    SELECT 
     concat(
      (select c.comp_nickname from comp as c where c.comp_code = x.site_no),
	  'PO',
      '6364',
      RIGHT(concat('00000',(CONVERT(RIGHT(IF(max(x.pr_id) is null , 'XXYYYY0000', max(x.pr_id)),4),int)+1)),4)
     )
    FROM `pr_main` as x where x.site_no = '{$comp_code}'  );

     update pr_main set pr_id = @new_pr_id{$row['pr_no']} where pr_no = {$row['pr_no']};
	 
	 
	 
   ";
   
}


//echo $CREATE_SQL_GEN_PR_ID;
//-----------------------------------

 $query = "SELECT pr_id,pr_no,pr_detail_no FROM pr_main WHERE pr_detail_add = 0;";

// update pr_id to REQ_DETAIL?? 
 $SET_PRID_TO_REQDETAIL = " 
UPDATE req_detail{$comp_code} AS r left join pr_main as m on ( concat(m.pr_detail_no,',') like concat('%',r.id_no,',%') and m.site_no = '{$comp_code}')
set r.pr_id = m.pr_id ,  r.status = 1 
where isnull(r.pr_id);

";
 
 $result = mysqli_query($connect, $query);
 //print_r($result);
 
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
FROM `req_detail{$comp_code}` as r
where r.id_no in ({$row['pr_detail_no']})
group by r.Product_code, r.Product_name, r.comp_code);

update pr_main set pr_detail_add=1 where pr_no = {$row['pr_no']};

    ";

 }
 mysqli_multi_query($connect, $CREATE_SQL_GEN_PR_ID.$SET_PRID_TO_REQDETAIL.$insPrDetailSQL);

 echo "ok";

?>