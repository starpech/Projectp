<?php error_reporting(~E_ALL);?>

<?php require_once('php/connect.php');
include('includes/function.php');
?>

<?php 

if($_POST) {

	$valid = array('success' => false, 'messages' => array());

	$name = $_POST[$prefix_inv.'image_title'];
	$pr_id = $_POST[$prefix_inv.'id'];

	$type = explode('.', $_FILES[$prefix_inv.'image']['name']);
	$type = $type[count($type) - 1];
	$url = 'upload_doc_img/' . uniqid(rand()) . '.' . $type;

	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {
		if(is_uploaded_file($_FILES[$prefix_inv.'image']['tmp_name'])) {
			if(move_uploaded_file($_FILES[$prefix_inv.'image']['tmp_name'], $url)) {

				// insert into database
				$sql = "INSERT INTO {$prefix_inv}main_uploads ({$prefix_inv}id, {$prefix_inv}image_title,{$prefix_inv}image_path) 
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