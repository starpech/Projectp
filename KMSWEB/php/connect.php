<?php
    session_start();
    global $conn;
    $conn = new mysqli('localhost','root','kslitc@1234','kms_web_db');
    $conn->set_charset("utf8");

    if($conn->connect_errno){
        die("Connect Failed !!".$conn->connection_error);
    }

    // ตั่งค่าตัวแปรที่ใช้กันทุกหน้า
    global $preifx_inv,$preifx_po;

    $prefix_inv ='inv_';
    $prefix_po ='bo_';

  //function ที่ใช้ทุกหน้า
   function debug($arr){
      echo "<pre>";
      print_r($arr);
      echo "</pre>";
    }
function dbComp($comp_type=''){
    global $conn;
	if(!$comp_type){
       $query = "  SELECT * FROM comp where 1 order by comp_code ";
	}else{
		$query = "  SELECT * FROM comp where comp_type like '{$comp_type}'   order by comp_code ";
		
	}
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

  function selectProductsEdit($id,$value=''){
    $htmlSelectProduct ="<select id='{$id}' name='{$id}[]' class=\"form-control\">%s</select>";
    $op='';
    $data = dbProduct();
  
    if($data)
    foreach($data as $k=>$v){
      if($v[5] == $value){
        $op .= "<option value='{$v[5]}' selected> {$v[5]} : {$v[2]} </option>";
      }else{
        $op .= "<option value='{$v[5]}'> {$v[5]} : {$v[2]} </option>";
      }
    }
    return sprintf($htmlSelectProduct,$op);
  }
  
  function dbProductInv(){
    global $conn;
   $my_comp_code = (int)$_SESSION["inv_rid"];
    
	$query = "
    SELECT * , product_cost{$my_comp_code} as product_price FROM product where 1=1 order by product_code";
    
   // echo ":::".$query;
  
    $result = $conn->query($query);     
    if (!$result) {
      printf("Query failed: %s\n", $conn->error);
      exit;
    }      
    while($row = $result->fetch_array()) {
      $rows[]=$row;
    }
    $result->close();
    return $rows;
  }
  
  function selectProductsInv(){
    //$htmlSelectProduct ="<select id='{$id}' onchange=\"jSelectProduct('{$key}',$(this))\" name='{$id}[]' class=\"form-control\">%s</select>";
    $op="<option val='' selected> -กรุณาเลือกสินค้า- </option>";
    $htmlSelectProduct ="%s";
    $data = dbProductInv();
  
    if($data)
    foreach($data as $k=>$v){
      
        $op .= "<option value='{$v[5]}|{$v['product_price']}'> {$v[5]} : {$v[2]} </option>";
      
    }
    return sprintf($htmlSelectProduct,$op);
  }
  
  function selectProductsEditInv($id,$value='',$k){
    $htmlSelectProduct ="<select id='{$id}' name='{$id}[]' onchange=\"jSelectProduct('{$k}',$(this))\" class=\"form-control\">%s</select>";
    $op='';
    $data = dbProductInv();
  
    if($data)
    foreach($data as $k=>$v){
      if($v[5] == $value){
        $op .= "<option value='{$v[5]}|{$v['product_price']}' selected> {$v[5]} : {$v[2]} </option>";
      }else{
        $op .= "<option value='{$v[5]}|{$v['product_price']}'> {$v[5]} : {$v[2]} </option>";
      }
    }
		$op .= "<script>
	function jSelectProduct(key,obj){
      let objPrice = $('#price_'+key);
      let val = obj.val().split('|');
      objPrice.val(val[1]);
	  setTimeout(function(){ objPrice.blur(); },1000);
    } 
	</script>
	";
    return sprintf($htmlSelectProduct,$op);
  }
  
  
  
function dbProductBo(){
    global $conn;
   $my_comp_code = (int)$_SESSION["bo_rid"];
    
	$query = "
    SELECT * , product_cost{$my_comp_code} as product_price FROM product where 1=1 order by product_code";
    
   // echo ":::".$query;
  
    $result = $conn->query($query);     
    if (!$result) {
      printf("Query failed: %s\n", $conn->error);
      exit;
    }      
    while($row = $result->fetch_array()) {
      $rows[]=$row;
    }
    $result->close();
    return $rows;
  }
  
  function selectProductsBo(){
    //$htmlSelectProduct ="<select id='{$id}' onchange=\"jSelectProduct('{$key}',$(this))\" name='{$id}[]' class=\"form-control\">%s</select>";
    $op="<option val='' selected> -กรุณาเลือกสินค้า- </option>";
    $htmlSelectProduct ="%s";
    $data = dbProductBo();
  
    if($data)
    foreach($data as $k=>$v){
      
        $op .= "<option value='{$v[5]}|{$v['product_price']}'> {$v[5]} : {$v[2]} </option>";
      
    }
    return sprintf($htmlSelectProduct,$op);
  }
  
  function selectProductsEditBo($id,$value,$k){
    $htmlSelectProduct ="<select id='{$id}' name='{$id}[]' onchange=\"jSelectProduct('{$k}',$(this))\" class=\"form-control\">%s</select>";
    $op='';
    $data = dbProductBo();
  
    if($data)
    foreach($data as $k=>$v){
      if($v[5] == $value){
        $op .= "<option value='{$v[5]}|{$v['product_price']}' selected> {$v[5]} : {$v[2]} </option>";
      }else{
        $op .= "<option value='{$v[5]}|{$v['product_price']}'> {$v[5]} : {$v[2]} </option>";
      }
    }
	$op .= "<script>
	function jSelectProduct(key,obj){
      let objPrice = $('#price_'+key);
      let val = obj.val().split('|');
      objPrice.val(val[1]);
	  setTimeout(function(){ objPrice.blur(); },1000);
    } 
	</script>
	";
    return sprintf($htmlSelectProduct,$op);
  }
  
?>