<?php
function getProduct($pid){
 $conn = new mysqli('localhost','root','kslitc@1234','kms_web_db');
 $conn->set_charset("utf8");
 $st = $conn->prepare("SELECT * FROM product where product_id =  {$pid} ");//กัน SQlinjection
 $st->execute(); //ประมวณผล ข้างบน
 $res = $st->get_result(); //การ GET ข้อมูล
 $row = $res->fetch_assoc();
 return $row;
}

print_r(getProduct(14));
