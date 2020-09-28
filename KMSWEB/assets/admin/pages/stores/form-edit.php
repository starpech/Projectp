<?php include_once('../authen.php');
include('../../../../includes/function.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Stores Management</title>
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
  .span-edit {
    color:green;
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
            <h1>Product Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../dashboard">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="../stores">Product Management</a></li>
              <li class="breadcrumb-item active">Edit Product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
<?php 
      include_once('../../connect.php');
      
      $product_id=$_GET['product_id'];
      $sql="SELECT * FROM product Where product_id=$product_id"; 
      $ress=mysqli_query($conn,$sql);
      $rows=mysqli_fetch_assoc($ress);
?>

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title d-inline-block">Edit Product</h3>
        </div>
        <!-- /.card-header -->
        <form role="form" action="insert.php" method="post"enctype="multipart/form-data"id="formRegister">
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-6">
                  <label for="mem_fname">Add Image Product</label>
                    <div class="custom-file">

                        <input type="file" class="custom-file-input" name="file" id="customFile" disabled>
                        <label class="custom-file-label" for="customFile" disabled>Choose file</label>
                    </div><br>
                        <figure class="figure text-center mt-2">
                            <img  src="../../../image/store/<?php echo $rows['product_image']?>" id="imgUpload" class="figure-img img-fluid rounded" style="max-width:50%">
                        </figure>
                    </div>
            <table>
              <div class="form-group col-md-6">
                  <label for="product_name">Product Name </label>
                  <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $rows['product_name']?>"disabled>

              </div>
              <div class="form-group col-md-12">
                  <label for="product_detail">Product Detail </label><br>
                  <textarea name="product_detail"  id="product_detail" rows="5" class="form-control"disabled><?php echo $rows['product_detail']?></textarea>
              </div>


                <!-- ราคาขาย +++++++++++++++  -->

            <div class="form-group col-md-12"> <label style="color:red" for="product_detail"> ราคาขายโรงงาน </label> </div> 


              <div class="form-group col-md-2"> <label for="product_detail"> Product Price 1 <span class="span-edit">(NP)</span> </label>
                <div class="input-group-prepend">
                  <input type="text" class="form-control" id="product_price1" name="product_price1" class="form-control" value="<?php echo $rows['product_price1']?>"disabled> <div class="input-group-text">bath</div>
                </div>
              </div>

              <div class="form-group col-md-2"> <label for="product_detail"> Product Price 2 <span class="span-edit">(WP)</span></label>
                <div class="input-group-prepend">
                  <input type="text" class="form-control" id="product_price2" name="product_price2" class="form-control" value="<?php echo $rows['product_price2']?>"disabled> <div class="input-group-text">bath</div>
                </div>
              </div>
              
              <div class="form-group col-md-2"> <label for="product_detail"> Product Price 3 <span class="span-edit">(BP)</span></label>
                <div class="input-group-prepend">
                  <input type="text" class="form-control" id="product_price3" name="product_price3" class="form-control" value="<?php echo $rows['product_price3']?>"disabled> <div class="input-group-text">bath</div>
                </div>
              </div>

              <div class="form-group col-md-2"> <label for="product_detail"> Product Price 4 <span class="span-edit">(TK)</span></label>
                <div class="input-group-prepend">
                  <input type="text" class="form-control" id="product_price4" name="product_price4" class="form-control" value="<?php echo $rows['product_price4']?>"disabled> <div class="input-group-text">bath</div>
                </div>
              </div>

              <div class="form-group col-md-2"> <label for="product_detail"> Product Price 5 <span class="span-edit">(PN)</span> </label>
                <div class="input-group-prepend">
                  <input type="text" class="form-control" id="product_price5" name="product_price5" class="form-control" value="<?php echo $rows['product_price5']?>"disabled> <div class="input-group-text">bath</div>
                </div>
              </div>

                <div class="form-group col-md-2">  </div>

                <br> <br> <br> <br>
                <!-- ราคาต่นทุน  ๑๑๑๑๑๑๑๑๑๑๑๑๑/ -->

            <div class="form-group col-md-12"> <label style="color:red" for="product_detail"> ราคาต้นทุน </label></div> 
            <div class="form-group col-md-2"> <label for="product_detail"> Product Cost 1 <span class="span-edit">(NP)</span> </label>
                <div class="input-group-prepend">
                  <input type="text" class="form-control" id="product_cost1" name="product_cost1" class="form-control" value="<?php echo $rows['product_cost1']?>"disabled> <div class="input-group-text">bath</div>
                </div>
              </div>

              <div class="form-group col-md-2"> <label for="product_detail"> Product Cost 2 <span class="span-edit">(WP)</span></label>
                <div class="input-group-prepend">
                  <input type="text" class="form-control" id="product_cost2" name="product_cost2" class="form-control" value="<?php echo $rows['product_cost2']?>"disabled> <div class="input-group-text">bath</div>
                </div>
              </div>
              
              <div class="form-group col-md-2"> <label for="product_detail"> Product Cost 3 <span class="span-edit">(BP)</span></label>
                <div class="input-group-prepend">
                  <input type="text" class="form-control" id="product_cost3" name="product_cost3" class="form-control" value="<?php echo $rows['product_cost3']?>"disabled> <div class="input-group-text">bath</div>
                </div>
              </div>

              <div class="form-group col-md-2"> <label for="product_detail"> Product Cost 4 <span class="span-edit">(TK)</span></label>
                <div class="input-group-prepend">
                  <input type="text" class="form-control" id="product_cost4" name="product_cost4" class="form-control" value="<?php echo $rows['product_cost4']?>"disabled> <div class="input-group-text">bath</div>
                </div>
              </div>

              <div class="form-group col-md-2"> <label for="product_detail"> Product Cost 5 <span class="span-edit">(PN)</span> </label>
                <div class="input-group-prepend">
                  <input type="text" class="form-control" id="product_cost5" name="product_cost5" class="form-control" value="<?php echo $rows['product_cost5']?>"disabled> <div class="input-group-text">bath</div>
                </div>
              </div>
                <div class="form-group col-md-2">  </div>













              <div class="form-group col-md-2">
                  <label for="product_code">Product Code</label>
                  <input type="text" class="form-control" id="product_code" name="product_code"value="<?php echo $rows['product_code']?>"disabled>
              </div>
              <div class="form-group col-md-2">
                  <label for="product_tag">Product Tag</label>
                  <input type="text" class="form-control" id="product_tag" name="product_tag"value="<?php echo $rows['product_tag']?>"disabled>
              </div>
              <div class="form-group col-md-2">
                  <label for="product_date">Date</label>
                  <input type="date" class="form-control" id="product_date" name="product_date"value="<?php echo $rows['product_date']?>"disabled>
              </div>
              <div class="form-group col-md-4">
                  <label for="submit" style="opacity: 0;">Product Type</label><br>
              </div>

              <div class="form-group col-md-12">
              <div class="card-footer">
          <a href="form-edit2.php?product_id=<?php echo $rows['product_id']?>"class="btn btn-warning float-right">แก้ไขข้อมูล</a>
          </div>
          </div>
            </table>
            </div>
          </div>
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
  // $( document ).ready(function(){
  //           $('#formRegister').validate({
  //               rules:{
  //                 customFile:'required',
  //                 store_name:'required',
  //                 store_comment:'required',
  //                 store_number:'required',
  //                 store_price: {
  //                       required: true,
  //                       number: true,
  //                   },
  //               },
  //               messages:{
  //                 customFile: 'กรุณาเลือกไฟล์ก่อน',
  //                 store_name: 'โปรดกรอก ชื่อสินค้า',
  //                 store_comment:'โปรดกรอก รายละเอียดสินค้า',
  //                 store_price: {
  //                       number:'กรอกแต่ตัวเลขเท่านั้น',
  //                       required: 'กรุณากรอกจำนวนเงิน',
  //                   },
  //                   store_number:{
  //                       number:'กรอกแต่ตัวเลขเท่านั้น',
  //                       required: 'กรุณากรอกจำนวนสินค้า',
  //                   }
  //               },
  //               errorElement: 'div',
  //               errorPlacement: function ( error, element ){
  //                   error.addClass( 'invalid-feedback' )
  //                   error.insertAfter( element )
  //               },
  //               highlight: function ( element, errorClass, validClass ){
  //                   $( element ).addClass( 'is-invalid' ).removeClass( 'is-valid' )
  //               },
  //               unhighlight:function ( element, errorClass, validClass ){
  //                   $( element ).addClass( 'is-valid' ).removeClass( 'is-invalid' )
  //               }
  //           });
  //       })
</script>