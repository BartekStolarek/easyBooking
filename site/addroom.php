<?php
require('db.php');
session_start();
		
		$number = $_POST['number'];
		$people = $_POST['people'];
		$price = $_POST['price'];
		
        $query = "INSERT INTO rooms (id, number, people, price) VALUES (NULL, '$number', '$people', '$price')";
		mysqli_query($con, $query);
		
		header("Location: index.php");
?>