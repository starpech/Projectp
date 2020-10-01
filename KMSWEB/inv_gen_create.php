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

    <title>สร้างใบส่งสินค้า</title>
</head>

<?php 
  include('includes/navbar_sale.php')
?>

<!---  CONTENT----->
<?php 

function dbComp(){
  global $conn;
  $query = "SELECT * FROM comp order by comp_code";
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
 $my_comp_code = (int)$_SESSION["comp_code"];
  $query = "SELECT *, product_price{$my_comp_code} as product_price FROM product where comp_code = '{$_SESSION["comp_code"]}' order by product_id";
  $query = "SELECT * , product_price{$my_comp_code} as product_price FROM product where 1=1 order by product_code";
  
  //echo ":::".$query;

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

function selectProducts(){
  //$htmlSelectProduct ="<select id='{$id}' onchange=\"jSelectProduct('{$key}',$(this))\" name='{$id}[]' class=\"form-control\">%s</select>";
  $op="<option val='' selected> -กรุณาเลือกสินค้า- </option>";
  $htmlSelectProduct ="%s";
  $data = dbProduct();

  if($data)
  foreach($data as $k=>$v){
    
      $op .= "<option value='{$v[5]}|{$v[21]}'> {$v[5]} : {$v[2]} </option>";
    
  }
  return sprintf($htmlSelectProduct,$op);
}
?>

<div class="container-fluid">
   <br><br><br><br><br>
   <h3 align="center">สร้างใบส่งสินค้า</h3><br />

   <form method="post"  action="inv_create.php">
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
                                         วันที่สั่งซื้อ<br/>
                      <input type="text" name="pr_date" id="order_date" value="<?php echo date('Y-m-d')?>" class="form-control input-sm" readonly placeholder="Select Invoice Date" />
                    </div>
                  </div>
                  <br />
                  <table id="invoice-item-table" class="table-pr table table-bordered">
                    <tr>
                    
                      <th width="20%">รายการสินค้า</th>
                      <th width="5%">จำนวนส่ง</th>
                      <th width="5%">ราคาต่อหน่วย</th>
                      <th width="10%">จำนวนเงิน</th>
                      <th> <button type="button" align="left" name="add1" class="btn btn-success btn-sm add1" alt=""><i class="fa fa-plus"></i></button> </th>
                    </tr>
                    
                   <?php 
                   /*
                        echo " <tr>
                        <td width=\"45%\"> ".selectProducts(0,"product_ids",'')."</td>
                        <td width=\"15%\"><input type='number' onkeyup=\"calcPrice('0',$(this))\" class='form-control'  name='amounts[]' value='' /></td>
                        <td width=\"15%\"><input type='number' class='form-control' id=price_0 name='priceunits[]' value='' /></td>
                        <td width=\"15%\"><input type='number' class='form-control' id=total_0 name='totals[]' value='' readonly /></td>
                        <td> <button type='button' name='remove' class='btn btn-danger btn-sm remove'><i class='fa fa-minus'></i></button></td>
                        </tr>";
                        */
                     
                   ?>


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
                                   <input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-info" value="สร้างรายการสั่งซื้อ" />
                </td>
              </tr>
          </table>
        </div>
      </form>
   
  

<?php //print "<pre>"; print_r($dataPrMain); print "</pre>"; ?>

</div>
<style>
.table td {
     padding:5px; 
}
</style>
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
let sum = 0;
  $(".total").each(function() {
    sum += parseFloat(this.value) || 0;
  });


  //console.log(`Total : ${sum}`);
  $('#sumtotal').text(sum.toFixed(2));
}

function jSelectProduct(key,obj){
 let objPrice = $('#price_'+key);
 // let objTotal = $('#total_'+key);

 // objTotal.val( parseFloat(obj.val())*parseFloat(objPrice.val()) )

  let val = obj.val().split('|');

  objPrice.val(val[1]);
  //obj.val(val[0]);


  //console.log('select Proect : '+key + ' ' +product_price);
}
var num_row = 0;
add_new_row();
$('.add1').click(function(){
  add_new_row();
});

function add_new_row(){
  var new_row=  " <tr> "+
                "<td width=\"45%\"> <select id='product_"+num_row+"' onchange=\"jSelectProduct('"+num_row+"',$(this))\" name='products[]' class=\"form-control\"><?php echo selectProducts() ?></select></td>" +
                "<td width=\"15%\"><input type='number' onkeyup=\"calcPrice('"+num_row+"',$(this))\" class='form-control'  name='amounts[]' value='' /></td>" +
                "<td width=\"15%\"><input type='number' class='form-control' id=price_"+num_row+" name='priceunits[]' value='' /></td>" +
                "<td width=\"15%\"><input type='number' class='form-control total' id=total_"+num_row+" name='totals[]' value='' readonly /></td>" +
                "<td> <button type='button' name='remove' class='btn btn-danger btn-sm remove remove_"+num_row+"'><i class='fa fa-minus'></i></button></td>" +
                "</tr>";
  

num_row++;
$('.table-pr').append(new_row);
}

$(document).on('click', '.remove', function() {
        $(this).closest('tr').remove();
      });
    </script>

</body>

</html>
