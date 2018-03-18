<?php
require('db.php');
session_start();
		$id = $_POST['id'];
		
        $query = "DELETE FROM booked WHERE roomid='$id'";
		mysqli_query($con, $query);
		
		header("Location: index.php");
?>