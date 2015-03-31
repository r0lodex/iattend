<!DOCTYPE html>
<html>
<head>
	<title>i-Attend Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../static/vendor/bootstrap-datepicker.standalone.css">
	<link rel="stylesheet" type="text/css" href="../static/vendor/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../static/css/iattend.css">
	<link rel="stylesheet" type="text/css" href="../static/css/iattend_print.css" media="print">
</head>
<body>
	<div class="container">
		<?php include '../php/database.php'; include '../php/attendance.php'; attendanceList($_GET); ?>
	</div>
</body>
</html>