<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- boostrap css-->
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">

	<!-- file input css -->
	<link rel="stylesheet" type="text/css" href="assets/fileinput/css/fileinput.min.css">
</head>
<body>

	<div class="col-md-5 col-sm-5 col-md-offset-4 col-sm-offset-4">
		<div class="page-header">
			<h3>Upload Image with Ajax</h3>

			<a href="view.php" class="btn btn-default">View User</a>
		</div>

		<div id="messages"></div>

		<form action="php_action/uploadImage.php" method="post" enctype="multipart/form-data" id="uploadImageForm">
		  <div class="form-group">
		    <label for="fullName">Name</label>
		    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Name">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Photo</label>		    
		    <div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>

            <div class="kv-avatar center-block" style="width:200px">
		        <input id="avatar-2" name="userImage" type="file" class="file-loading">
		    </div>
		  </div>
		  <button type="submit" class="btn btn-default">Submit</button>
		</form>

	</div>
	
	<!-- jquery -->
	<script type="text/javascript" src="assets/jquery/jquery.min.js"></script>
	<!-- bootsrap js -->
	<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- file input -->
	<script src="assets/fileinput/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>	
	<script src="assets/fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>	
	<script src="assets/fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
	<script src="assets/fileinput/js/fileinput.min.js"></script>

	<script type="text/javascript">
			var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' + 
		    'onclick="alert(\'Call your custom code here.\')">' +
		    '<i class="glyphicon glyphicon-tag"></i>' +
		    '</button>'; 
		$("#avatar-2").fileinput({
	    overwriteInitial: true,
	    maxFileSize: 1500,
	    showClose: false,
	    showCaption: false,
	    showBrowse: false,
	    browseOnZoneClick: true,
	    removeLabel: '',
	    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
	    removeTitle: 'Cancel or reset changes',
	    elErrorContainer: '#kv-avatar-errors-2',
	    msgErrorClass: 'alert alert-block alert-danger',
	    defaultPreviewContent: '<img src="uploads/default-avatar.jpg" alt="Your Avatar" style="width:160px"><h6 class="text-muted">Click to select</h6>',
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