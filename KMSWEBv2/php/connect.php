<?php
    session_start();
    $conn = new mysqli('localhost','root','','kms_web_db');
    $conn->set_charset("utf8");

    if($conn->connect_errno){
        die("Connect Failed !!".$conn->connection_error);
    }



?>