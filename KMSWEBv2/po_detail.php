<?php error_reporting(~E_ALL);?>

<?php require_once('php/connect.php');
include('includes/function.php');
include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css"> <!--เรียกbootstrap -->
    <link rel="stylesheet" href="node_modules/font-awesome5/css/fontawesome-all.css"> <!--เรียกfontawesome -->
    <link rel="stylesheet" href="node_modules/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/css/flag-icon.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <title>คำสั่งซื้อ</title>
</head>
<style>
    body{
        background-color:#a9a8a863;
        color:black;
        
        
    }
    .container{
        background-color:white;
        color:black;
    }
    
</style>
<body>
<?php 
require_once 'config.php';
include('includes/navbar.php')?>
    <br><br> <br><br><br>

    <div class="card" style="border-radius: 10px;">
       <br> <h4><center>คำสั่งซื้อสินค้า</center></h4>
            <div class="card-body">
                <h4><center>  </center></h4>
            </div>
      </div>


    <H1>รอใส่ข้อมูล<br>* หน้าของ Supplier <br>ที่จะเห็นรายการสั่งซื้อและ Print out "ใบส่งสินค้า" จากระบบ KMS web ไปให้ชาวไร่เซ็น</H1>



<!-- ใส่ Body -->


 <?php 
 include('includes/footer.php');
 
 ?>
<script src="node_modules/jquery/dist/jquery.min.js"></script><!--เรียกjquery -->
<script src="node_modules/popper.js/dist/umd/popper.min.js"></script><!--เรียกpopper -->
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script><!--เรียกbootstrap.min.js -->
<script src="node_modules/jquery-validation/dist/jquery.validate.min.js"></script><!--เรียกjquery.validate -->
</body>
</html>

