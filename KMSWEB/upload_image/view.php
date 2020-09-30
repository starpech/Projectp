<!DOCTYPE html>
<html>
<head>
	<title></title>

	<!-- boostrap css-->
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
</head>
<body>

<br /> <br /> <br />
<div class="col-md-5 col-sm-5 col-md-offset-4 col-sm-offset-4">
	<a href="index.php" class="btn btn-default">Back</a>
	<table class="table table-bordered">
		<tr>
			<th>S.no</th>
			<th>Name</th>
			<th>Photo</th>
		</tr>

		<?php 
		// database connection
		$server = '127.0.0.1';
		$username = 'root';
		$password = '';
		$dbname = 'upload_image';

		$conn = new mysqli($server, $username, $password, $dbname);

		// check db connection
		if($conn->connect_error) {
			die("Connection Failed : " . $conn->connect_error);
		} 
		else {
			// echo "Successfully Connected";
		}

		$sql = "SELECT * FROM users";
		$query = $conn->query($sql);

		$x = 1;
		while ($result = $query->fetch_assoc()) {
			$image = substr($result['image'], 3);

			echo "<tr>
				<td>".$x."</td>
				<td>".$result['name']."</td>
				<td> <img src='".$image."' style='height:100px; width:100px;' /> </td>
			</tr>";
			$x++;
		}

		?>
	</table>
</div>

</body>
</html>