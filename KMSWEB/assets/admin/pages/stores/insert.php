
    <?php 
    require_once('../../connect.php');
    //echo '<pre>',print_r ($_POST),'<pre>';
    if(isset($_POST['submit'])){
       // echo '<pre>',print_r ($_FILES['file']),'<pre>';
        $file=$_POST['file'];
        $product_name=$_POST['product_name'];
        $product_detail=$_POST['product_detail'];
        $product_price1=$_POST['product_price1'];
        $product_price2=$_POST['product_price2'];
        $product_price3=$_POST['product_price3'];
        $product_price4=$_POST['product_price4'];
        $product_price5=$_POST['product_price5'];
        $product_cost1=$_POST['product_cost1'];
        $product_cost2=$_POST['product_cost2'];
        $product_cost3=$_POST['product_cost3'];
        $product_cost4=$_POST['product_cost4'];
        $product_cost5=$_POST['product_cost5'];
        $product_code=$_POST['product_code'];
        $product_tag=$_POST['product_tag'];
        $product_date=$_POST['product_date'];
       $temp=explode('.',$_FILES['file']['name']);
        $new_namestore=round(microtime(true)*9999) . '.' . end($temp);
        $url='../../../../assets/image/store/'. $new_namestore;
        if(move_uploaded_file($_FILES['file']['tmp_name'],$url)){
            $sql="INSERT INTO product (product_id, product_name, product_image,product_detail, product_code, product_price1, product_price2, product_price3, product_price4, product_price5, product_cost1, product_cost2, product_cost3, product_cost4, product_cost5, product_tag, product_date) 
                    VALUES ('','$product_name','$new_namestore','$product_detail','$product_code','$product_price1','$product_price2','$product_price3','$product_price4','$product_price5','$product_cost1','$product_cost2','$product_cost3','$product_cost4','$product_cost5','$product_tag','$product_date')";
        $res= $conn->query($sql) or die($conn->error);
            if($res){
                $_SESSION['product_image'] = $new_namestore;
               echo '<script>alert("เพิ่มสินค้าสำเร็จแล้ว") </script>';
                header('Refresh:0; url=index.php');//สำเร็จ
            }else{
                echo $sql;
            }
        }

       
    }else{
       header('Location: ../../../../login.php');  
    }   
    ?>