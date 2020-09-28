<?php
//insert_req.php;
session_start();
$input_by = $_SESSION["mem_id"];
$comp_code = $_SESSION["comp_code"];
$input_date = date("Y-m-d");
$product_total = 0;

function getProduct($product_code){
  $conn = new mysqli('localhost','root','','kms_web_db');
  $conn->set_charset("utf8");
  $st = $conn->prepare("SELECT * FROM product where product_code =  '{$product_code}' ");
  $st->execute(); //ประมวณผล ข้างบน
  $res = $st->get_result(); //การ GET ข้อมูล
  $row = $res->fetch_assoc();
  return $row;
 }

if(isset($_POST["quota_id"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=kms_web_db", "root", "");
  
 for($count = 0; $count < count($_POST["quota_id"]); $count++)
 {

  $objProduct = getProduct($_POST["product_name"][$count]);
  switch($comp_code)
  {
    case "02":
      default:
      $price_unit = $objProduct['product_price1'];
    break;
    case "03":
      $price_unit = $objProduct['product_price2'];
    break;
    case "04":
      $price_unit = $objProduct['product_price3'];
    break;
    case "05":
      $price_unit = $objProduct['product_price4'];
    break;
    case "06":
      $price_unit = $objProduct['product_price5'];
    break;     
  }
  
  $product_total = $price_unit * floatval($_POST["product_amount"][$count]);

  $query = "INSERT INTO req_detail 
  (quota_id, quota_name, quota_ket, quota_place, product_name,product_code, product_amount, input_by, input_date, product_price , comp_code, product_total) 
  VALUES (:quota_id, :quota_name, :quota_ket, :quota_place, :product_name, :product_code, :product_amount, :input_by, :input_date, :product_price, :comp_code, :product_total)
  ";

  $statement = $connect->prepare($query);
  $statement->execute(
   array(
    ':quota_id' => $_POST["quota_id"][$count],
    ':quota_name' => $_POST["quota_name"][$count], 
    ':quota_ket' => $_POST["quota_ket"][$count], 
    ':quota_place' => $_POST["quota_place"][$count],
    ':product_name' => $objProduct['product_name'],
    ':product_code' => $_POST["product_name"][$count],
    ':product_amount' => $_POST["product_amount"][$count],
    ':input_by' => $input_by,
    ':input_date' => $input_date,
    ':product_price' => $price_unit,  //':product_price' => $objProduct['product_price1'],
    ':comp_code' => $objProduct['comp_code'],
    ':product_total' => $product_total,
    )
  );
 }
 $result = $statement->fetchAll();
 if(isset($result))
 {
  echo 'ok';
 }
}
?>