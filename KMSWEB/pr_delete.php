<?php 
require_once 'php/connect.php';
$query = "update pr_main set flag_delete = 1 where pr_id  = '{$_GET['id']}' ";
$conn->query($query);
//echo "<script>window.location = 'pr_gen.php' ;</script>";
header('location: pr_gen.php');