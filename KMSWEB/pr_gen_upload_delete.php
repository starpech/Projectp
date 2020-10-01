<?php 
include_once "php/connect.php";
$id = $_GET['id'];
$conn->query("delete from pr_main_uploads where id = {$id}");
@unlink('upload_doc_img/'.$_GET['file_name']);
header("Location: pr_gen_upload.php?id=".$_GET['pr_id']); 