<?php
	if(!isset($_SESSION)) {
		session_start(); 
	}
	if( !isset($_SESSION['authorized']) || ($_SESSION['authorized'] == false) ) {
		header('Location: ../');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>App Dashboard</title>
</head>
<body>

</body>
</html>