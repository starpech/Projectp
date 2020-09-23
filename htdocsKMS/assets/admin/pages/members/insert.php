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
		$mem_id=$_POST['mem_id'];
        $mem_code=$_POST['mem_code'];
        $mem_fname=$_POST['mem_fname'];
		$mem_lname=$_POST['mem_lname'];
        $comp_code=$_POST['comp_code'];
        $mem_email=$_POST['mem_email'];
        $mem_tel=$_POST['mem_tel'];
        $mem_address=$_POST['mem_address'];
        $mem_username=$_POST['mem_username'];
        $mem_password=$_POST['mem_password'];
        $mem_create_at='';
        $mem_date=$_POST['mem_date'];
        $mem_status=$_POST['mem_status'];
        $flag='0';
        
		
				
		$sql="INSERT INTO members (mem_id,mem_code, mem_fname, mem_lname, comp_code, mem_email, mem_tel, mem_address, mem_username, mem_password, mem_create_at, mem_date, mem_status, flag)
		VALUES ('$mem_id','$mem_code','$mem_fname','$mem_lname','$comp_code','$mem_email','$mem_tel','$mem_address','$mem_username','$mem_password','$mem_create_at','$mem_date','$mem_status','$flag')";
        $res= $conn->query($sql) or die($conn->error);

            if($res){
               
                echo '<script>alert("เพิ่มข้อมูลผู้ใช้ใหม่สำเร็จแล้ว") </script>';
               header('Refresh:0; url=index.php');//สำเร็จ
            }else{
				echo "Sql Error:ไม่สามารถแก้ไขข้อมูลได้".$sql; 
                header('Refresh:50; url=index.php');
            }

       
    }else{
        header('Location: ../../../../login.php');  
    }   
?>