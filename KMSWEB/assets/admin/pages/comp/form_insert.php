<?php include_once('../authen.php') ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>จัดการดูแลระบบ</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="../../dist/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../dist/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../dist/img/favicons/favicon-16x16.png">
  <link rel="manifest" href="../../dist/img/favicons/site.webmanifest">
  <link rel="mask-icon" href="../../dist/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="../../dist/img/favicons/favicon.ico">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="msapplication-config" content="../../dist/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.min.css">
</head>
<style>
.w-50{
  width:30px;
}
</style>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar & Main Sidebar Container -->
  <?php include_once('../includes/sidebar.php') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>จัดการดูแลระบบ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
              <li class="breadcrumb-item"><a href="index.php">จัดการดูแลระบบ</a></li>
              <li class="breadcrumb-item active">เพิ่มข้อมูลบริษัท</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php 
  include_once('../../connect.php');
  //$comp_id=$_GET['comp_id'];
  //$sql="select * from comp where comp_id = $comp_id";
  //$res=mysqli_query($conn,$sql);
  //$row=mysqli_fetch_array($res);
?>
    <!-- Main content -->
    <section class="content">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">เพิ่มข้อมูลบริษัท</h3>
        </div>
      
      
        <form role="form" action="insert.php" method="post">
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-2">
              <input type="text" class="form-control" id="comp_id" name="comp_id" value="<?php echo $row['comp_id']=$comp_id?>" hidden>
			  <input type="text" class="form-control" id="comp_code" name="comp_code" value="<?php echo $row['comp_code']?>" hidden>
                  <label for="comp_code">รหัสบริษัท</label>
                  <input type="text" class="form-control" id="comp_code" name="comp_code" value="<?php echo $row['comp_code']?>">
              </div>
              <div class="form-group col-md-8">
                  <label for="comp_name">ชื่อบริษัท</label>
                  <input type="text" class="form-control" id="comp_name" name="comp_name" value="<?php echo $row['comp_name']?>">
              </div>
              <div class="form-group col-md-2">
                  <label for="comp_nickname">ชื่อย่อบริษัท</label>
                  <input type="text" class="form-control" id="comp_nickname" name="comp_nickname" value="<?php echo $row['comp_nickname']?>">
              </div>
              <div class="form-group col-md-3">
                  <label for="comp_email">อีเมล</label>
                  <input type="email" class="form-control" id="comp_email" name="comp_email"  value="<?php echo $row['comp_email']?>">
              </div>

              <div class="form-group col-md-3">
                  <label for="comp_tel">โทรศัพท์</label>
                  <input type="text" class="form-control" id="comp_tel"  name="comp_tel" value="<?php echo $row['comp_tel']?>">
              </div>
			  <div class="form-group col-md-3">
                  <label for="comp_fax">แฟ๊กซ์</label>
                  <input type="text" class="form-control" id="comp_fax"  name="comp_fax" value="<?php echo $row['comp_fax']?>">
              </div>
              <div class="form-group col-md-3">
                  <label for="comp_type">สถานะ</label>
                  <select name="comp_type" id="comp_type" class="form-control">
                   
                   <?php
				  // $sqldata="Select * from comp where comp_id=$comp_id";
                  // $rese2=mysqli_query($conn,$sqldata);
                  // $row2=mysqli_fetch_assoc($rese2);
                  // $company;
                  // $buyer;
				  // $seller;
				  // if($row2['comp_type']=="บริษัท"){
                  //   $company="selected";
                  // }elseif ($row2['comp_type']=="ผู้ซื้อ"){
                  //   $buyer="selected";
                  // }else {
					// $seller="selected";  
				  // }  
                  ?>
                  <option value="บริษัท" <?php echo $company?>>บริษัท</option>
                  <option value="ผู้ซื้อ"<?php echo $buyer?>>ผู้ซื้อ</option>
				  <option value="ผู้ขาย"<?php echo $seller?>>ผู้ขาย</option>
				  </select>
                  <?php    
                  ?>
              </div>
            </div>

            <div class="form-group">
                <label for="comp_address">ที่อยู่บริษัท</label>
                <textarea class="form-control" id="comp_addr" name="comp_addr"  rows="5"> <?php /* echo $row['comp_addr'] */?></textarea>
            </div>

          </div>
          <div class="card-footer">
		  <input type="submit" name="submit" class="btn btn-primary float-right" value="เพิ่มข้อมูล">
          <!-- <a href="form-edit2.php?comp_id=<?php /*echo $row['comp_id'] */?>"class="btn btn-warning float-right">แก้ไขข้อมูล</a> -->
          </div>
        </form>
      </div>    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- footer -->
  <?php include_once('../includes/footer.php') ?>
  
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- DataTables -->
<script src="../../../../node_modules/jquery-datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap4.min.js"></script>

<script>
  $(function () {
    $('#dataTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
  $('.custom-file-input').on('change', function(){
    var fileName = $(this).val().split('\\').pop()
    $(this).siblings('.custom-file-label').html(fileName)
    if (this.files[0]) {
        var reader = new FileReader()
        $('.figure').addClass('d-block')
        reader.onload = function (e) {
            $('#imgUpload').attr('src', e.target.result)
        }
        reader.readAsDataURL(this.files[0])
    }
  })
</script>

</body>
</html>
