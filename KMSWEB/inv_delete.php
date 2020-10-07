<?php 
require_once 'php/connect.php';
$query = "update {$prefix_inv}main set flag_delete = 1 where {$prefix_inv}id  = '{$_GET['id']}' ";
$conn->query($query);
//echo "<script>window.location = '{$prefix_inv}gen.php' ;</script>";
header('location: '.$prefix_inv.'gen.php');