<?php 
require_once 'php/connect.php';
$query = "update {$prefix_po}main set flag_delete = 1 where {$prefix_po}id  = '{$_GET['id']}' ";
$conn->query($query);
//echo "<script>window.location = '{$prefix_po}gen.php' ;</script>";
header('location: '.$prefix_po.'gen.php');