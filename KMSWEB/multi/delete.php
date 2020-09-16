<?php
//delete.php
session_start();
$input_by = $_SESSION["mem_id"];
$comp_code = $_SESSION["comp_code"];
$input_date = date("Y-m-d");

$connect = mysqli_connect("localhost", "root", "", "KMS_WEB_DB");
if(isset($_POST["id"]))
{
 foreach($_POST["id"] as $id)
 {
  //$query = "DELETE FROM req_detail WHERE id_no = '".$id."'";
  $query = "UPDATE req_detail SET approve_by = $input_by, approve_date = $input_date WHERE id_no = '".$id."'";
  mysqli_query($connect, $query);
 }
}
/*
// DELETE FROM tbl_customer WHERE CustomerID in (1,2,5)
$connect = mysqli_connect("localhost", "root", "", "test");
$ids = implode(",",$_POST['id']);
$query = "DELETE FROM tbl_customer WHERE CustomerID in ({$ids})  ";
mysqli_query($connect, $query);
*/
?>