<?php 

if($_POST) {
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

	$valid = array('success' => false, 'messages' => array());

	$name = $_POST['fullName'];

	$type = explode('.', $_FILES['userImage']['name']);
	$type = $type[count($type) - 1];
	$url = '../uploads/' . uniqid(rand()) . '.' . $type;

	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {
		if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
			if(move_uploaded_file($_FILES['userImage']['tmp_name'], $url)) {

				// insert into database
				$sql = "INSERT INTO users (name, image) VALUES ('$name', '$url')";

				if($conn->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Uploaded";
				} 
				else {
					$valid['success'] = false;
					$valid['messages'] = "Error while uploading";
				}

				$conn->close();

			}
			else {
				$valid['success'] = false;
				$valid['messages'] = "Error while uploading";
			}
		}
	}

	echo json_encode($valid);

	// upload the file 
}