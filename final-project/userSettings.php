<!doctype html>

<?php
	if (isset($_POST["return"])) {
		header("Location: profile.php");
	}

	require_once "userAuth.php";
	session_start();
	$username = $_SESSION["user"];
	$complete = "";

	$db_connection = new mysqli($host, $user, $password, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	}

	if (isset($_POST["submit"])) {

		$updateName = $_POST["name"];
		$updatePass = $_POST["password"];
		$updateBio = $_POST["bio"];

		if ($_FILES["picture"]["tmp_name"]) {
			$pictureFile = addslashes(file_get_contents($_FILES["picture"]["tmp_name"]));
			$query = "update users set name = '{$updateName}', password = '{$updatePass}',"; 
			$query .= "settings = '{$updateBio}', picture = '{$pictureFile}' where name = '{$_SESSION["user"]}'";
		}
		else {
			$query = "update users set name = '{$updateName}', password = '{$updatePass}',"; 
			$query .= "settings = '{$updateBio}' where name = '{$_SESSION["user"]}'";
		}

		$result = mysqli_query($db_connection, $query);
		$_SESSION["user"] = $updateName;
		$complete = "Profile Updated!";
	}

	$query = "select name, password, settings from users where name = '{$_SESSION["user"]}'";
	$result = mysqli_query($db_connection, $query);
	if ($result) {
		$resultArray = mysqli_fetch_assoc($result);
	}

	mysqli_close($db_connection);
?>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Noteshare User Settings Page</title>
		<link href="resources/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="resources/style.css"/>
	</head>
	
	<body>
			<nav class="navbar navbar-inverse navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="main.php"><strong><i id="logo">NoteShare</i></strong></a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="profile.php">Profile</a></li>
                    	<li><a href="upload.php">Upload</a></li>
						<li><a href="login.php">Login</a></li>
                    	<li><a href="createUser.php">Register</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="jumbotron">

		<h2>User Settings</h2><br><br>

		<form class="form-horizontal" method=post action="userSettings.php" enctype="multipart/form-data">
			<fieldset>
				<div class="form-group">
					<label class="col-md-4 control-label">Username:</label>
					<div class="col-md-4">
						<input id="username" name="name" type="text" class="form-control input-md" required="" value="<?php echo $resultArray['name'];?>"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-4 control-label">Password:</label>
					<div class="col-md-4">
						<input id="password" name="password" type="password" class="form-control input-md" required="" value="<?php echo $resultArray['password'];?>"/> </br>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Upload a profile picture (must be .jpg):</label>
					<div class="col-md-4">
						<input id="picture" name="picture" type="file" class="form-control input-md"/> </br>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Bio:</label>
					<div class="col-md-4">
						<input id="bio" name="bio" type="textarea" class="form-control input-md"/ value="<?php echo $resultArray['settings'];?>"> </br>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-4 control-label" for="button"></label>
					<div class="col-md-4 center-block">
						<button type="submit" name="submit" class="btn btn-primary center-block">Update Profile</button>
					</div>
				</div>
			</fieldset>
		</form>

		<form class="form-horizontal" method=post action="profile.php">
			<div class="form-group">
				<label class="col-md-4 control-label" for="button"></label>
				<div class="col-md-4 center-block">
					<button type="submit" name="return" class="btn btn-primary center-block">Return</button>
				</div>
			</div>
		</form>

		<?php echo "<strong>".$complete."</strong>";?>

		</div>
	</body>
</html>

