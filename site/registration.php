<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/styles.css" />
</head>
<body>
<?php
	require('db.php');
    if (isset($_REQUEST['username'])){
		$username = stripslashes($_REQUEST['username']);
		$username = mysqli_real_escape_string($con,$username);
		$email = stripslashes($_REQUEST['email']);
		$email = mysqli_real_escape_string($con,$email);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);

		$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, trn_date, account_type) VALUES ('$username', '".md5($password)."', '$email', '$trn_date', 'client')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form' style='text-align: center;'><h3>Rejestracja zakończona pomyślnie.</h3><br/>Kliknij <a href='login.php'>tutaj</a> aby się zalogować.</div>";
        }
    } else {
?>
	<div class="container">
		<h1> easy<b>Booking</b> </h1>
		<h3 style="margin-top: 70px;">Zarejestruj się</h3>
		
		<form name="registration" action="" method="post">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input type="text" class="form-control" name="username" placeholder="Użytkownik" required>
			</div>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
				<input type="email" class="form-control" name="email" placeholder="Email" required>
			</div>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input type="password" class="form-control" name="password" placeholder="Hasło" required>
			</div>

			<button style="margin-top: 20px;" type="submit" class="btn btn-primary">Zarejestruj się</button>
	</form>
	
	
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
