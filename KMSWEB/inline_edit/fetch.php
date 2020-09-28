<?php
//DB Connection
include 'conn.php';

$column = ["id", "emp_name", "emp_designation", "gender", "emp_contact"];

$query = "SELECT * FROM emp_database ";

if (isset($_POST["search"]["value"])) {
    $query .=
        '
 WHERE emp_name LIKE "%' .
        $_POST["search"]["value"] .
        '%" 
 OR emp_designation LIKE "%' .
        $_POST["search"]["value"] .
        '%" 
 OR gender LIKE "%' .
        $_POST["search"]["value"] .
        '%" 
 OR emp_contact LIKE "%' .
        $_POST["search"]["value"] .
        '%" 
 ';
}

if (isset($_POST["order"])) {
    $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= 'ORDER BY id ASC ';
}
$query1 = '';

if ($_POST["length"] != -1) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = [];

foreach ($result as $row) {
    $sub_array = [];
    $sub_array[] = $row['id'];
    $sub_array[] = $row['emp_name'];
    $sub_array[] = $row['emp_designation'];
    $sub_array[] = $row['gender'];
    $sub_array[] = $row['emp_contact'];
    $data[] = $sub_array;
}

function count_all_data($connect)
{
    $query = "SELECT * FROM emp_database";
    $statement = $connect->prepare($query);
    $statement->execute();
    return $statement->rowCount();
}

$output = [
    'draw' => intval($_POST['draw']),
    'recordsTotal' => count_all_data($connect),
    'recordsFiltered' => $number_filter_row,
    'data' => $data,
];

echo json_encode($output);

?>