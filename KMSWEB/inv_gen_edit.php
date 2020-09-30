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
  include('includes/navbar_sale.php')
?>

<!---  CONTENT----->
<?php 

// Create an instance of the class:
function dbPrDetail(){
  global $conn;
  $query = "
  SELECT * FROM `pr_detail` WHERE pr_main_id in (select x.pr_no from pr_main as x where x.pr_id = '{$_GET['id']}')";
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
function dbPrMain(){
  global $conn;
  $query="
  
  SELECT 

   p.pr_id,
   p.pr_date,
   p.`pr_SupplierID`,
   p.`pr_SupplierName`,
   (select c.comp_addr from comp as c where c.comp_code= p.`pr_SupplierID`) as SupplierAddr,

   (select c.comp_name from comp as c where c.comp_code= p.`site_no`) as site_name,
   (select c.comp_addr from comp as c where c.comp_code= p.`site_no`) as site_addr,

   (select sum(pd.amount) from pr_detail as pd where pd.pr_main_id = p.pr_no) as sumall

   FROM `pr_main` as p
 
   where p.pr_id = '{$_GET['id']}' and flag_delete = 0

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
  return $rows[0];

}

$pr = dbPrMain();
$prDate = date('d/m/Y',strtotime($pr[1]));
$pd = dbPrDetail();


function dbComp(){
  global $conn;
  $query = "
  SELECT * FROM comp order by comp_code";
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
function dbProduct(){
  global $conn;
  $query = "
  SELECT * FROM product where comp_code = '{$_SESSION["comp_code"]}' order by product_id";
  $query = "
  SELECT * FROM product where 1=1 order by product_code";
  
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

function selectProducts($id,$value=''){
  $htmlSelectProduct ="<select id='{$id}' name='{$id}[]' class=\"form-control\">%s</select>";
  $op='';
  $data = dbProduct();

  if($data)
  foreach($data as $k=>$v){
    if($v[5] == $value){
      $op .= "<option value='{$v[5]}' selected> {$v[5]} : {$v[2]} </option>";
    }else{
      $op .= "<option value='{$v[5]}'> {$v[5]} : {$v[2]} </option>";
    }
  }
  return sprintf($htmlSelectProduct,$op);
}



?>
<div class="container-fluid">
   <br><br><br><br><br>
   <h3 align="center">แก้ไขรายการขอซื้อ</h3><br />
   <h5 style="color:red" align="center">แสดงเฉพาะรายการยังไม่อนุมัติเท่านั้น  กรณีต้องการแก้ไขรายการที่อนุมัติแล้ว โปรดติดต่อผู้ดูแลระบบ</h5><br />

  
   <form method="post"  action="pr_edit.php">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
                <td colspan="2">
                  <div class="row">
                    <div class="col-md-8">
                      
                        <b>บริษัทที่สั่งซื้อ</b><br />
                       <select id="supplier_id" name="supplier_id" class="form-control ">
                        
                        <?php 
                             $dataComp = dbComp();
                             if($dataComp)
                             foreach($dataComp as $k=>$v){
                                if($v[1] == $pr[2]){
                                  echo "<option value='{$v[1]}' selected> {$v[1]} : {$v[2]} </option>";
                                }else{
                                 echo "<option value='{$v[1]}'> {$v[1]} : {$v[2]} </option>";
                                }
                             }
                        ?>


                       </select>
                    </div>
                    <div class="col-md-4">
                      เลขที่ใบสั่งซื้อ<br />
                      <input type="text" name="pr_id" id="pr_id" value="<?php echo $pr[0]?>" class="form-control input-sm" placeholder="" readonly/>
                      วันที่สั่งซื้อ<br/>
                      <input type="text" name="pr_date" id="order_date" value="<?php echo $pr[1]?>" class="form-control input-sm" readonly placeholder="Select Invoice Date" />
                    </div>
                  </div>
                  <br />
                  <table id="invoice-item-table" class="table table-bordered">
                    <tr>
                      <th width="7%">ลำดับ</th>
                      <th width="20%">รายการสินค้า</th>
                      <th width="5%">จำนวนส่ง</th>
                      <th width="5%">ราคาต่อหน่วย</th>
                      <th width="10%">จำนวนเงิน</th>
                    </tr>
                    
                   <?php 
                      if($pd)
                      foreach($pd as $k=>$v){
                        echo ' <input type="hidden" name="pr_order_no[]" value="'.$v[0].'" />';
                        echo " <tr>
                        <td width=\"5%\">".($k+1)."</td>
                        <td width=\"45%\"> ".selectProducts("product_ids",$v[3])."</td>
                        <td width=\"15%\"><input type='number' onkeyup=\"calcPrice('{$k}',$(this))\" class='form-control'  name='amounts[]' value='{$v[5]}' /></td>
                        <td width=\"15%\"><input type='number' class='form-control' id=price_{$k} name='priceunits[]' value='{$v[6]}' /></td>
                        <td width=\"15%\"><input type='number' class='form-control' id=total_{$k} name='totals[]' value='{$v[8]}' readonly /></td>
                      </tr>";
                      }
                   ?>


                  </table>
                </td>
              </tr>
              
              <tr>
                <td colspan="2"></td>
              </tr>
              <tr>
                <td colspan="2" align="center">
                 
                                   <input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-info" value="แก้ไขรายการสั่งซื้อ" />
                </td>
              </tr>
          </table>
        </div>
      </form>
   
  

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

<!-- Datepicker -->
<link href='assets\admin\plugins\datepicker\datepicker3.css' rel='stylesheet' type='text/css'>
<script src='assets\admin\plugins\datepicker\bootstrap-datepicker.js' type='text/javascript'></script>
<script>
      $(document).ready(function(){
        $('#order_date').datepicker({
          format: "yyyy-mm-dd",
          autoclose: true
        });
      });


function calcPrice(key,obj){
  let objPrice = $('#price_'+key);
  let objTotal = $('#total_'+key);

  objTotal.val( parseFloat(obj.val())*parseFloat(objPrice.val()) )

 // console.log(key + ' ' +obj.val())
}

    </script>

</body>

</html>
