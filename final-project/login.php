<!doctype html>


<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Noteshare Login Page</title>
		<link href="resources/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="resources/style.css"/>
	</head>
	
	<body>
		<nav class="navbar navbar-inverse navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="main.html"><strong><i id="logo">NoteShare</i></strong></a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Profile</a></li>
						<li><a href="#">Songs</a></li>
                    	<li><a href="createUser.php">Register</a></li>
					</ul>
				</div>
			</div>
		</nav>
		
		<div class="jumbotron">

		<h1>Welcome to Noteshare!</h1>
		
		<h4>Login if you're already a member, or click Create Account</h4>
		
		<form class="form-horizontal" method=post action="affirmLogin.php">
			<fieldset>
				<div class="form-group">
					<label class="col-md-4 control-label">Username:</label>
					<div class="col-md-4">
						<input id="username" name="Username" type="text" class="form-control input-md" required="">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-4 control-label">Password:</label>
					<div class="col-md-4">
						<input id="password" name="Password" type="password" class="form-control input-md" required=""> </br>
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
		

		</div>
		
		<form class="form-horizontal" method=post action="createUser.php">
			<div class="form-group">
				<label class="col-md-4 control-label" for="button"></label>
				<div class="col-md-4 center-block">
					<button type="submit" id="create" name="create" class="btn btn-primary center-block">Create Account</button>
				</div>
			</div>
		</form>
		
	</body>
</html
			