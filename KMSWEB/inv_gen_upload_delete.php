<?php 
include_once "php/connect.php";
$id = $_GET['id'];
$conn->query("delete from {$prefix_inv}main_uploads where id = {$id}");
//echo "delete from {$prefix_inv}main_uploads where id = {$id}";
@unlink('upload_doc_img/'.$_GET['file_name']);
header("Location: {$prefix_inv}gen_upload.php?id=".$_GET[$prefix_inv.'id']); 