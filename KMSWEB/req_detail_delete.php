<?php 
require_once "php/connect.php";
$p = $_GET;
//debug($p);
$comp_code = $_SESSION["comp_code"];

$query = "
 DELETE FROM `req_detail{$comp_code}` WHERE `req_detail{$comp_code}`.`req_detail_id` = '{$p['req_detail_id']}'
";

//echo $query;

$conn->query($query);

header('location: req_edit.php');