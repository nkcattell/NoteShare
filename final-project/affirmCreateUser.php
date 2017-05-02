<!doctype html>


<?php 
	require_once "userAuth.php";
	
	$db_connection = new mysqli($host, $user, $password, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	} else {
		// echo "Connection to database established<br><br>";
	}
	
	$username = $_POST['Username'];
	$password = $_POST['Password'];
	$query = "select * from users where name = '" . $username . "'";
	
	$result = $db_connection->query($query);
	if (!$result) {
		die("Retrieval failed: ". $db_connection->error);
	} else {
		/* Number of rows found */
		$num_rows = $result->num_rows;
		if ($num_rows === 0) {
			$insert = "insert into users (name, userid, password) values ('$username','$password')";
			$insertion = $db_connection->query($insert);
			if (!$insertion) {
				die("Insertion failed: ". $db_connection->error);
			}
			
			session_start();
			$_SESSION['user'] = $username;
			header("Location: main.html");
		} else {
			echo "<h1>Username already exists.  Please enter a different username.</h1>";
			
		}
	}
?> 

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Noteshare Login Page</title>
		<link href="resources/css/bootstrap.min.css" rel="stylesheet">
		<! <link rel="stylesheet" type="text/css" href="resources/style.css"/ > 
	</head>
	
	<body>
		
		<h1>Welcome to Noteshare!</h1>
		
		<h4>Login if you're already a member, or click Create Account<h4>
		
		<form class="form-horizontal" method=post action="affirmLogin.php">
			<fieldset>
				<div class="form-group">
					<label class="col-md-4 control-label">Username:</label>
					<div class="col-md-4">
						<input id="title" name="Username" type="text" class="form-control input-md" required="">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-4 control-label">Password:</label>
					<div class="col-md-4">
						<input id="title" name="Password" type="password" class="form-control input-md" required=""> </br>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-4 control-label" for="button"></label>
					<div class="col-md-4 center-block">
						<button type="submit" id="login" name="login" class="btn btn-primary center-block">Login</button>
					</div>
				</div>
			</fieldset>
		</form>
		
		<form class="form-horizontal" method=post action="createUser.php">
			<div class="form-group">
				<label class="col-md-4 control-label" for="button"></label>
				<div class="col-md-4 center-block">
					<button type="submit" id="create" name="create" class="btn btn-primary center-block">Create Account</button>
				</div>
			</div>
		</form>
		
	</body>
</html>
			