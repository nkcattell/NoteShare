<!doctype html>

<?php
	require_once "userAuth.php";
	session_start();

	$db_connection = new mysqli($host, $user, $password, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	}

	$username = $_SESSION["user"];
	$query = "select name, settings, userid from users where name = '$username'";
	$result = mysqli_query($db_connection, $query);

	if ($result) {	
		$resultArray = mysqli_fetch_assoc($result);
		$name = $resultArray['name'];
		$bio = $resultArray['settings'];
		$userid = $resultArray['userid'];
	}

	$query = "select * from songs where userid = '$userid'";
	$songs = mysqli_query($db_connection, $query);

	mysqli_close($db_connection);
?>

<html>

	<head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>NoteShare Profile Page</title>
    	<link href="resources/css/bootstrap.min.css" rel="stylesheet">
    	<link rel="stylesheet" type="text/css" href="resources/style.css" />
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
	    	<?php
				echo "<img src=\"retrieveProfilePicture.php?\" width=\"250\" height=\"250\" alt=\"image\" onerror=\"this.src='default.jpg';\" style=\"border:3px solid black\"/>";
			?>
			<h3><?php echo $name;?></h3>
			<p><?php echo $bio;?></p>
			<br>
			<form class="form-horizontal" method=post action="userSettings.php">
			<div class="form-group">
				<label class="col-md-4 control-label" for="button"></label>
				<div class="col-md-4 center-block">
					<a href="userSettings.php" name="update" class="btn btn-primary center-block">Update Profile</a>
				</div>
			</div>
			<form class="form-horizontal" method=post action="upload.php">
			<div class="form-group">
				<label class="col-md-4 control-label" for="button"></label>
				<div class="col-md-4 center-block">
					<a href="upload.php" name="upload" class="btn btn-primary center-block">Upload Song</a>
				</div>
			</div>
			</form>

	    </div>

	    <div class="jumbotron table-responsive">
        <div class="container">
            <h4><?php echo $name;?>'s Uploaded Songs</h4>
			<br>
			<table class="table table-bordered table-responsive table-hover">
				<tr>
					<th>Name</th>
					<th>Artist</th>
					<th>Label</th>
					<th>Tags</th>
					<th>Likes</th>
				</tr>
				
				<?php 
					while($song = mysqli_fetch_array($songs, MYSQLI_ASSOC)) {
						echo '<input type="hidden" method="POST" name="songId" value="$song[\'songid\']">';
						echo '<tr onclick="window.document.location=\'song.php\';"><td>';
						echo $song['name'];
						echo "</td><td>";
						echo $song['artist'];
						echo "</td><td>";
						echo $song['label'];
						echo "</td><td>";
						echo $song['tags'];
						echo "</td><td>";
						echo $song['likes'];
						echo "</td></tr>";
					}
				?>
			</table>
        </div>
    	</div>


	</body>
</html>

