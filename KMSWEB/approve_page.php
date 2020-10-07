<?php error_reporting(~E_ALL);?>

<?php require_once('php/connect.php');
include('includes/function.php');
$comp_code = $_SESSION["comp_code"];
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
    <title>อนุมัติรายการขอซื้อ</title>
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
<?php 
$query = "SELECT * FROM req_detail{$comp_code} WHERE ISNULL(approve_date)";
$result = mysqli_query($conn, $query);
 
 ?>
  <div class="container-fluid">
   <br>
   <h3 align="center">อนุมัติรายการขอซื้อ</h3><br />
   <?php
   if(mysqli_num_rows($result) > 0)
   {
   ?>
   <div class="table-responsive">
   <button type="button" name="x" id="selectAll" class="btn btn-danger">SelectAll</button>
   <button type="button" name="y" id="clearAll" class="btn btn-danger">ClearAll</button>
    <table class="table table-bordered">
    <thead width="100%" class="thead-light">
      <th>ID No.</th>
      <th>โค้วต้าชาวไร่</th>
      <th>ชื่อนามสกุล</th>
      <th>เขตชาวไร่</th>
      <th>สถานที่จัดส่ง</th>
      <th>ชื่อสินค้า</th>
      <th>จำนวน</th>
     </thead>
     <tbody>
   <?php
    while($row = mysqli_fetch_array($result))
    {
   ?>
     <tr id="<?php echo $row["id_no"]; ?>" >
     <td><input type="checkbox" name="id_no[]" class="delete_customer" value="<?php echo $row["id_no"]; ?>" /></td>
      <td><?php echo $row["Quota_id"]; ?></td>
      <td><?php echo $row["Quota_name"]; ?></td>
      <td><?php echo $row["Quota_ket"]; ?></td>
      <td><?php echo $row["Quota_place"]; ?></td>
      <td><?php echo $row["Product_name"]; ?></td>
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
    <button type="button" name="btn_approve" id="btn_approve" class="btn btn-success">Approve</button>
   </div>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
 

$("#selectAll").click(function(){
     //alert("xxx")
     $(".delete_customer").prop('checked',true);
});

$("#clearAll").click(function(){
     //alert("xxx")
     $(".delete_customer").prop('checked',false);
});


 $('#btn_approve').click(function(){
  
  if(confirm("ยืนยันการอนุมัติรายการขอซื้อดังกล่าว?"))
  {
   var id = [];
   
   $(':checkbox:checked').each(function(i){
    id[i] = $(this).val();
   });
   
   if(id.length === 0) //tell you if the array is empty
   {
    alert("โปรดอนุมัติอย่างน้อยหนึ่งรายการ");
   }
   else
   {
    $.ajax({
     url:'approve_process.php',
     method:'POST',
     data:{id:id},
     success:function(data)
     {
       
      for(var i=0; i<id.length; i++)
      {
       $('tr#'+id[i]+'').css('background-color', '#ccc');
       $('tr#'+id[i]+'').fadeOut('slow');
      }

      $.post('approve_process02.php')

      console.log(data)
     }
     
    });
   }
   
  }
  else
  {
   return false;
  }
 });
 
});
</script>
</div>



<!--- END CONTENT----->


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
