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

    <title>แก้ไขรายการส่งของ</title>
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
<?php 

// Create an instance of the class:
function dbInvDetail(){
  global $conn,$prefix_inv;
  $query = "
  SELECT * FROM `{$prefix_inv}detail` WHERE {$prefix_inv}main_id in (select x.{$prefix_inv}no from {$prefix_inv}main as x where x.{$prefix_inv}id = '{$_GET['id']}')";
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
function dbInvMain(){
  global $conn,$prefix_inv;
  $query="
  
  SELECT 

   p.{$prefix_inv}id,
   p.{$prefix_inv}date,
   p.`{$prefix_inv}SupplierID`,
   p.`{$prefix_inv}SupplierName`,
   (select c.comp_addr from comp as c where c.comp_code= p.`{$prefix_inv}SupplierID`) as SupplierAddr,

   (select c.comp_name from comp as c where c.comp_code= p.`site_no`) as site_name,
   (select c.comp_addr from comp as c where c.comp_code= p.`site_no`) as site_addr,

   (select sum(pd.amount) from {$prefix_inv}detail as pd where pd.{$prefix_inv}main_id = p.{$prefix_inv}no) as sumall,
   inv_RecieveID,
   remark_po


   FROM `{$prefix_inv}main` as p
 
   where p.{$prefix_inv}id = '{$_GET['id']}' and flag_delete = 0

  ";
  //echo $query;
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

$pr = dbInvMain();
print_r($pr);
$prDate = date('d/m/Y',strtotime($pr[1]));
$pd = dbInvDetail();



if(!isset($_SESSION['inv_sid'])){
  $_SESSION['inv_sid'] = $pr[2];
}
if(!isset($_SESSION['inv_rid'])){
  $_SESSION['inv_rid'] = $pr[8];
}



?>
<div class="container-fluid">
   <br><br><br><br><br>
   <h3 align="center">แก้ไขรายการส่งของ จากผู้จำหน่าย ถึง สถานที่รับสินค้า</h3><br />
   <h5 style="color:red" align="center">แก้ไขได้เฉพาะรายการยังไม่อนุมัติเท่านั้น  กรณีต้องการแก้ไขรายการที่อนุมัติแล้ว โปรดติดต่อผู้ดูแลระบบ</h5><br />

   <style>
.table td {
     padding:5px; 
}
</style>
   <form method="post"  action="<?php echo $prefix_inv?>edit.php">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
                <td colspan="2">
                  <div class="row">
                    <div class="col-md-8">
                      
                        <b>บริษัทผู้จำหน่ายที่ส่งของ</b><br />
                       <select id="supplier_id" name="supplier_id" class="form-control ">
                        
                        <?php 
                             $dataComp = dbComp('ผู้ขาย');
							 print_r($dataComp);
                             if($dataComp)
                             foreach($dataComp as $k=>$v){
                                if($v[1] == $pr[2]){
                                  echo "<option value='{$v[1]}' selected> {$v[1]} : {$v[2]} </option>";
                                }else{
                                 //echo "<option value='{$v[1]}'> {$v[1]} : {$v[2]} </option>";
                                }
                             }
                        ?>


                       </select>
                       
                       <b>ส่งถึงบริษัท</b><br />
                       <select id="inv_RecieveID" name="inv_RecieveID" class="form-control ">
                        
                        <?php 
                             $dataComp = dbComp('ผู้ซื้อ');
                             if($dataComp)
                             foreach($dataComp as $k=>$v){
                                if($v[1] == $pr[8]){
                                  echo "<option value='{$v[1]}' selected> {$v[1]} : {$v[2]} </option>";
                                }else{
                                 //echo "<option value='{$v[1]}'> {$v[1]} : {$v[2]} </option>";
                                }
                             }
                        ?>


                       </select>
                       หมายเหตุ<br/>
                      <input type="text" name="remark_po" id="remark_po" 
                      placeholder="หมายเหตุกรอกหมายเลข pr/po"
                      value="<?php echo $pr[9]?>" class="form-control input-sm"  />

                    </div>
                    <div class="col-md-4">
                      เลขที่ใบสั่งซื้อ<br />
                      <input type="text" name="<?php echo $prefix_inv?>id" id="<?php echo $prefix_inv?>id" value="<?php echo $pr[0]?>" class="form-control input-sm" placeholder="" readonly/>
                      วันที่สั่งซื้อ<br/>
                      <input type="text" name="<?php echo $prefix_inv?>date" id="order_date" value="<?php echo $pr[1]?>" class="form-control input-sm" readonly placeholder="Select Invoice Date" />
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
                        echo ' <input type="hidden" name="'.$prefix_inv.'order_no[]" value="'.$v[0].'" />';
                        echo " <tr>
                        <td width=\"5%\">".($k+1)."</td>
                        <td width=\"45%\"> ".selectProductsEditInv("product_ids",$v[3],$k)."</td>
                        <td width=\"15%\"><input type='number' onkeyup=\"calcPrice('{$k}',$(this),1)\" class='form-control'  id=unit_{$k} name='amounts[]' value='{$v[5]}' step='0.01'/></td>
                        <td width=\"15%\"><input type='number' onkeyup=\"calcPrice('{$k}',$(this),0)\" onblur=\"calcPrice('{$k}',$(this),0)\"  class='form-control'  step='0.01' id=price_{$k} name='priceunits[]' value='{$v[6]}' /></td>
                        <td width=\"15%\"><input type='number' class='form-control total' id=total_{$k} name='totals[]' value='{$v[8]}'  step='0.01' readonly /></td>
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
                <div>จำนวนเงินทั้งหมด <span id='sumtotal' style="color:red;">00.00</span> บาท</div>
                                   <input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-info" value="แก้ไขรายการสั่งซื้อ" />
                                   <button type="button" onclick="window.history.back()" class="btn btn-warning"> กลับไปเมนูก่อนหน้า </button>

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


function calcPrice(key,obj,type=1){
  let objPrice = $('#price_'+key);
  let objTotal = $('#total_'+key);
  let objUnit  = $('#unit_'+key)
  if(type)
  objTotal.val( parseFloat(obj.val())*parseFloat(objPrice.val()) )
  else 
  objTotal.val( parseFloat(obj.val())*parseFloat(objUnit.val()) )
  sumTotal();
}
sumTotal();
function sumTotal(){
  let sum = 0;
  $(".total").each(function() {
    sum += parseFloat(this.value) || 0;
  });

  $('#sumtotal').text(sum.toFixed(2));
}

    </script>

</body>

</html>
