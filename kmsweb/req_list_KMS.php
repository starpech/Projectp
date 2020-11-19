<?php error_reporting(~E_ALL);?>

<?php require_once('php/connect.php');
include('includes/function.php');
$comp_code = $_SESSION["comp_code"];
$page_title = "แสดงรายการขอซื้อทั้งหมด";
$find_date = isset($_GET['findDate'])?$_GET['findDate']:'';
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
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">

    <title><?php echo $page_title ?></title>
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
<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet"/>
<div class="container-fluid">
   <br><br><br><br><br>
<?php 
if($comp_code =="01"){
   if($find_date)
     $query = "(SELECT *,ISNULL(approve_date) as 'status'  FROM req_detail01 where input_date = '{$find_date}' order by ISNULL(approve_date)) UNION
               (SELECT *,ISNULL(approve_date) as 'status'  FROM req_detail02 where input_date = '{$find_date}' order by ISNULL(approve_date)) UNION
               (SELECT *,ISNULL(approve_date) as 'status'  FROM req_detail03 where input_date = '{$find_date}' order by ISNULL(approve_date)) UNION
               (SELECT *,ISNULL(approve_date) as 'status'  FROM req_detail04 where input_date = '{$find_date}' order by ISNULL(approve_date)) UNION
               (SELECT *,ISNULL(approve_date) as 'status'  FROM req_detail05 where input_date = '{$find_date}' order by ISNULL(approve_date)) UNION
               (SELECT *,ISNULL(approve_date) as 'status'  FROM req_detail06 where input_date = '{$find_date}' order by ISNULL(approve_date))" ; //WHERE ISNULL(approve_date)
   else 
     $query = "(SELECT *,ISNULL(approve_date) as 'status'  FROM req_detail01 order by ISNULL(approve_date)) UNION
               (SELECT *,ISNULL(approve_date) as 'status'  FROM req_detail02 order by ISNULL(approve_date)) UNION
               (SELECT *,ISNULL(approve_date) as 'status'  FROM req_detail03 order by ISNULL(approve_date)) UNION
               (SELECT *,ISNULL(approve_date) as 'status'  FROM req_detail04 order by ISNULL(approve_date)) UNION
               (SELECT *,ISNULL(approve_date) as 'status'  FROM req_detail05 order by ISNULL(approve_date)) UNION
               (SELECT *,ISNULL(approve_date) as 'status'  FROM req_detail06 order by ISNULL(approve_date))" ; //WHERE ISNULL(approve_date)
    $result = mysqli_query($conn, $query);
}
else{
if($find_date)
  $query = "SELECT *,ISNULL(approve_date) as 'status'  FROM req_detail{$comp_code} where input_date = '{$find_date}' order by ISNULL(approve_date) " ; //WHERE ISNULL(approve_date)
else 
$query = "SELECT *,ISNULL(approve_date) as 'status'  FROM req_detail{$comp_code} order by ISNULL(approve_date) " ; //WHERE ISNULL(approve_date)
$result = mysqli_query($conn, $query);
};
 //echo date('Y-m-d')
 ?>
  <div class="container-fluid" align="center">
   <br>
   <h3 align="center"><?php echo $page_title ?></h3><br />
   <form>
      <input type="date" id="findDate" value="<?php echo $find_date ?>" /> <input type="button" id="find" value="ค้นหา"> <input type="button" id="find_all" value="ค้นหาทั้งหมด"> <input type="button" id="printPDF" value="PDF">
      </form> <br/>
   <?php
   if(mysqli_num_rows($result) > 0)
   {
   ?>
   <div class="table-responsive">
   <!--<button type="button" name="x" id="selectAll" class="btn btn-danger">SelectAll</button>
   <button type="button" name="y" id="clearAll" class="btn btn-danger">ClearAll</button> -->
    <table class="table table-bordered tb-req-list display"  style="width:100%">
    <thead width="100%" class="thead-light">
      <th>วันที่</th>
	  <th>หมายเลข</th>
      <th>เลขใบสั่งซื้อ</th>
      <th>โค้วต้าชาวไร่</th>
      <th>ชื่อนามสกุล</th>
      <th>เขตชาวไร่</th>
      <th>สถานที่จัดส่ง</th>
      <th>ชื่อสินค้า</th>
      <th>สถานะอนุมัติ</th>
      <th>สถานะจัดส่ง</th>
      <th>จำนวน</th>
     </thead>
     <tbody>

     
   <?php
    while($row = mysqli_fetch_array($result))
    {
		//debug($row);
      $sentProduct= "รอจัดส่ง";
      $btnSentProduct = '';
   if($row['status']*1===2){
   $sentProduct = "<span class='text-success'>จัดส่งเรียบร้อย</span>";
   }else{
   $btnSentProduct = " <a href='req_sent.php?id=".$row['req_detail_id']."' class='btn btn-success btn-sm' > จัดส่งแล้ว </a>
   ";
   }

   ?>
     <tr id="<?php echo $row["id_no"]; ?>" >
      <td><?php echo date('d/m/Y',strtotime($row["input_date"])); ?></td>
	  <td><?php echo $row["req_detail_id"]; ?></td>
    <td><?php echo $row["pr_id"]; ?></td>
      <td><?php echo $row["Quota_id"]; ?></td>
      <td><?php echo $row["Quota_name"]; ?></td>
      <td><?php echo $row["Quota_ket"]; ?></td>
      <td><?php echo $row["Quota_place"]; ?></td>
      <td><?php echo $row["Product_name"]; ?></td>
      <td><?php echo ($row["status"])?"<span style=\"color:red\"> no approved </span>":"<span style=\"color:green\"> approved </span>" ?></td>
      <td><?php echo $sentProduct ?></td>
      <td><?php echo $row["Product_amount"]; ?></td>
     </tr>
   <?php
    }
   ?>
   </tbody>
    </table>
   </div>
   <?php
   }
   ?>
   <div align="center">
   <!-- <button type="button" name="btn_approve" id="btn_approve" class="btn btn-success">Approve</button> -->
   </div>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
   <script src="node_modules/jquery/dist/jquery.min.js"></script><!--เรียกjquery -->
<script src="node_modules/popper.js/dist/umd/popper.min.js"></script><!--เรียกpopper -->
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script><!--เรียกbootstrap.min.js -->
<script src="node_modules/jquery-validation/dist/jquery.validate.min.js"></script><!--เรียกjquery.validate -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="pdfmake-thai-master/build/pdfmake.min.js"></script>
<script src="pdfmake-thai-master/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>

<script>
//pdfMake.addVirtualFileSystem(pdfFonts);

pdfMake.fonts = {
   THSarabun: {
     normal: 'THSarabunNew.ttf',
     bold: 'THSarabunNew-Bold.ttf',
     italics: 'THSarabunNew-Italic.ttf',
     bolditalics: 'THSarabunNew-BoldItalic.ttf'
   }
}

  $('.tb-req-list').DataTable({ 
	  
	   dom: 'Bfrtip',
        buttons: [
          'excelHtml5',
          {extend: 'pdf',text: 'Export PDF',exportOptions: {columns: ':visible'},                    
            customize: function (doc) {        
              doc.defaultStyle.fontSize = 10;
              doc.defaultStyle = {
                font:'THSarabun',
                fontSize:10
              }
            
            }
            }
        ],
	   order: [[ 0 , "desc" ]]

 });

$('#find').click(()=>{
  var find_date=$('#findDate').val();
  window.location.href="req_list.php?findDate="+find_date;
});

$('#printPDF').click(()=>{
  var find_date=$('#findDate').val();
  var x = window.open("onlineinvoice/req_list_pdf.php?findDate="+find_date, '_blank');
  x.document.title = '<?php echo $page_title ?>';

});

$('#find_all').click(()=>{
  window.location.href="req_list.php";
});

</script>
</div>



<!--- END CONTENT----->


 <?php 
 include('includes/footer.php');
  ?>

  <!-- PASTE HERE -->
  <script>
    $(document).ready(function() {

     // $('.tb-req-list').DataTable();

    });
  </script>
  <!-- PASTE HERE -->


</body>

</html>
