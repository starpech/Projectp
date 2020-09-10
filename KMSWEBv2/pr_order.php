<?php error_reporting(~E_ALL); ?>

<?php require_once('php/connect.php');
include('includes/function.php');
include('config.php');
?>
<!-- PASTE HERE -->
<?php
//index.php
$connect = new PDO("mysql:host=localhost;dbname=kms_web_db", "root", "");
function fill_unit_select_box($connect)
{
  $output = '';
  $query = "SELECT * FROM product ORDER BY product_name ASC";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach ($result as $row) {
    $output .= '<option value="' . $row["product_name"] . '">' . $row["product_name"] . '</option>';
  }
  return $output;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <!--เรียกbootstrap -->
  <link rel="stylesheet" href="node_modules/font-awesome5/css/fontawesome-all.css">
  <!--เรียกfontawesome -->
  <link rel="stylesheet" href="node_modules/css/style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/css/flag-icon.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
  <title>สร้างรายการขอซื้อ</title>


</head>

<style>
  body {
    background-color: #a9a8a863;
    color: black;
  }
  .container {
    background-color: white;
    color: black;
  }
</style>

<body>
  <?php
  require_once 'config.php';
  include('includes/navbar.php') ?>

<!-- ใส่ช่อง Form-->

<div class="form-group col-md-12" style="border-radius: 10px;">

    <div class="table-repsonsive">
      <div><h2 align="center">สร้างรายการขอซื้อ</h2></div>
      <div><h4 align="left" style="color:red" >*กรอกข้อมูลรายการสั่งซื้อให้ครบถ้วน</h4></div>
     <span id="error"></span>
     <table class="table table-bordered" id="item_table">
      <tr>
       <th><h5 align="center">เลขที่โควตา</h5></th>
       <th><h5 align="center">ชื่อ - นามสกุล</h5></th>
       <th><h5 align="center">เขต</h5></th>
       <th><h5 align="center">สถานที่จัดส่ง</h5></th>
       <th><h5 align="center">ชื่อสินค้า</h5></th>
       <th><h5 align="center">จำนวน</h5></th>
       <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
      </tr>
     </table>
     <form  action="insert.php" method="post" id="insert_form">
        <div align="center">
          <input type="submit" name="submit" class="btn btn-info" value="สั่งซื้อ" >
          <input type="reset" name="reset" class="btn btn-danger" value="เคลียร์ทั้งหมด" >
        </div>
    </div>
   </form>
   </div>

  <?php
  include('includes/footer.php');
  ?>
  
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <!--เรียกjquery -->
  <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
  <!--เรียกpopper -->
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <!--เรียกbootstrap.min.js -->
  <script src="node_modules/jquery-validation/dist/jquery.validate.min.js"></script>
  <!--เรียกjquery.validate -->

<!-- 

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  paste here -->



  <!-- PASTE HERE -->
  <script>
    $(document).ready(function() {

      $(document).on('click', '.add', function() {
        var html = '';
        html += '<tr>';
        html += '<td><input type="text" name="Quota_id[]" class="form-control Quota_id" /></td>'; //เลขที่โควตา
        html += '<td><input type="text" name="Quota_name[]" class="form-control Quota_name" /></td>'; //ชื่อ นามสกุล
        html += '<td><input type="text" name="Quota_ket[]" class="form-control Quota_ket" /></td>'; //เขต
        html += '<td><input type="text" name="Quota_place[]" class="form-control Quota_place" /></td>'; // สถานที่จัดส่ง
        html += '<td><select name="Product_name[]" class="form-control Product_name"><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select></td>'; //เลือกสินค้า
        html += '<td><input type="text" name="Product_amount[]" class="form-control Product_amount" /></td>'; // ใส่จำนวนสั่งซื้อ
        html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
        $('#item_table').append(html);
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
            error += "<p>Enter Quota id " + count + " Row</p>";
            return false;
          }
          count = count + 1;
        });
        $('.Quota_name').each(function() {
          var count = 1;
          if ($(this).val() == '') {
            error += "<p>Enter Quota name " + count + " Row</p>";
            return false;
          }
          count = count + 1;
        });
        $('.Quota_ket').each(function() {
          var count = 1;
          if ($(this).val() == '') {
            error += "<p>Enter Quota ket " + count + " Row</p>";
            return false;
          }
          count = count + 1;
        });
        $('.Quota_place').each(function() {
          var count = 1;
          if ($(this).val() == '') {
            error += "<p>Enter Quota place " + count + " Row</p>";
            return false;
          }
          count = count + 1;
        });
        $('.Product_name').each(function() {
          var count = 1;
          if ($(this).val() == '') {
            error += "<p>Enter Product name at " + count + " Row</p>";
            return false;
          }
          count = count + 1;
        });
        $('.Product_amount').each(function() {
          var count = 1;
          if ($(this).val() == '') {
            error += "<p>Enter Product amount at " + count + " Row</p>";
            return false;
          }
          count = count + 1;
        });


        var form_data = $(this).serialize();
        if (error == '') {
          $.ajax({
            url: "insert.php",
            method: "POST",
            data: form_data,
            success: function(data) {
              if (data == 'ok') {
                $('#item_table').find("tr:gt(0)").remove();
                $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
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