<?php
include("auth.php");
require('db.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>easyBooking - Strona główna</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/styles.css" />
</head>
<body>
	<div class="container"> 
		<?php 			
		if ($_SESSION['accountType'] == 'client') {
			
			echo "<h3>Welcome ".$_SESSION['username']."!</h3>";
			echo "<br>";
			echo "<h2>Current booked rooms: </h2>";
		
		
			$id = $_SESSION['userId'];
			$isBooked = false;
			
			$query = "SELECT * FROM `booked` WHERE personid='$id'";
			$result = mysqli_query($con,$query) or die(mysql_error());
			$rows = mysqli_num_rows($result);
			if($rows>0){		
				$isBooked = true;
				$roomsId = array();
				$i = 0;
				
				while($row = mysqli_fetch_assoc($result)) {
					$roomsId[$i] = $row['roomid'];
					$i++;
				}	
				
			$i = 0;
			$bookedRooms = array();
			
			echo "<table class='table table-hover'>";
			echo "<thead>";
			echo "<tr>";
			echo "<th>Room number</th>";
			echo "<th>Price per night</th>";
			echo "<th>Number of persons</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			}
			else {
				echo "You aren't booking any rooms at this moment.";
			}
			
			
			if ($isBooked) {
				while($i < count($roomsId)) {
					$query = "SELECT * FROM `rooms` WHERE id='$roomsId[$i]'";
					$result = mysqli_query($con,$query) or die(mysql_error());
					$rows = mysqli_num_rows($result);
					if($rows>0){				
						
						while($row = mysqli_fetch_assoc($result)) {
							echo "<tr>";
							echo "<td>".$row['number']."</td>";
							echo "<td>".$row['price']."</td>";
							echo "<td>".$row['people']."</td>";
							echo "</tr>"; 
						}
					}
					$i++;
				}
				echo "</tbody>";
				echo "</table>";
			}
		
		echo "<br><br>";		
		echo "<h2> Book a room: </h2>";
		echo "<h4> Available rooms: </h4>";
		

			$query = "SELECT * FROM `booked`";
			$result = mysqli_query($con,$query) or die(mysql_error());
			$rows = mysqli_num_rows($result);
			$booked = "";
			
			if($rows>0){				
				$i = 0;
				
				while($row = mysqli_fetch_assoc($result)) {
					if ($booked == "")
						$booked = $row['roomid'];
					else
						$booked = $booked.",".$row['roomid'];
					
					$i++;
				}
			}
			
			$i = 0;
			
			echo "<table class='table table-hover'>";
			echo "<thead>";
			echo "<tr>";
			echo "<th>Room number</th>";
			echo "<th>Price per night</th>";
			echo "<th>Number of persons</th>";
			echo "<th></th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			
			$query = "SELECT * FROM `rooms` WHERE id NOT IN ($booked)";
			$result = mysqli_query($con,$query) or die(mysql_error());
			$rows = mysqli_num_rows($result);
			if($rows>0){				
				
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$row['number']."</td>";
					echo "<td>".$row['price']."</td>";
					echo "<td>".$row['people']."</td>";
					echo "<td><button onclick='bookRoom(".$row['id'].")' type='button' class='btn btn-primary'>Book</button></td>";
					echo "</tr>"; 
				}
				echo "</tbody>";
				echo "</table>";
			}
			else {
				echo "There are no available rooms at this moment. Come later!";
			}
		}
		
		else if ($_SESSION['accountType'] == 'admin') {
			echo "<h2 style='margin-top: 50px;'> Welcome, administrator! </h2>";
			
			echo "<div class='panel panel-primary'>";
			echo "<div class='panel-heading'>Add a room to database</div>";
			echo "<div class='panel-body'>";
			echo "<form action='addroom.php' method='post'><div class='form-group'><input type='number' class='form-control' placeholder='Room number' name='number'></div>";
			echo "<div class='form-group'><input type='number' class='form-control' name='people' placeholder='How many people'></div>";
			echo "<div class='form-group'><input type='number' class='form-control' name='price' placeholder='Price per night'></div>";
			echo "<div style='clear: both;'></div>";
			echo "<button style='margin-top: 20px;' type='submit' class='btn btn-primary'>Add</button></form></div></div>";	

			echo "<div style='margin-top: 20px; margin-bottom: 20px;'></div>";
			
			echo "<div class='panel panel-primary'>";
			echo "<div class='panel-heading'>Update room in database</div>";
			echo "<div class='panel-body'>";
			echo "<form action='updateroom.php' method='post'>";
			echo "<div class='form-group'><input type='number' class='form-control' placeholder='Room ID' name='id'></div>";
			echo "<div class='form-group'><input type='number' class='form-control' placeholder='Room number' name='number'></div>";
			echo "<div class='form-group'><input type='number' class='form-control' name='people' placeholder='How many people'></div>";
			echo "<div class='form-group'><input type='number' class='form-control' name='price' placeholder='Price per night'></div>";
			echo "<div style='clear: both;'></div>";
			echo "<button style='margin-top: 20px;' type='submit' class='btn btn-primary'>Update</button></form></div></div>";
			
			echo "<div style='margin-top: 20px; margin-bottom: 20px;'></div>";
			
			echo "<div class='panel panel-primary'>";
			echo "<div class='panel-heading'>Delete room from database</div>";
			echo "<div class='panel-body'>";
			echo "<form action='deleteroom.php' method='post'>";
			echo "<div class='form-group'><input type='number' class='form-control' placeholder='Room ID' name='id'></div>";
			echo "<div style='clear: both;'></div>";
			echo "<button style='margin-top: 20px;' type='submit' class='btn btn-primary'>Delete</button></form></div></div>";
			
			echo "<div style='margin-top: 20px; margin-bottom: 20px;'></div>";
			
			echo "<div class='panel panel-primary'>";
			echo "<div class='panel-heading'>Delete booking</div>";
			echo "<div class='panel-body'>";
			echo "<form action='deletebooking.php' method='post'>";
			echo "<div class='form-group'><input type='number' class='form-control' placeholder='Room ID' name='id'></div>";
			echo "<div style='clear: both;'></div>";
			echo "<button style='margin-top: 20px;' type='submit' class='btn btn-primary'>Delete</button></form></div></div>";
		}
		?>
		
		<br><br>
		
		<a href="logout.php">
		<button style='margin-bottom: 50px;' type="button" class="btn btn-primary">Sign out</button>
		</a>
	</div>
	

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>

function bookRoom(room) {
	   $.ajax({
			type: "POST",
			url: "book.php",
			dataType:'json',
			data: { room: room }
			}).done(function( msg ) {
		});
		location.reload();
   }
$(document).ready(function(){
});
</script>
</body>
</html>
