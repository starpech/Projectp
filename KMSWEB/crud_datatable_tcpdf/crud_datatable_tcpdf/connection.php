<?php
	//for MySQLi OOP
	$conn2 = new mysqli('localhost', 'root', 'kslitc@1234', 'mydatabase');
	if($conn2->connect_error){
	   die("Connection failed: " . $conn2->connect_error);
	}
	////////////////

	//for MySQLi Procedural
	// $conn = mysqli_connect('localhost', 'root', '', 'mydatabase');
	// if(!$conn){
	//     die("Connection failed: " . mysqli_connect_error());
	// }
	////////////////
?>