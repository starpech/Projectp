<?php 
include_once('../authen.php');
include_once('../../connect.php');
?>
<?php 
    // require_once('../../connect.php');
    date_default_timezone_set('Asia/Bangkok');
    $date=date('Y-m-d');
    //echo '<pre>',print_r ($_POST),'<pre>';
    if(isset($_POST['submit'])){
        //echo '<pre>',print_r ($_FILES['file']),'<pre>';
		$comp_id=$_POST['comp_id'];
        $comp_code=$_POST['comp_code'];
        $comp_name=$_POST['comp_name'];
        $comp_nickname=$_POST['comp_nickname'];
        $comp_addr=$_POST['comp_addr'];
        $comp_tel=$_POST['comp_tel'];
        $comp_fax=$_POST['comp_fax'];
        $comp_email=$_POST['comp_email'];
        $comp_type=$_POST['comp_type'];
        $sql="INSERT INTO `comp` VALUES ('','$comp_code','$comp_name','$comp_nickname','$comp_addr','$comp_tel','$comp_fax','$comp_email','$comp_type','$date','0')";
        $res= $conn->query($sql) or die($conn->error);

            if($res){
               
                echo '<script>alert("เพิ่มข้อมูลบริษัทสำเร็จแล้ว") </script>';
               header('Refresh:0; url=index.php');//สำเร็จ
            }else{
				echo "Sql Error:ไม่สามารถแก้ไขข้อมูลได้".$sql; 
                header('Refresh:50; url=index.php');
            }

       
    }else{
        header('Location: ../../../../login.php');  
    }   
?>