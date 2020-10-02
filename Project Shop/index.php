<!DOCTYPE html>
<html>
<head>
<?php include('include/h.php');?>

<head>
  <body>
    <div class="container">
  <?php include('include/navbar.php');?>
  <p></p>
    <div class="row">
      <div class="col-md-3">
        <!-- Left side column. contains the logo and sidebar -->
        <?php include('include/menu_left.php');?>
        <!-- Content Wrapper. Contains page content -->
      </div>
    </div>
    <?php
        if($conn){echo "connect success";}
        else {echo "connect fails";}
     ?>
  </div>
  </body>
</html>