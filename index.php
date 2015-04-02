<?php
	// Access Control
	if(!isset($_SESSION)) { session_start(); }
	if( isset($_SESSION['authorized']) ) { header('Location: app'); }
	if(!isset($_SESSION['attr'])) {$_SESSION['attr'] = 'hidden';}
?>
<!DOCTYPE html>
<html>
<head>
	<title>i-Attend System</title>
	<?php include 'static/includes/header.template'; ?>
</head>
<body>
	<div class="container">

		<?php $active = 'home'; include 'static/includes/navbar.template'; ?>

		<div class="jumbotron">
			<div class="row">
				<div class="col-md-8">
					<h1 style="margin-top:0">The Fastest Attendance System</h1>
					<p><strong class="text-info"><i><span class="text-danger">i</span>-Attend</i></strong>, an Event Attendance system by PMJ Students.</p>
					<a href="about.php" class="btn btn-primary">Get To Know The Team &rarr;</a>
				</div>
				<div class="col-md-4" style="background: #FFF; padding: 20px; border-radius:5px; box-shadow: 0 1px 2px rgba(0,0,0,.2);">
				<!-- BEGIN LOGIN FORM -->
					<h4>i-Attend Login</h4>
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
							<br><small class="text-danger" <?php echo $_SESSION['attr']; ?> >Invalid username/password. Please try again. <?php unset($_SESSION); session_destroy(); ?></small>
						</div>
						<input type="submit" class="btn btn-default btn-sm" value="LOGIN &raquo;">
					</form>
				<!-- END LOGIN FORM -->
				</div>
			</div>
		</div>
		<p class="lead text-center text-muted">
			The system has been designed by humble PMJ Students which are still learning how to HTML, Javascript, and PHP, and probably some MySQL as well. Probably in 2-3 years of coding will they understand the power of <strong>Web Development.</strong>
		</p>
		<hr>
		<h3 class="text-center"><span class="glyphicon glyphicon-star text-muted small"></span> UPCOMING EVENTS <span class="glyphicon glyphicon-star text-muted small"></span></h3>
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