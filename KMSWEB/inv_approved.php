<?php 
include_once "php/connect.php";
$query = "update inv_main set approved = 1 where inv_id='{$_GET['id']}'; ";
$conn->query($query);
header('location: '.$prefix_inv.'gen.php');

//echo $query;