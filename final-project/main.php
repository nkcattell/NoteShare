<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NoteShare Main Page</title>
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
                    <li><a href="#">Profile</a></li>
                    <li><a href="upload.php">Upload</a></li>
					<li><a href="login.php">Login</a></li>
                    <li><a href="createUser.php">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="jumbotron table-responsive">
        <div class="container">
            <h1>Songs</h1>
				
			<?php
				/* Connecting to the database */
				$con = new mysqli('localhost', 'root', '', 'notesharedb');
				if ($con->connect_error) {
					die($con->connect_error);
				}
				
				$sqlget = "select * from songs";
				$sqldata = mysqli_query($con, $sqlget);
				
			?>
			
			<table class="table table-bordered table-responsive table-hover">
				<tr>
					<th>Name</th>
					<th>Artist</th>
					<th>Label</th>
					<th>Tags</th>
					<th>Likes</th>
				</tr>
				
				<?php 
					while($song = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
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
	
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
