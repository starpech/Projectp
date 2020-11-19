<?php 
include_once "php/connect.php";
$id = $_GET['id'];
$conn->query("delete from req_detail_uploads where id = {$id}");
@unlink('upload_doc_img/'.$_GET['file_name']);
header("Location: req_gen_upload.php?id=".$_GET['req_id']); 