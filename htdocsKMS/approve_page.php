<?php
//index.php
session_start();
$connect = mysqli_connect("localhost", "root", "", "kms_web_db");
$query = "SELECT * FROM req_detail WHERE ISNULL(approve_date) AND input_by='14'";
$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>
 <head>
  <title>KMS-Web</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
  <style>
   #box
   {
    width:600px;
    background:gray;
    color:white;
    margin:0 auto;
    padding:10px;
    text-align:center;
   }
  </style>
 </head>
 <body>
  <div class="container">
   <br />
   <h3 align="center">อนุมัติรายการขอซื้อ</h3><br />
   <?php
   if(mysqli_num_rows($result) > 0)
   {
   ?>
   <div class="table-responsive">
   <button type="button" name="x" id="selectAll" class="btn btn-danger">SelectAll</button>
   <button type="button" name="y" id="clearAll" class="btn btn-danger">ClearAll</button>
    <table class="table table-bordered">
     <tr>
      <th>ID No.</th>
      <th>โค้วต้าชาวไร่</th>
      <th>ชื่อนามสกุล</th>
      <th>เขตชาวไร่</th>
      <th>สถานที่จัดส่ง</th>
      <th>ชื่อสินค้า</th>
      <th>จำนวน</th>
     </tr>
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
    </table>
   </div>
   <?php
   }
   ?>
   <div align="center">
    <button type="button" name="btn_approve" id="btn_approve" class="btn btn-success">Approve</button>
   </div>
 </body>
</html>

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