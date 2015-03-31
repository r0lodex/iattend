<?php
	// Access Control
	if(!isset($_SESSION)) { session_start(); }
	if( isset($_SESSION['authorized']) ) { header('Location: app'); }
?>
<!DOCTYPE html>
<html>
<head>
	<title>i-Attend System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="static/vendor/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="static/css/iattend.css">
</head>
<body>
	<div class="container">
		<hr>
		<div class="row">
			<div class="col-md-8">
				<h1 style="margin-top:0">Hello, World!</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis eius veritatis, explicabo magnam itaque at ab nostrum distinctio impedit dolorum dolore ratione repellendus, architecto vitae. Veritatis omnis a sapiente voluptates.</p>
			</div>
			<div class="col-md-4">
			<!-- BEGIN LOGIN FORM -->
				<h4>i-Attend Login</h4>
				<p class="text-danger hidden">Invalid username/password</p>
				<form name="login" action="php/router.php" method="POST">
					<input type="hidden" value="1" name="login"/>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
							<input type="text" name="username" class="form-control" placeholder="Username">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
							<input type="password" name="password" class="form-control" placeholder="Password">
						</div>
					</div>
					<input type="submit" class="btn btn-default btn-sm" value="LOGIN">
				</form>
			<!-- END LOGIN FORM -->
			</div>
		</div>

		<hr>
		<h3 class="text-center">Upcoming Events</h3>
		<hr>

		<div class="row">
			<!-- BEGIN PUBLIC EVENT LISTING -->
				<?php include('php/database.php'); include('php/event.php'); eventList(); ?>
			<!-- END PUBLIC EVENT LISTING -->
		</div>
	</div>

	<script src="static/vendor/jquery.min.js"></script>
	<script src="static/vendor/bootstrap.js"></script>
</body>
</html>