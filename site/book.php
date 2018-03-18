<?php

require('db.php');
session_start();		
		$room = $_POST['room'];
		$user = $_SESSION['userId'];
		
        $query = "INSERT INTO booked (personid, roomid) VALUES ('$user', '$room')";
		mysqli_query($con, $query);
?>