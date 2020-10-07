<?php
    session_start();
    global $conn;
    $conn = new mysqli('localhost','root','','kms_web_db');
    $conn->set_charset("utf8");

    if($conn->connect_errno){
        die("Connect Failed !!".$conn->connection_error);
    }

    // ตั่งค่าตัวแปรที่ใช้กันทุกหน้า
    global $preifx_inv,$preifx_po;

    $prefix_inv ='inv_';
    $prefix_po ='po_';

    // function ที่ใช้ทุกหน้า
    function debug($arr){
      echo "<pre>";
      print_r($arr);
      echo "</pre>";
    }
function dbComp(){
    global $conn;
    $query = "
    SELECT * FROM comp order by comp_code";
    $result = $conn->query($query);     
    if (!$result) {
      printf("Query failed: %s\n", $conn->error);
      exit;
    }      
    while($row = $result->fetch_row()) {
      $rows[]=$row;
    }
    $result->close();
    return $rows;
  }
  function dbProduct(){
    global $conn;
   $my_comp_code = (int)$_SESSION["comp_code"];
    $query = "
    SELECT *, product_price{$my_comp_code} as product_price FROM product where comp_code = '{$_SESSION["comp_code"]}' order by product_id";
    $query = "
    SELECT * , product_price{$my_comp_code} as product_price FROM product where 1=1 order by product_code";
    
    //echo ":::".$query;
  
    $result = $conn->query($query);     
    if (!$result) {
      printf("Query failed: %s\n", $conn->error);
      exit;
    }      
    while($row = $result->fetch_row()) {
      $rows[]=$row;
    }
    $result->close();
    return $rows;
  }
  
  function selectProducts(){
    //$htmlSelectProduct ="<select id='{$id}' onchange=\"jSelectProduct('{$key}',$(this))\" name='{$id}[]' class=\"form-control\">%s</select>";
    $op="<option val='' selected> -กรุณาเลือกสินค้า- </option>";
    $htmlSelectProduct ="%s";
    $data = dbProduct();
  
    if($data)
    foreach($data as $k=>$v){
      
        $op .= "<option value='{$v[5]}|{$v[21]}'> {$v[5]} : {$v[2]} </option>";
      
    }
    return sprintf($htmlSelectProduct,$op);
  }
?>