<?php
require('db.php');
session_start();
		$id = $_POST['id'];
		$number = $_POST['number'];
		$people = $_POST['people'];
		$price = $_POST['price'];
		
        $query = "UPDATE rooms SET number='$number', people='$people', price='$price' WHERE id='$id'";
		mysqli_query($con, $query);
		
		header("Location: index.php");
?>