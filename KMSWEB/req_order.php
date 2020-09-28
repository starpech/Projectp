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
    <title>สร้างรายการขอซื้อ</title>
</head>

<?php
//index.php
$connect = new PDO("mysql:host=localhost;dbname=kms_web_db", "root", "");
function fill_unit_select_box($connect)
{
  $output = '';
  $query = "SELECT * FROM product where flag='0' ORDER BY product_name ASC";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach ($result as $row) {
    $output .= '<option value="' . $row["product_code"] . '">' . $row["product_name"] . '</option>';
  }
  return $output;
}
?>

<style>
    body{
        background-color:white;
        color:black;        
        
    }
    .container{
        background-color:white;
        color:white;
        width:100%;
    }
    .btn-circle.btn-sm { 
			width: 10px; 
			height: 10px; 
			padding: 2px 0px; 
			border-radius: 20px; 
			font-size: 18px; 
			text-align: center;
    }  
    
</style>

<body>
<?php 
include('includes/navbar_operator.php')?>
  <div class="container-fluid">
   <br><br><br><br><br>
      <div class="card" style="width:100%; background-color:#a9a8a863; border-radius: 25px;">
       <br> <h3><center>สร้างรายการขอซื้อ</center></h3><h4 style="color:red"><center>*กรอกข้อมูลรายการสั่งซื้อให้ครบถ้วน*</center></h4>
      </div>
      <br>
      <form  action="insert_req.php" method="post" id="insert_form">
    <div class="table-repsonsive" style="width:100%; overflow:auto;">
      <span id="error"></span>
     <table class="table table-bordered" id="item_table">
      
      <tr>
      <thead width="100%" class="thead-light">
       <th width="15%"><h5 align="center">เลขที่โควตา</h5></th>
       <th width="20%"><h5 align="center">ชื่อ - นามสกุล</h5></th>
       <th width="10%"><h5 align="center">เขต</h5></th>
       <th width="15%"><h5 align="center">สถานที่จัดส่ง</h5></th>
       <th width="25%"><h5 align="center">ชื่อสินค้า</h5></th>
       <th width="10%"><h5 align="center">จำนวน</h5></th>
       <th><button type="button" align="left" name="add1" class="btn btn-success btn-sm add1" alt="เพิ่มชื่อชาวไร่"><i class="fa fa-plus"></i></button></th>
       <!--<th><button type="button" align="left" name="add1" class="btn btn-success btn-sm add1"><span class="glyphicon glyphicon-plus"></span></button>-->
       <th><button type="button" align="left" name="add2" class="btn btn-warning btn-sm add2" alt="เพิ่มรายการซื้อ"><i class="fa fa-plus"></i></button></th>
       </thead>
       </tr>
      
     </table>
     <div align="center">
      <input type="submit" name="submit" class="btn btn-info" value="บันทึกรายการขอซื้อ" >
      <input type="reset" name="reset" class="btn btn-danger" value="เคลียร์ทั้งหมด" >
     </div>
    </div>
   </form>
  </div>
  <br>

 <?php 
 include('includes/footer.php');
  ?>
<script src="node_modules/jquery/dist/jquery.min.js"></script><!--เรียกjquery -->
<script src="node_modules/popper.js/dist/umd/popper.min.js"></script><!--เรียกpopper -->
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script><!--เรียกbootstrap.min.js -->
<script src="node_modules/jquery-validation/dist/jquery.validate.min.js"></script><!--เรียกjquery.validate -->

  <!-- PASTE HERE -->
  <script>
    $(document).ready(function() {

      $(document).on('click', '.add1', function() {
        var html='';
        
        html += '<tr>';
        html += '<td><input type="text" name="quota_id[]" class="form-control form-control-sm Quota_id" placeholder="เลขที่โควต้า"></td>'; //เลขที่โควตา
        html += '<td><input type="text" name="quota_name[]" class="form-control form-control-sm Quota_name" placeholder="ชื่อ-นามสกุล" ></td>'; //ชื่อ นามสกุล
        html += '<td><input type="text" name="quota_ket[]" class="form-control form-control-sm Quota_ket" placeholder="เขต"></td>'; //เขต
        html += '<td><input type="text" name="quota_place[]" class="form-control form-control-sm Quota_place" placeholder="สถานที่จัดส่ง"></td>'; // สถานที่จัดส่ง
        html += '<td><select name="product_name[]" class="form-control form-control-sm Product_name"><option value="">เลือกรายการ</option><?php echo fill_unit_select_box($connect); ?></select></td>'; //เลือกสินค้า
        html += '<td><input type="text" name="product_amount[]" class="form-control form-control-sm Product_amount" placeholder="จำนวนสินค้า"></td>'; // ใส่จำนวนสั่งซื้อ
        html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fa fa-minus"></i></button></td>';
		    html += '<td><button type="button" name="add2" class="btn btn-warning btn-sm add2"><i class="fa fa-plus"></i></button></td></tr>';

		  $('#item_table').append(html);
      });

      $(document).on('click', '.add2', function () {
               var $tableBody = $('#item_table').find("tbody"),
                $trLast = $tableBody.find("tr:last"),
                $trNew = $trLast.clone();
                // Find by attribute 'id'
                $trNew.find('[id]').each(function () {
                    var num = this.id.replace(/\D/g, '');
                    if (!num) {
                        num = 0;
                    }
                    // Remove numbers by first regexp
                    this.id = this.id.replace(/\d/g, '') 
                        // increment number
                        + (1 + parseInt(num, 10));
                });
                $trLast.after($trNew); 
      });

      $(document).on('click', '.remove', function() {
        $(this).closest('tr').remove();
      });

      $('#insert_form').on('submit', function(event) {
        event.preventDefault();
        var error = '';
        $('.Quota_id').each(function() {
          var count = 1;
          if ($(this).val() == '') {
            error += "<p>ยังไม่ได้กรอกเลขที่โควต้า " + count + " Row</p>";
            return false;
          }
          count = count + 1;
        });
        $('.Quota_name').each(function() {
          var count = 1;
          if ($(this).val() == '') {
            error += "<p>ยังไม่ได้กรอก ชื่อ-นามสกุล " + count + " Row</p>";
            return false;
          }
          count = count + 1;
        });
        $('.Quota_ket').each(function() {
          var count = 1;
          if ($(this).val() == '') {
            error += "<p>ยังไม่ได้กรอกเขต " + count + " Row</p>";
            return false;
          }
          count = count + 1;
        });
        $('.Quota_place').each(function() {
          var count = 1;
          if ($(this).val() == '') {
            error += "<p>ยังไม่ได้กรอกสถานที่จัดส่ง " + count + " Row</p>";
            return false;
          }
          count = count + 1;
        });
        $('.Product_name').each(function() {
          var count = 1;
          if ($(this).val() == '') {
            error += "<p>ยังไม่ได้เลือกชื่อสินค้า " + count + " Row</p>";
            return false;
          }
          count = count + 1;
        });
        $('.Product_amount').each(function() {
          var count = 1;
          if ($(this).val() == '') {
            error += "<p>ยังไม่ได้กรอกจำนวนสินค้า " + count + " Row</p>";
            return false;
          }
          count = count + 1;
        });


        var form_data = $(this).serialize();
        if (error == '') {
          $.ajax({
            url: "insert_req.php",
            method: "POST",
            data: form_data,
            success: function(data) {
              if (data == 'ok') {
                $('#item_table').find("tr:gt(0)").remove();
                $('#error').html('<div class="alert alert-success">บันทึกรายการขอซื้อเรียบร้อย</div>');
              }
            }
          });
        } else {
          $('#error').html('<div class="alert alert-danger">' + error + '</div>');
        }
      });

    });
  </script>
  <!-- PASTE HERE -->


</body>

</html>
