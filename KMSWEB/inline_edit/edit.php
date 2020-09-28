<?php
//DB Connection
include 'conn.php';

if ($_POST['action'] == 'edit') {
    $data = [
        ':emp_name' => $_POST['emp_name'],
        ':emp_designation' => $_POST['emp_designation'],
        ':gender' => $_POST['gender'],
        ':emp_contact' => $_POST['emp_contact'],
        ':id' => $_POST['id'],
    ];

    $query = "
 UPDATE emp_database 
 SET emp_name = :emp_name, 
 emp_designation = :emp_designation, 
 gender = :gender,
 emp_contact = :emp_contact 
 WHERE id = :id
 ";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    echo json_encode($_POST);
}

if ($_POST['action'] == 'delete') {
    $query =
        "
 DELETE FROM emp_database 
 WHERE id = '" .
        $_POST["id"] .
        "'
 ";
    $statement = $connect->prepare($query);
    $statement->execute();
    echo json_encode($_POST);
}

?>