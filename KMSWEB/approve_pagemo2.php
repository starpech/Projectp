<?php error_reporting(~E_ALL);?>

<?php require_once('php/connect.php');
include('includes/function.php');
?>
<?php
//index.php
//session_start();
$connect = mysqli_connect("localhost", "root", "kslitc@1234", "kms_web_db");
$query = "SELECT * FROM req_detail WHERE ISNULL(approve_date) AND input_by='14'";
$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>
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