<?php error_reporting(~E_ALL);?>

<?php require_once('php/connect.php');
include('includes/function.php');
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
  include('includes/navbar_operator.php')
?>

<!---  CONTENT----->
<?php 

function dbPrMain(){
  global $conn;
  $query="
  SELECT p.pr_id, p.pr_date, p.`pr_SupplierName`, (select c.comp_name from comp as c where c.comp_code= p.`site_no`) as site_name, (select sum(pd.amount) from pr_detail as pd where pd.pr_main_id = p.pr_no) as sumall FROM `pr_main` as p
  where flag_delete = 0
  ";
  $result = $conn->query($query);     
  if (!$result) {
    printf("Query failed: %s\n", $conn->error);
    exit;
  }      
  while($row = $result->fetch_row()) {
    $rows[]=$row;
  }
  $result->close();
  return $rows;

}

$dataPrMain = (dbPrMain());


?>
<div class="container-fluid">
   <br><br><br><br><br>
   <h3 align="center">รายการใบสั่งซื้อ</h3><br />
   

   <table id="dataTable" class="table table-bordered table-striped w-100 ">
            <thead>
            <tr>
            <th width="15%"><h5 align="center">เลขที่ใบสั่งซื้อ</h5></th>
       <th width="20%"><h5 align="center">วันที่สั่งซื้อ</h5></th>
       <th width="10%"><h5 align="center">บริษัทที่สั่งซื้อ</h5></th>
       <th width="15%"><h5 align="center">สถานที่ส่งสินค้า</h5></th>
       <th width="10%"><h5 align="center">จำนวน</h5></th>
              <!--<th>More</th>-->
              <th style="width:100px"><a href="pr_gen_create.php" class="btn btn-info"><i class="fas fa-plus-square"></i> สร้างรายการขอซื้อ</a></th>
            </tr>
            </thead>
            <tbody>
            
             <?php 
             if($dataPrMain)
             foreach($dataPrMain as $row ){
                 
                   echo "<tr>
                   <td> {$row[0]} </td>
                   <td> {$row[1]}</td>
                   <td> {$row[2]}</td>
                   <td> {$row[3]}</td>
                   <td> ".number_format($row[4],2)."</td>
                   <td>
                   <a href='onlineinvoice/pr_pdf.php?id=".$row[0]."' target='_blank' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-edit'></span> PDF </a>
 
                   <a href='pr_gen_edit.php?id=".$row[0]."' class='btn btn-success btn-sm' ><span class='glyphicon glyphicon-edit'></span> แก้ไข</a>
                   <a href='#delete_".$row[0]."' class='btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> ลบ</a>
                   </td>
                   </tr>";
                   
                 include "edit_delete_pr_gen.php";
               
             }
             ?>

            </tbody>
            </table>

<?php //print "<pre>"; print_r($dataPrMain); print "</pre>"; ?>

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
