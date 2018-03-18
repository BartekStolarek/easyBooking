<?php
require('db.php');
session_start();
		$id = $_POST['id'];
		
        $query = "DELETE FROM rooms WHERE id='$id'";
		mysqli_query($con, $query);
		
		header("Location: index.php");
?>