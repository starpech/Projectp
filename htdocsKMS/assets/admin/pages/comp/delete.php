<?php 
include_once('../authen.php');
include_once('../../connect.php');
?>
<?php
    $comp_id=$_GET['comp_id'];
	$sql="UPDATE `comp` SET flag='1' WHERE comp_id = $comp_id";
   
    if (mysqli_query($conn, $sql)) {
        echo '<script> alert("ลบข้อมูลเสร็จสิ้น!")</script>'; 
        header('Refresh:0; url=index.php');
	} else {
        echo "Error deleting record: " . mysqli_error($connect);
        header('Refresh:0; url=index.php');
	}
	mysqli_close($conn);
?>