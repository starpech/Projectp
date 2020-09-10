<?php 
    $firstname = $_GET['firstname'];
    $password = $_GET['password'];
    $comment = $_GET['comment'];
?>

<?php 
    if(isset($firstname, $password, $comment)) {
        echo "ข้อมูลที่รับเข้ามา &nbsp";echo"<br>";
        echo $firstname;echo"<br>";
        echo $password;echo"<br>";
        echo $comment;
    } else{
        echo "ไม่มีอะไร";
    }
?>