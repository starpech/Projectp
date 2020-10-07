<?php 
include_once "php/connect.php";
$query = "update bo_main set approved = 1 where bo_id='{$_GET['id']}'; ";
$conn->query($query);
header('location: '.$prefix_po.'gen.php');

//echo $query;