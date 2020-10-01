<?php error_reporting(~E_ALL);?>

<?php require_once('php/connect.php');
include('includes/function.php');
?>

<?php 

if($_POST) {

	$valid = array('success' => false, 'messages' => array());

	$name = $_POST['pr_image_title'];
	$pr_id = $_POST['pr_id'];

	$type = explode('.', $_FILES['pr_image']['name']);
	$type = $type[count($type) - 1];
	$url = 'upload_doc_img/' . uniqid(rand()) . '.' . $type;

	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {
		if(is_uploaded_file($_FILES['pr_image']['tmp_name'])) {
			if(move_uploaded_file($_FILES['pr_image']['tmp_name'], $url)) {

				// insert into database
				$sql = "INSERT INTO pr_main_uploads (pr_id, pr_image_title,pr_image_path) 
				VALUES ('{$pr_id}','{$name}', '{$url}')";

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