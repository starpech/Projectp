<?php
//delete.php
session_start();
$input_by = $_SESSION["mem_id"];
$comp_code = $_SESSION["comp_code"];
$input_date = date("Y-m-d");

//print_r($ids);
$ids = $_POST['id'];
$in_ids = @implode(",",$_POST['id']);
$sqlAll="";
global $connect;
$connect = mysqli_connect("localhost", "root", "kslitc@1234", "KMS_WEB_DB");
$insPrMainSQL = "";
$fyear = '6364';


// 

if(isset($_POST["id"]) )
{
	$insPrMainSQL = "
 insert into `pr_main` (`pr_SupplierID`,`pr_SupplierName`,`pr_DeliveryTo`,`pr_detail_no`,site_no)
(SELECT 
  r.comp_code,
  (select c.comp_name from comp as c where c.comp_code=r.comp_code) as pr_SupplierName,
  (select c.comp_addr from comp as c where c.comp_code in (select m.comp_code from members as m where m.mem_id = r.input_by)) as pr_DeliveryTo,
  group_concat(id_no) as pr_detail_no, '{$comp_code}' as site_no 
FROM `req_detail{$comp_code}` as r
where r.id_no in ({$in_ids})
group by  r.comp_code);


UPDATE req_detail{$comp_code} SET  approve_by = '{$input_by}', approve='Y' , approve_date = '{$input_date}' WHERE id_no in ({$in_ids}); 

"; // r.input_by,
 
 
 //echo $insPrMainSQL;
 mysqli_multi_query($connect, $insPrMainSQL);

}
