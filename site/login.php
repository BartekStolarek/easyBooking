<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>easyBooking</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/styles.css" />
</head>
<body>
<?php
	require('db.php');
	session_start();
    if (isset($_POST['username'])){
		
		$username = stripslashes($_REQUEST['username']);
		$username = mysqli_real_escape_string($con,$username);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		
        $query = "SELECT * FROM `users` WHERE username='$username' and password='".md5($password)."'";
		$result = mysqli_query($con,$query) or die(mysql_error());
		$rows = mysqli_num_rows($result);
        if($rows==1){
			$_SESSION['username'] = $username;
			
			$wiersz = $result->fetch_assoc();
			$_SESSION['userId'] = $wiersz['id'];
			$_SESSION['accountType'] = $wiersz['account_type'];
			
			header("Location: index.php");
            } else {
				echo "<div class='form' style='text-align: center;'><h3>Użytkownik lub hasło jest niepoprawne.</h3><br/> Kliknij tutaj żeby <a href='login.php'>zalogować się ponownie.</a></div>";
			}
    } else {
?>
	<div class="container">
		<h1> easy<b>Booking</b> </h1>
		<h3 style="margin-top: 70px;">Zaloguj się</h3>

		<form action="" method="post" name="login">	
			<div class="input-group col-lg-12">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input type="text" class="form-control" name="username" placeholder="Użytkownik">
			</div>
			<div class="input-group col-lg-12">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input type="password" class="form-control" name="password" placeholder="Hasło">
			</div>

			<button style="margin-top: 20px;" type="submit" class="btn btn-primary">Zaloguj się</button>
		</form>
		<p style="margin-top: 50px;">Nie masz jeszcze konta? Kliknij <a href='registration.php'>tutaj</a>, aby się zarejestrować.</p>

	</div>
	<?php } ?>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
