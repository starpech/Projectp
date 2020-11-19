<?php error_reporting(~E_ALL);?>

<?php require_once('php/connect.php');
include('includes/function.php');
$comp_code = $_SESSION["comp_code"];
$page_title = "แสดงรายการใบส่งของ";
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


function dbInvMain(){
  global $conn;
  $query="
  SELECT i.inv_id, 
  i.inv_date, 
  i.`inv_SupplierName`, 
  (select c.comp_name from comp as c where c.comp_code= i.`site_no`) as site_name, 
  (select sum(ind.amount) from inv_detail as ind where ind.inv_main_id = i.inv_no) as sumall 
  ,approved
  ,inv_RecieveName
  
  
  FROM `inv_main` as i
  where flag_delete = 0 and i.inv_RecieveID = '{$_SESSION['comp_code']}'
  ";
  $find_date = isset($_GET['findDate'])?$_GET['findDate']:'';
  if($find_date){

    $query .= " and DATE_FORMAT(inv_date,'%Y-%m-%d') = '{$find_date}' ";

  }
  $result = $conn->query($query);     
  if (!$result) {
    printf("Query failed: %s\n", $conn->error);
    exit;
  }      
  while($row = $result->fetch_array()) {
    $rows[]=$row;
  }
  $result->close();
  return $rows;

}

$dataInvMain = (dbInvMain());
//debug($dataInvMain);

 ?>
  <div class="container-fluid" align="center">
   <br>
   <h3 align="center"><?php echo $page_title ?></h3><br />
   <form>
      <input type="date" id="findDate" value="<?php echo $find_date ?>" /> <input type="button" id="find" value="ค้นหา"> <input type="button" id="find_all" value="ค้นหาทั้งหมด">
      <!-- <input type="button" id="printPDF" value="PDF"> -->
      </form> <br/>
   
   <div class="table-responsive">
   
    <table class="table table-bordered tb-req-list display"  style="width:100%">
    <thead width="100%" class="thead-light">
                <th ><h5 align="center">เลขที่ใบส่งของ</h5></th>
       <th ><h5 align="center">วันที่สั่งของ</h5></th>
       <th ><h5 align="center">บริษัทที่จัดส่ง</h5></th>
       <th ><h5 align="center">สถานที่ส่งสินค้า</h5></th>
       <th ><h5 align="center">จำนวน</h5></th>
	   <th ><h5 align="center">สถานะ</h5></th>
              <th></th>
           
            </thead>
            <tbody>
            
             <?php 
             if($dataInvMain)
             foreach($dataInvMain as $row ){
                 
				 
              $approved = "ยังไม่อนุมัติ";
              $btnApproved = '';
              if($row[5]){
                $approved = "<span class='text-success'>อนุมัติแล้ว</span>";
              }else{
                $btnApproved = " <a href='inv_approved.php?id=".$row[0]."' class='btn btn-primary btn-sm' > อนุมัติ </a>
                ";
              }
			  
			  if($_SESSION['comp_code']!='01') $btnApproved = '';
				 
                   echo "<tr>
                   <td> {$row[0]} </td>
                   <td> {$row[1]}</td>
                   <td> {$row[2]}</td>
                   <td> {$row['inv_RecieveName']}</td>
                   <td> ".number_format($row[4],2)."</td>
				   <td> {$approved} </td>
           <td>
           <a href='onlineinvoice/inv_pdf.php?id=".$row[0]."' target='_blank' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-edit'></span> PDF </a>

          
           </td>
				   
                   </tr>";
                   
               //  include "edit_delete_pr_gen.php";
               
             }

           
             ?>

            </tbody>
            </table>
   </div>
  
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
	   order: [[ 6 , "desc" ]]

 });

$('#find').click(()=>{
  var find_date=$('#findDate').val();
  window.location.href="inv_list.php?findDate="+find_date;
});
/*
$('#printPDF').click(()=>{
  var find_date=$('#findDate').val();
  var x = window.open("onlineinvoice/req_list_pdf.php?findDate="+find_date, '_blank');
  x.document.title = '<?php echo $page_title ?>';
}); 
*/

$('#find_all').click(()=>{
  window.location.href="inv_list.php";
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
