<?php 
include_once "php/connect.php";
//$comp_code = $_SESSION['comp_code'];
$reqnumber = $_GET["id"];
$factory = trim(substr($_GET["id"],0,2));

if ($factory == "NP") {
      $query = "update req_detail02 set status = 2 where req_detail_id ='$reqnumber' ";
      $conn->query($query);
} else if ($factory == "WP") {
      $query = "update req_detail03 set status = 2 where req_detail_id ='$reqnumber' ";
      $conn->query($query);
} else if ($factory == "BP") {
      $query = "update req_detail04 set status = 2 where req_detail_id ='$reqnumber' ";
      $conn->query($query);
} else if ($factory == "TK") {
      $query = "update req_detail05 set status = 2 where req_detail_id ='$reqnumber' ";
      $conn->query($query);
} else if ($factory == "PN") {
      $query = "update req_detail06 set status = 2 where req_detail_id ='$reqnumber' ";
      $conn->query($query);
} else {
	echo("record find table not found");
}
header('location: req_list_supply.php');
//echo (trim(substr($_GET["id"],0,2)));
//echo $factory;
//if ($factory == 'BP') {
//   echo $reqnumber;
//}
//$first="dogs";
//      if ($first=="dogs")
//        {
//          echo "First is dogs";//เป็นจริงก็จะแสดงข้อความว่า First               is dogs
//        } 
//        else
//        {
//          print "Not is dogs";//เป็นเท็จ ก็จะแสดงว่า  Not is dogs
//        }
?>
