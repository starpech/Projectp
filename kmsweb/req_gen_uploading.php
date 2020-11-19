<?php error_reporting(~E_ALL);?>

<?php require_once('php/connect.php');
include('includes/function.php');
?>

<?php 

if($_POST) {

	$valid = array('success' => false, 'messages' => array());

	$name = $_POST['req_image_title'];
	$req_id = $_POST['req_id'];

	$type = explode('.', $_FILES['req_image']['name']);
	$type = $type[count($type) - 1];
	$url = 'upload_doc_img/' . uniqid(rand()) . '.' . $type;

	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {
		if(is_uploaded_file($_FILES['req_image']['tmp_name'])) {
			if(move_uploaded_file($_FILES['req_image']['tmp_name'], $url)) {

				// insert into database
				$sql = "INSERT INTO req_detail_uploads (req_id, req_image_title,req_image_path) 
				VALUES ('{$req_id}','{$name}', '{$url}')";

				if($conn->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Uploaded";
				} 
				else {
					$valid['success'] = false;
					$valid['messages'] = "Error while uploading";
				}

				//$conn->close();

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