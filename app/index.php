<?php
	// Access Control
	if(!isset($_SESSION)) { session_start(); }
	if( !isset($_SESSION['authorized']) || ($_SESSION['authorized'] == false) ) { header('Location: ../'); }
?>

<!DOCTYPE html>
<html ng-app="iattend">
<head>
	<title>i-Attend Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../static/vendor/bootstrap-datepicker.standalone.css">
	<link rel="stylesheet" type="text/css" href="../static/vendor/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../static/css/iattend.css">
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default" style="margin-top: 10px;" ng-controller="linkCtrl">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" id="branding"><img src="../static/img/logobnw.svg" /></a>
				</div>
				<div class="collapse navbar-collapse" id="nav">
					<ul class="nav navbar-nav">
						<li ng-class="{active:isActive('/events')}"><a href="#/events"><span class="glyphicon glyphicon-calendar"></span> Events</a></li>
						<li ng-class="{active:isActive('/students')}"><a href="#/students"><span class="glyphicon glyphicon-user"></span> Student</a></li>
						<?php if(isset($_SESSION['superuser'])) { ?>
						<li ng-class="{active:isActive('/admin')}"><a href="#/admin"><span class="glyphicon glyphicon-eye-open"></span> Administrators</a></li>
						<?php } ?>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="../php/router.php?logout=1">Logout <span class="glyphicon glyphicon-log-out"></span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container-fluid views" ng-view></div>
	</div>

	<!-- Javascript Dependencies -->
	<script src="../static/vendor/jquery.min.js"></script>
	<script src="../static/vendor/bootstrap.js"></script>
	<script src="../static/vendor/angular.min.js"></script>
	<script src="../static/vendor/angular-route.js"></script>
	<script src="../static/vendor/angularModalService.js"></script>
	<script src="../static/vendor/bootstrap-datepicker.js"></script>
	<script src="../static/js/app.js"></script>
	<?php if(isset($_SESSION['superuser'])) { ?>
	<script src="../static/js/superuser.js"></script>
	<?php } ?>
</body>
</html>