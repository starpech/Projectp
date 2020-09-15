<?php
    $conn = mysql_connect('localhost','root','');
    if($conn){
        $db_con = mysql_select_db ('guestbook_db');
        mysql_quely("SET NAMES utf8");
    } else {
        echo "connect fail !";
    }
?>