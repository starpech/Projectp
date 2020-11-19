<?php error_reporting(~E_ALL);?>

<?php require_once('php/connect.php');
include('includes/function.php');
$comp_code = $_SESSION["comp_code"];
$mem_id = $_SESSION["mem_id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>



<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css"> <!--เรียกbootstrap -->
    <link rel="stylesheet" href="node_modules/font-awesome5/css/fontawesome-all.css"> <!--เรียกfontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
    <link rel="stylesheet" href="node_modules/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/css/flag-icon.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
	  
   
    <!-- DataTables -->
  <link rel="stylesheet" href="assets/admin/plugins/datatables/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/admin/plugins/responsive/responsive.bootstrap4.min.css"><!-- responsive-->

    <title>แก้ไขรายการขอซื้อ</title>
</head>

<?php
  session_start();
  if($_SESSION["mem_status"]=="operator"){
        include('includes/navbar_operator.php'); }
  elseif($_SESSION["mem_status"]=="approver"){
        include('includes/navbar_approver.php'); }
  elseif($_SESSION["mem_status"]=="officer"){
        include('includes/navbar_officer.php'); }
  elseif($_SESSION["mem_status"]=="sale"){
        include('includes/navbar_sale.php'); }
  elseif($_SESSION["mem_status"]=="acc"){
        include('includes/navbar_acc.php'); }
  elseif($_SESSION["mem_status"]=="plant"){
        include('includes/navbar_plant.php'); }
        elseif($_SESSION["mem_status"]=="admin"){
          include('includes/navbar_admin.php'); }
  else { include('includes/navbar.php'); }
?>

<!---  CONTENT----->

<div class="container-fluid">
   <br><br><br><br><br>
   <h3 align="center">แก้ไขรายการขอซื้อ</h3><br />
   <h5 style="color:red" align="center">แสดงเฉพาะรายการยังไม่อนุมัติเท่านั้น  กรณีต้องการแก้ไขรายการที่อนุมัติแล้ว โปรดติดต่อผู้ดูแลระบบ</h5><br />

   <table id="dataTable" class="table table-bordered table-striped w-100 ">
            <thead>
            <tr>
            <th width="15%"><h5 align="center">เลขที่โควตา</h5></th>
       <th width="20%"><h5 align="center">ชื่อ - นามสกุล</h5></th>
       <th width="10%"><h5 align="center">เขต</h5></th>
       <th width="15%"><h5 align="center">สถานที่จัดส่ง</h5></th>
       <th width="25%"><h5 align="center">ชื่อสินค้า</h5></th>
       <th width="10%"><h5 align="center">จำนวน</h5></th>
              <!--<th>More</th>-->
              <th style="width:100px"><a href="req_order.php" class="btn btn-info"><i class="fas fa-plus-square"></i> เพิ่มรายการขอซื้อ</a></th>
            </tr>
            </thead>
            <tbody>
            
             <?php 
             // $sql = "
             // SELECT `id_no`, `req_id`, `req_comp_code`, `input_date`, `input_by`, `Quota_id`, `Quota_name`, `Quota_ket`, `Quota_place`, `Product_code`, `Product_name`, `Product_amount`, `Product_price`, `status` FROM `req_detail02`
             // ";
        $sql = "SELECT * FROM req_detail{$comp_code} WHERE (ISNULL(approve_date)) AND (input_by = '{$mem_id}')"; 
        //echo $sql;
        //print_r($_SESSION);
        $result = mysqli_query($conn, $sql);
             if(mysqli_num_rows($result)>0){
               while($row=mysqli_fetch_array($result)){
                 
                   echo "<tr>
                   <td> {$row['Quota_id']} </td>
                   <td> {$row['Quota_name']}</td>
                   <td> {$row['Quota_ket']}</td>
                   <td> {$row['Quota_place']}</td>
                   <td> {$row['Product_name']}</td>
                   <td> {$row['Product_amount']}</td>
                   <td> 
                   <a href='#edit_".$row['req_detail_id']."' class='btn btn-success btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> แก้ไข</a>

                   <a href='#delete_".$row['req_detail_id']."' class='btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> ลบ</a>
                   
                   </td>
                   </tr>";
                   
                 include "edit_delete_req_detail.php";
               }
             }
             ?>

            </tbody>
            </table>



</div>
<!--- END CONTENT----->

<!-- jQuery -->
<script src="assets/admin/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="node_modules/jquery-datatables/jquery.dataTables.min.js"></script>
<script src="assets/admin/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="assets/admin/plugins/responsive/dataTables.responsive.min.js"></script> <!-- responsive-->

<script>
  
  $('#dataTable').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "responsive": true
  });

</script>

</body>

</html>
