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
                <a class="navbar-brand"><strong><i id="logo">NoteShare</i></strong></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="main.html">Home</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Songs</a></li>
                    <li><a href="createUser.php">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="jumbotron">
        <div class="container">
            <h1>Songs</h1>
			<?php
				/* Connecting to the database */
				mysql_connect('localhost', 'root', '');
				
				mysql_select_db('notesharedb');
				
				$sql="select * from songs"
				
				$songTable = mysql_query($sql);
			?>
			
			<table border="1" cellpadding="1" cellspacing="1">
				<tr>
					<th>Name</th>
					<th>URL</th>
					<th>Artist</th>
					<th>Label</th>
					<th>Likes</th>
				</tr>
				
				<?php
					while($song = mysql_fetch_assoc($songTable)) {
						echo "<tr>";
						
						echo "<td>".song['name']."</td>";
						echo "<td>".song['url']."</td>";
						echo "<td>".song['artist']."</td>";
						echo "<td>".song['label']."</td>";
						echo "<td>".song['likes']."</td>";
						
						echo "</tr>";
					}
				?>
			</table>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>