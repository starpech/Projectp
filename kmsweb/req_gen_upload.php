<?php error_reporting(~E_ALL);?>

<?php require_once('php/connect.php');
include('includes/function.php');
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
	  
   
    <!-- DataTables -->
  <link rel="stylesheet" href="assets/admin/plugins/datatables/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/admin/plugins/responsive/responsive.bootstrap4.min.css"><!-- responsive-->

    <title>อัพโหลดรูปภาพใบสั่งซื้อ</title>
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
        elseif($_SESSION["mem_status"]=="admin"){
          include('includes/navbar_admin.php'); }
  else { include('includes/navbar.php'); }
?>

<!---  CONTENT----->
<div class="container-fluid">

   <h3 align="center">ภาพใบขอซื้อ <?php echo $_GET['id'] ?></h3><br>
<br>
	<!-- boostrap css-->
	<link rel="stylesheet" type="text/css" href="upload_image/assets/bootstrap/css/bootstrap.min.css"> 
<!-- file input css -->
<link rel="stylesheet" type="text/css" href="upload_image/assets/fileinput/css/fileinput.min.css">
<div class="row">
  <div class="col-lg-6">
  <style>
.kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar {
    display: inline-block;
}
.kv-avatar .file-input {
    display: table-cell;
    width: 213px;
}
.kv-reqd {
    color: red;
    font-family: monospace;
    font-weight: normal;
}
</style>
  <form action="req_gen_uploading.php" method="post" enctype="multipart/form-data" id="uploadImageForm">
		  <div class="form-group">
		    <input type="hidden" value="<?php echo $_GET['id']?>" name="req_id" />
        <label for="fullName">คำอธิบายภาพ</label>
		    <input type="text" class="form-control" id="req_image_title" name="req_image_title" placeholder="Name">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">รูปภาพ</label>		    
		    <div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>

            <div class="kv-avatar center-block" style="width:200px">
		        <input id="avatar-2" name="req_image" type="file" class="file-loading">
		    </div>
		  </div>
		  <button type="submit" class="btn btn-default">อัพโหลดรูปภาพ</button>
		  <button type="button" onclick="window.history.back()" class="btn btn-warning"> กลับไปเมนูก่อนหน้า </button>
		</form>

  </div>
	<!---<link rel="stylesheet" href="prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />-->
  <link href="zoom_image/dist/zoomify.css" rel="stylesheet" type="text/css">
<?php  

function dbImages(){
  global $conn;
  $query=  "SELECT * FROM `req_detail_uploads` where req_id = '{$_GET['id']}' "  ;
  $result = $conn->query($query);     
  if (!$result) {
    printf("Query failed: %s\n", $conn->error);
    exit;
  }      
  while($row = $result->fetch_assoc()) {
    $rows[]=$row;
  }
  $result->close();
  return $rows;

}

$arrData = dbImages();

echo "<div class='col-lg-6'>";
echo "<table class=\"table table-bordered table-striped w-100 \"><thead>";
echo "<tr>
       <th>ลำดับ</th>
       <th>คำอธิบายภาพ</th>
       <th>รูปภาพ</th>
       <th></th>
      </tr></thead><tbody>";
foreach($arrData as $key => $v){ 

$file_name = end(explode('/',$v['req_image_path']));

  echo "<tr>
  
  <td>".($key+1)."</td>
  
  <td>{$v['req_image_title']} </td>
  
  <td>
  
  <img class='zimage' src='{$v['req_image_path']}' style='height:100px; width:100px;' />
  
  

  
  
  </td>
  <td> 
  
  <a href=\"req_gen_upload_delete.php?req_id={$v['req_id']}&id={$v['id']}&file_name={$file_name}\" class='btn btn-danger'> delete </a> 
  <a href=\"onlineinvoice/req_image_pdf.php?file_name={$file_name}\" target='_blank' class='btn btn-info'> print </a> 
  
  
  </td>
  
  
  </tr>";
    
}  
echo "</tbody></table>";
echo "</div>";
?>

</div>




</div>
<!--- END CONTENT----->

<!-- jQuery -->
<script src="assets/admin/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- bootsrap js -->
<script type="text/javascript" src="upload_image/assets/bootstrap/js/bootstrap.min.js"></script>

<!-- file input -->
<script src="upload_image/assets/fileinput/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>	
<script src="upload_image/assets/fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>	
<script src="upload_image/assets/fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
<script src="upload_image/assets/fileinput/js/fileinput.min.js"></script>

<script src="zoom_image/dist/zoomify.js"></script>

<!--<script src="prettyPhoto/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>-->

<!-- DataTables 
<script src="node_modules/jquery-datatables/jquery.dataTables.min.js"></script>
<script src="assets/admin/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="assets/admin/plugins/responsive/dataTables.responsive.min.js"></script> --><!-- responsive-->


<script type="text/javascript">


$('.zimage').zoomify();

			var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' + 
		    'onclick="alert(\'Call your custom code here.\')">' +
		    '<i class="glyphicon glyphicon-tag"></i>' +
		    '</button>'; 
	
  	$("#avatar-2").fileinput({
	    overwriteInitial: true,
	    maxFileSize: 5000,
	    showClose: false,
	    showCaption: false,
	    showBrowse: false,
	    browseOnZoneClick: true,
	    removeLabel: '',
	    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
	    removeTitle: 'Cancel or reset changes',
	    elErrorContainer: '#kv-avatar-errors-2',
	    msgErrorClass: 'alert alert-block alert-danger',
	    defaultPreviewContent: '<img src="upload_doc_img/no_image.jpg" alt="Your Avatar" style="width:160px"><h6 class="text-muted">Click to select</h6>',
	    layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
	    allowedFileExtensions: ["jpg", "png", "gif"]
		});
    

		$(document).ready(function() {
			$("#uploadImageForm").unbind('submit').bind('submit', function() {

				var form = $(this);
				var formData = new FormData($(this)[0]);

				$.ajax({
					url: form.attr('action'),
					type: form.attr('method'),
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					async: false,
					success:function(response) {
						if(response.success == true) {
							$("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');

							$('input[type="text"]').val('');
							$(".fileinput-remove-button").click();

              window.location.href="req_gen_upload.php?id=<?php echo $_GET['id']?>";

						}
						else {
							$("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');
						}
					}
				});

				return false;
			});
		});
	</script>

</body>

</html>
