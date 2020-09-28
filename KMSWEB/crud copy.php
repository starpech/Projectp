<?php 
require_once('php/connect.php');
include('includes/function.php');
?>
<?php $crud_path = "crud_datatable_tcpdf/crud_datatable_tcpdf/"; ?>
<?php //include_once("{$crud_path}connection.php"); ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>แก้ไขรายการขอซื้อ</title>

	<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css"> <!--เรียกbootstrap -->
    <link rel="stylesheet" href="node_modules/font-awesome5/css/fontawesome-all.css"> <!--เรียกfontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
    <link rel="stylesheet" href="node_modules/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/css/flag-icon.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
 

	<style>
		.height10{
			height:10px;
		}
		.mtop10{
			margin-top:10px;
		}
		.modal-label{
			position:relative;
			top:7px
		}
	</style>
</head>
<body>
<?php include('includes/navbar.php')?>

<div class="container-fluid">
   <br><br><br><br><br>
   <div class="container">
	<h1 class="page-header text-center">แก้ไขรายการขอซื้อ</h1>
	<div class="row">
		<div class="col-lg-12 ">
			<div class="row">
			<?php
				if(isset($_SESSION['error'])){
					echo
					"
					<div class='alert alert-danger text-center'>
						<button class='close'>&times;</button>
						".$_SESSION['error']."
					</div>
					";
					unset($_SESSION['error']);
				}
				if(isset($_SESSION['success'])){
					echo
					"
					<div class='alert alert-success text-center'>
						<button class='close'>&times;</button>
						".$_SESSION['success']."
					</div>
					";
					unset($_SESSION['success']);
				}
			?>
			</div>
			<div class="row">
				<a href="#addnew" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> New</a>
				<a href="<?php echo $crud_path; ?>print_pdf.php" class="btn btn-success pull-right"><span class="glyphicon glyphicon-print"></span> PDF</a>
			</div>
			<div class="height10">
			</div>
			<div >
				<table id="myTable" class="table table-bordered table-striped">
					<thead>
					<th width="15%"><h5 align="center">เลขที่โควตา</h5></th>
       <th width="20%"><h5 align="center">ชื่อ - นามสกุล</h5></th>
       <th width="10%"><h5 align="center">เขต</h5></th>
       <th width="15%"><h5 align="center">สถานที่จัดส่ง</h5></th>
       <th width="25%"><h5 align="center">ชื่อสินค้า</h5></th>
       <th width="10%"><h5 align="center">จำนวน</h5></th>
					</thead>
					<tbody>
						<?php
							/*
							$sql = "SELECT * FROM members";

							//use for MySQLi-OOP
							$query = $conn->query($sql);

							while($row = $query->fetch_assoc()){

								echo 
								"<tr>
									<td>".$row['id']."</td>
									<td>".$row['firstname']."</td>
									<td>".$row['lastname']."</td>
									<td>".$row['address']."</td>
									<td>
										<a href='#edit_".$row['id']."' class='btn btn-success btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> Edit</a>
										<a href='#delete_".$row['id']."' class='btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Delete</a>
									</td>
								</tr>";

							include("{$crud_path}edit_delete_modal.php");	
							}
							*/
							
							/////////////////

							//use for MySQLi Procedural
							// $query = mysqli_query($conn, $sql);
							// while($row = mysqli_fetch_assoc($query)){
							// 	echo
							// 	"<tr>
							// 		<td>".$row['id']."</td>
							// 		<td>".$row['firstname']."</td>
							// 		<td>".$row['lastname']."</td>
							// 		<td>".$row['address']."</td>
							// 		<td>
							// 			<a href='#edit_".$row['id']."' class='btn btn-success btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> Edit</a>
							// 			<a href='#delete_".$row['id']."' class='btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Delete</a>
							// 		</td>
							// 	</tr>";
							// 	include('edit_delete_modal.php');
							// }
							/////////////////

						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	</div>
</div>
<?php include("{$crud_path}add_modal.php") ?>


<!--
	<script src="<?php echo $crud_path; ?>jquery/jquery.min.js"></script>
	<script src="<?php echo $crud_path; ?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $crud_path; ?>datatable/jquery.dataTables.min.js"></script>
    <script src="<?php echo $crud_path; ?>datatable/dataTable.bootstrap.min.js"></script> 

-->

<!-- generate datatable on our table -->
<script>
$(document).ready(function(){
	//inialize datatable
    $('#myTable').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});
</script>

</body>
</html>
