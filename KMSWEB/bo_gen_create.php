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

    <title>สร้างรายการใบวางบิล</title>
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
  else { include('includes/navbar.php'); }
?>

<!---  CONTENT----->
<div class="container-fluid">
   <br><br><br><br><br>
   <h3 align="center">สร้างรายการใบวางบิล</h3><br />
   <!--<h5 style="color:red" align="center">แสดงเฉพาะรายการยังไม่อนุมัติเท่านั้น  กรณีต้องการแก้ไขรายการที่อนุมัติแล้ว โปรดติดต่อผู้ดูแลระบบ</h5><br />-->

  
   <form method="post"  action="<?php echo $prefix_po?>create.php">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
                <td colspan="2">
                  <div class="row">
                    <div class="col-md-8">
                      
                        <b>บริษัทที่ส่งของ</b><br />
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
                       
                       <b>ส่งถึงบริษัท</b><br />
                       <select id="bo_RecieveID" name="bo_RecieveID" class="form-control ">
                        
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
                       หมายเหตุ<br/>
                      <input type="text" name="remark_inv" id="remark_inv" 
                      placeholder="หมายเหตุกรอกหมายเลขใบส่งของที่จะวางบิล"
                      value="<?php echo $pr[1]?>" class="form-control input-sm"  />
                    </div>
                    <div class="col-md-4">
                      วันที่ส่งของ<br/>
                      <input type="text" name="<? echo $prefix_po?>date" id="order_date" value="<?php echo $pr[1]?>" class="form-control input-sm" readonly placeholder="Select Invoice Date" />
                    </div>
                  </div>
                  <br />
                  <table id="invoice-item-table" class="table table-bordered table-pr">
                    <tr>
                      <th width="45%">รายการสินค้า</th>
                      <th width="15%">จำนวนส่ง</th>
                      <th width="15%">ราคาต่อหน่วย</th>
                      <th width="15%">จำนวนเงิน</th>
                      <th> <button type="button" align="left" name="add1" class="btn btn-success btn-sm add1" alt=""><i class="fa fa-plus"></i></button> </th>
                    </tr>
                    
                 


                  </table>
                </td>
              </tr>
              
              <tr>
                <td colspan="2"></td>
              </tr>
              <tr>
              <td colspan="2" align="center">
                <input type="hidden" name="comp_code" value="<?php echo $_SESSION["comp_code"]?>" />
                 <div>จำนนเงินทั้งหมด <span id='sumtotal' style="color:red;">00.00</span> บาท</div>
                                   <input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-info" value="สร้างรายการส่งของ" />
              
                                   <button type="button" onclick="window.history.back()" class="btn btn-warning"> กลับไปเมนูก่อนหน้า </button>

                </td>
              </tr>
          </table>
        </div>
      </form>
   
      <style>
.table td {
     padding:5px; 
}
</style>

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

function sumTotal(){
  let sum = 0;
  $(".total").each(function() {
    sum += parseFloat(this.value) || 0;
  });

  $('#sumtotal').text(sum.toFixed(2));
}

 function jSelectProduct(key,obj){
   let objPrice = $('#price_'+key);
   let val = obj.val().split('|');
   objPrice.val(val[1]);
}

function add_new_row(){
  var new_row=  " <tr> "+
                "<td width=\"45%\"> <select id='product_"+num_row+"' onchange=\"jSelectProduct('"+num_row+"',$(this))\" name='products[]' class=\"form-control\"><?php echo selectProducts() ?></select></td>" +
                "<td width=\"15%\"><input type='number' onkeyup=\"calcPrice('"+num_row+"',$(this),1)\" class='form-control' id=unit_"+num_row+" name='amounts[]' value='' /></td>" +
                "<td width=\"15%\"><input type='number' onkeyup=\"calcPrice('"+num_row+"',$(this),0)\" class='form-control' id=price_"+num_row+" name='priceunits[]' value='' /></td>" +
                "<td width=\"15%\"><input type='number' class='form-control total' id=total_"+num_row+" name='totals[]' value='' readonly /></td>" +
                "<td> <button type='button' name='remove' class='btn btn-danger btn-sm remove remove_"+num_row+"'><i class='fa fa-minus'></i></button></td>" +
                "</tr>";
  

num_row++;
$('.table-pr').append(new_row);
}


var num_row = 0;
add_new_row();
$('.add1').click(function(){
  //alert("xxx");
  add_new_row();
});



$(document).on('click', '.remove', function() {
        $(this).closest('tr').remove();
        sumTotal();
      });
    </script>

</body>

</html>