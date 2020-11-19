<?php
include_once('../authen.php');
include_once('../../connect.php');
?>
<?php
//require_once('../../connect.php');
date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d');
//echo '<pre>',print_r ($_POST),'<pre>';


/*   
$query = "INSERT INTO tbl_order_items 
    (order_id, item_name, item_quantity, item_unit) 
        VALUES (:order_id, :item_name, :item_quantity, :item_unit)
*/


// paste here
if (isset($_POST["item_name"])) {
    $connect = new PDO("mysql:host=localhost;dbname=kms_web_db", "root", "kslitc@1234");
    $order_id = uniqid();
    for ($count = 0; $count < count($_POST["item_name"]); $count++) {
        $query = "INSERT INTO pr_detail 
  (Quota_id, Quota_name, Quota_ket, Quota_place, Product_name, Product_amount) 
  VALUES (:Quota_id, :Quota_name, :Quota_ket, :Quota_place, :Product_name, :Product_amount) 
  ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(

                ':Quota_id'  => $_POST[":Quota_id"][$count],
                ':Quota_ket' => $_POST["Quota_ket"][$count],
                ':Quota_place'  => $_POST["Quota_place"][$count],
                ':Product_name'  => $_POST["Product_name"][$count],
                ':Product_amount'  => $_POST["Product_amount"][$count],
            )
        );
    }
    $result = $statement->fetchAll();
    if (isset($result)) {
        echo 'ok';
    }
// paste here


} else {
    header('Location: ../../../../login.php');
}
?>