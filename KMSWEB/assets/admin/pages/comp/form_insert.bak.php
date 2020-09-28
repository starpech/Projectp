<?php include_once('../authen.php');
include('../../connect.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>จัดการผู้ใช้</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="../../dist/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../dist/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../dist/img/favicons/favicon-16x16.png">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js">
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
  <link rel="stylesheet" href="../../plugins/responsive/responsive.bootstrap4.min.css"><!-- responsive-->
</head>
<style>
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
            <h1>เพิ่มผู้ใช้</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../dashboard">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="../stores">จัดการผู้ใช้</a></li>
              <li class="breadcrumb-item active">เพิ่มผู้ใช้</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title d-inline-block">เพิ่มผู้ใช้ระบบ</h3>
        </div>
        <!-- /.card-header -->
        <form class="form col-12" id="formRegister" method="post" action="php/register_process.php" >
		      
              <div class="input-group mb-2 mr-sm-2  ">
			      <div class="input-group-prepend">
                  <div class="input-group-text">ชื่อ</div>
                  </div>
                  <input type="text" class="form-control " id="mem_fname" name="mem_fname" placeholder="">
				  
                  <div class="input-group-prepend">
                  <div class="input-group-text">นามสกุล</div>
                  </div>
                  <input type="text" class="form-control" id="mem_lname" name="mem_lname" placeholder="">
              </div>

              <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                  <div class="input-group-text">บริษัท</div>
                  </div>
                  <input type="text" class="form-control" id="mem_comp" name="mem_comp" placeholder="">
                  <div class="input-group-prepend">
                  <div class="input-group-text">หน้าที่</div>
                  </div>
                  <input type="text" class="form-control" id="mem_status" name="mem_status" placeholder="">
                  <div class="input-group-prepend">
                  <div class="input-group-text">อีเมล</div>
                  </div>
                  <input type="email" class="form-control" id="mem_email" name="mem_email" placeholder="">
                  <div class="input-group-prepend">
                  <div class="input-group-text">โทรศัพท์</div>
                  </div>
                  <input type="text" class="form-control" id="mem_tel" name="mem_tel" placeholder="">
              </div>
			  
			  <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-text">ที่อยู่</div>
                <textarea name="mem_address" rows="3" class="form-control" placeholder=""></textarea>
              </div>

              <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                  <div class="input-group-text">ชื่อ Login</div>
                  </div>
                  <input type="text" class="form-control" id="mem_username" name="mem_username" placeholder="">
              </div>

              <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                  <div class="input-group-text">รหัสผ่าน</div>
                  </div>
                  <input type="password" class="form-control" id="mem_password" name="mem_password" placeholder="">
              </div>

              <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                  <div class="input-group-text">ยืนยันรหัสผ่าน</div>
                  </div>
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="">
              </div>


              <button type="submit" name="submit" id="submit" class="btn btn-success btn-block mb-8">ตกลง</button>
              
              </form>

				
        <div class="card-body">
        </div>


        <!-- /.card-body -->
      </div>
      <!-- /.card -->

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
<script src="../../plugins/responsive/dataTables.responsive.min.js"></script> <!-- responsive-->
<script src="../../../../node_modules/jquery-validation/dist/jquery.validate.min.js"></script><!--เรียกjquery.validate -->

</body>
</html>
<script>
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
  //formRegister
  $( document ).ready(function(){
            $('#formRegister').validate({
                rules:{
                  customFile:'required',
                   product_name:'required',
                   product_detail:'required',
                   product_code:'required',
                   Product_tag:'required',
                   product_price: {
                        required: true,
                        number: true,
                    },
                },
                messages:{
                  customFile: 'กรุณาเลือกไฟล์ก่อน',
                  product_name: 'โปรดกรอก ชื่อสินค้า',
                  product_detail:'โปรดกรอก รายละเอียดสินค้า',
                  product_code:'โปรดกรอก รายละโค๊ดสินค้า',
                  product_tag:'โปรดกรอก รายละแท๊กสินค้า',
                  product_price: {
                        number:'กรอกแต่ตัวเลขเท่านั้น',
                        required: 'กรุณากรอกจำนวนเงิน',
                    },
                   
                },
                errorElement: 'div',
                errorPlacement: function ( error, element ){
                    error.addClass( 'invalid-feedback' )
                    error.insertAfter( element )
                },
                highlight: function ( element, errorClass, validClass ){
                    $( element ).addClass( 'is-invalid' ).removeClass( 'is-valid' )
                },
                unhighlight:function ( element, errorClass, validClass ){
                    $( element ).addClass( 'is-valid' ).removeClass( 'is-invalid' )
                }
            });
        })
</script>




<!-- <div class="form-group col-md-2">
                  <label for="product_type_id">Product Type</label>
                  <a href="../product_type/"><i class="fas fa-plus-circle fa-lg"></i></a> 
   +++ -->
                  <!-- <select name="product_type_id" class="form-control">
                  <option value="">--------Select--------</option> -->
                  <?php 
                  // $sql="select * from product_type";
                  // $res=mysqli_query($conn,$sql);
                  // while($row=mysqli_fetch_array($res)){
                  ?>
                  <!-- <option value="<?php //echo $row['product_type_id']?>"><?php //echo $row['product_type_name']?></option>
                  <?php //}?>
                  </select>  -->