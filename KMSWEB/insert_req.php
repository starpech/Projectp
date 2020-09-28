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
 function getReqDetailID($input_by){
   $sql = "
   
   select x.comp_code ,x.ccno from (
    SELECT 
    r.m_comp_code as comp_code, 
    concat(c.comp_nickname, right(concat('000000',count(r.m_comp_code)+1),5)) as ccno FROM (select r.id_no,m.comp_code as m_comp_code from req_detail as r , members as m 
    where r.input_by = m.mem_id and r.input_by = '{$input_by}' ) as r right JOIN comp as c on r.m_comp_code = c.comp_code 
    
    UNION all 
    select comp_code, concat(comp_nickname,'00001') as ccno from comp where comp_code in (select m.comp_code from members as m where m.mem_id = '{$input_by}')
        
    ) as x order by x.ccno desc limit 1

   ";
   echo $sql;
   $conn = new mysqli('localhost','root','','kms_web_db');
   $conn->set_charset("utf8");
   $st = $conn->prepare($sql);
   $st->execute(); //ประมวณผล ข้างบน
   $res = $st->get_result(); //การ GET ข้อมูล
   $row = $res->fetch_assoc();
  return $row['ccno'];

 }

if(isset($_POST["quota_id"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=kms_web_db", "root", "");
  
 for($count = 0; $count < count($_POST["quota_id"]); $count++)
 {

  $objProduct = getProduct($_POST["product_name"][$count]);

  //$reqDetailID = getReqDetailID($input_by);
  ///echo $reqDetailID;

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

  $query = "INSERT INTO req_detail{$comp_code} 
  ( quota_id, quota_name, quota_ket, quota_place, product_name,product_code, product_amount, input_by, input_date, product_price , comp_code, product_total) 
  VALUES ( :quota_id, :quota_name, :quota_ket, :quota_place, :product_name, :product_code, :product_amount, :input_by, :input_date, :product_price, :comp_code, :product_total)
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
 $update_req_detail_id = "
 update req_detail{$comp_code} as r set req_detail_id  = concat( 
  (select c.comp_nickname from members as m , comp as c 
    where m.comp_code = c.comp_code and m.mem_id =  r.input_by) ,r.id_no  )
 ";
 $connect->query($update_req_detail_id);
 if(isset($result))
 {
  echo 'ok';
 }
}
?>