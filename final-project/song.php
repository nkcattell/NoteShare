<?php
	require_once "userAuth.php";
	session_start();
	$db_connection = new mysqli($host, $user, $password, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	}
	
	if (isset($_POST['url'])) {
		$url = $_POST['url'];
		$song_name = $_POST['title'];
		$artist = $_POST['artist'];
	} elseif (isset($_POST['songid'])) {
		$query = "select url from songs where songid = {$_POST['songId']}";
		$result = $db_connection->query($query);
		if (!$result) {
			die("Retrieval failed: ". $db_connection->error);
		} else {
			$num_rows = $result->num_rows;
			for ($row_index = 0; $row_index < $num_rows; $row_index++) {
				$result->data_seek($row_index);
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$url = $row['url'];
			}
		}
	}
	
	$query = "select * from users where name='{$_SESSION['user']}'";
	$result = $db_connection->query($query);
	if (!$result) {
		die("Retrieval failed: ". $db_connection->error);
	} else {
		$num_rows = $result->num_rows;
		for ($row_index = 0; $row_index < $num_rows; $row_index++) {
				$result->data_seek($row_index);
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$username = $row['name'];
				$userid = $row['userid'];
			}
	}
	/* Connecting to the database */		
	/* Get likes/dislikes */
	$query = "select likes, dislikes, name, views, artist, userid, songid from songs where url='{$url}'";
			
	/* Executing query */
	$result = $db_connection->query($query);
	if (!$result) {
		die("Retrieval failed: ". $db_connection->error);
	} else {
		/* Number of rows found */
		$num_rows = $result->num_rows;
		if ($num_rows === 0) {
			$query_max = "select max(songid) as max from songs";
			$result2 = $db_connection->query($query_max);
			if (!$result2) {
				die("Retrieval failed: ". $db_connection->error);
			}
			$assoc = $result2->fetch_assoc();
			$increment = $assoc['max'] + 1;
			$insert = "insert into songs (name, url, songid, artist, views, likes, dislikes) values ('$song_name', '$url', '$increment', '$artist', 0, 0, 0)";
			$insertion = $db_connection->query($insert);
			if (!$insertion) {
				die("Insertion failed: ". $db_connection->error);
			}
			 $likes = 0;
			 $dislikes = 0;
			 $views = 0;

		} else {
			for ($row_index = 0; $row_index < $num_rows; $row_index++) {
				$result->data_seek($row_index);
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$likes = $row['likes'];
				$dislikes = $row['dislikes'];
				$song_name = $row['name'];
				$songID = $row['songid'];
				$views = $row['views'];
				$artist = $row['artist'];
			}
		}
	}
	
	$query = "select * from users where name='{$_SESSION['user']}'";
	if (!$result) {
		die("Retrieval failed: ". $db_connection->error);
	} else {
		$num_rows = $result->num_rows;
		for ($row_index = 0; $row_index < $num_rows; $row_index++) {
				$result->data_seek($row_index);
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$username = $row['name'];
				$userid = $row['userid'];
			}
	}
	
	$views += 1;
	$comment_id = $views;
	$update_views = "update songs set views={$views} where url='{$url}'";
	$result = $db_connection->query($update_views);
	if (isset($_POST["submit"])) {
		if (isset($_POST["comment"])) {
			$user_comment = "<hr>
								<h5>{$_SESSION['user']}</h5><p>";
			$user_comment .= $_POST['comment'];
			$user_comment .= "</p>";
			/* Get comments */
			$query = "insert into comments values ('{$userid}', '{$username}', '{$url}', {$songID}, '{$comment_id}', '{$user_comment}', 0, 0)";
					
			/* Executing query */
			$result = $db_connection->query($query);
			if (!$result) {
				die("Insertion failed: " . $db_connection->error);
			}
		}
	}
	/* Get comments */
	$query = "select comment from comments where songurl='{$url}'";
	$comment = "";
	/* Executing query */
	$result = $db_connection->query($query);
	if (!$result) {
		die("Retrieval failed: ". $db_connection->error);
	} else {
		/* Number of rows found */
		$num_rows = $result->num_rows;
		if ($num_rows === 0) {
			
		} else {
			for ($row_index = 0; $row_index < $num_rows; $row_index++) {
				$result->data_seek($row_index);
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$comment .= $row['comment'];
			}
		}
	}
	/* Closing connection */
	$db_connection->close();
	function generatePage($likes, $dislikes, $comment, $url, $song_name, $views, $artist, $title="Song") {
		    $page = <<<EOPAGE
			<!doctype html>
			<html>
				<head>
					<meta charset="utf-8"/>
					<title>NoteShare</title>
					<link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet">
			        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
			        <link rel="stylesheet" href="resources/song_style.css" type="text/css">
			        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
			        <script src="resources/song.js"></script>
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
									<li><a href="#">Songs</a></li>
									<li><a href="#">Register</a></li>
								</ul>
							</div>
						</div>
					</nav>
					<div class="container">
						<!-- Youtube Link -->
						<!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/lEi_XBg2Fpk" frameborder="0" allowfullscreen></iframe> -->
						<div class="col-md-8 col-md-offset-2">
							<h2>{$song_name}</h2>
							<!-- Soundcloud Link -->
							<iframe id="videoPlayer" width="100%" height="400" scrolling="no" frameborder="no" src="{$url}"></iframe>
							<h3 class="inline">{$artist}</h3>
							<div class="pull-right">
								<a href="#" id="thumbsUp" onclick="return false;"><i class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i></a>
								<p class="inline" id="numLike">{$likes}</p>
								<a href="#" id="thumbsDown" onclick="return false;"><i class="fa fa-thumbs-down fa-2x" aria-hidden="true"></i></a>
								<p class="inline" id="numDislike">{$dislikes}</p>
							</div>
							<h4>$views Views</h4>
							<br>
							<br>
							<h4>Comments</h4>
							<form action="song.php" method=post>
								<div class="form-group">
								    <input type="text" class="form-control input-lg" name="comment" id="input-lg" placeholder="Add a comment.."/>
							    </div>
								
								<div class="pull-right">
										<input class="btn btn-default" type="reset" value="Cancel" id="cancelButton">
										<input type="hidden" name="url" value="{$url}">
										<input type="submit" name="submit" class="btn btn-primary" value="Comment" id="commentButton"/>
								</div>
							</form>
							<br>
							<br>
							<div id="commentSection">
								$comment
							</div>
						</div>
					</div>
				</body>
			</html>
EOPAGE;
	    	return $page;
		}
	echo generatePage($likes, $dislikes, $comment, $url, $song_name, $views, $artist);
?>
