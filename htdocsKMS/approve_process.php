<?php
//delete.php
session_start();
$input_by = $_SESSION["mem_id"];
$comp_code = $_SESSION["comp_code"];
$input_date = date("Y-m-d");
$ids = @implode(",",$_POST['id']);
$sqlAll="";
global $connect;
$connect = mysqli_connect("localhost", "root", "", "KMS_WEB_DB");

if(isset($_POST["id"]) )
{
 // add pr_main
    $insPrMainSQL = "
 insert into `pr_main` (`pr_SupplierID`,`pr_SupplierName`,`pr_DeliveryTo`,`pr_detail_no`)
(SELECT 
  r.comp_code,
  (select c.comp_name from comp as c where c.comp_code=r.comp_code) as pr_SupplierName,
  (select c.comp_addr from comp as c where c.comp_code in (select m.comp_code from members as m where m.mem_id = r.input_by)) as pr_DeliveryTo,
  group_concat(id_no) as pr_detail_no
FROM `req_detail` as r
where r.id_no in ({$ids})
group by r.input_by, r.comp_code);

UPDATE req_detail SET approve_by = '{$input_by}', approve='Y' ,approve_date = '{$input_date}' WHERE id_no in ({$ids});

 ";
 mysqli_multi_query($connect, $insPrMainSQL);

}
