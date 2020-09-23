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
              <li class="breadcrumb-item active">แก้ไขข้อมูลผู้ใช้งาน</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php 
  include_once('../../connect.php');
  $mem_id=$_GET['mem_id'];
  $sql ="SELECT * FROM members m LEFT JOIN comp c USING(comp_code) where mem_id = $mem_id";
  /*$sql="select * from members where mem_id = $mem_id";*/
  $res=mysqli_query($conn,$sql);
  $row=mysqli_fetch_array($res);
  
?>
    <!-- Main content -->
    <section class="content">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">แก้ไขข้อมูลผู้ใช้งาน</h3>
        </div>
      
      
        <form role="form" action="update.php" method="post">
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-2">
              <input type="text" class="form-control" id="mem_id" name="mem_id" value="<?php echo $row['mem_id']=$mem_id?>" hidden>
			  <input type="text" class="form-control" id="mem_code" name="mem_code" value="<?php echo $row['mem_code']?>" hidden>
                  <label for="mem_code">รหัสผู้ใช้งาน</label>
                  <input type="text" class="form-control" id="mem_code" name="mem_code" value="<?php echo $row['mem_code']?>" disabled>
              </div>
              <div class="form-group col-md-5">
                  <label for="mem_fname">ชื่อ</label>
                  <input type="text" class="form-control" id="mem_fname" name="mem_fname" value="<?php echo $row['mem_fname']?>"disabled>
              </div>
              <div class="form-group col-md-5">
                  <label for="mem_lname">นามสกุล</label>
                  <input type="text" class="form-control" id="mem_lname" name="mem_lname" value="<?php echo $row['mem_lname']?>"disabled>
              </div>
              <div class="form-group col-md-5">
                  <label for="comp_code">บริษัท</label>
                  <input type="text" class="form-control" id="comp_code" name="comp_code"  value="<?php echo $row['comp_name']?>"disabled>
              </div>

              <div class="form-group col-md-2">
                  <label for="mem_status">ตำแหน่ง</label>
                  <input type="text" class="form-control" id="mem_status"  name="mem_status" value="<?php echo $row['mem_status']?>"disabled>
              </div>
			  <div class="form-group col-md-3">
                  <label for="mem_email">อีเมล</label>
                  <input type="text" class="form-control" id="mem_email"  name="mem_email" value="<?php echo $row['mem_email']?>"disabled>
              </div>
              <div class="form-group col-md-2">
                  <label for="mem_tel">โทรศัพท์</label>
                  <input type="text" class="form-control" id="mem_tel"  name="mem_tel" value="<?php echo $row['mem_tel']?>"disabled>
              </div>
            </div>

            <div class="form-group">
                <label for="mem_address">ที่อยู่บริษัท</label>
                <textarea class="form-control" id="mem_address" name="mem_address"  rows="3"disabled> <?php echo $row['mem_address']?></textarea>
            </div>
			
            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="mem_username">ชื่อ login</label>
                  <input type="text" class="form-control" id="mem_username"  name="mem_username" value="<?php echo $row['mem_username']?>"disabled>
                </div>
                <div class="form-group col-md-6">
                  <label for="mem_password">รหัสผ่าน</label>
                  <input type="text" class="form-control" id="mem_password"  name="mem_password" value="<?php echo $row['mem_password']?>"disabled>
                </div>
			</div>
			
          </div>
          <div class="card-footer">
          <a href="form-edit2.php?mem_id=<?php echo $row['mem_id']?>"class="btn btn-warning float-right">แก้ไขข้อมูล</a>
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
