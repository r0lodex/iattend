<?php
//start session is not exists
if(!isset($_SESSION)) {	session_start(); }

//process student req
if( isset($_GET['student']) || isset($_POST['student']) ) {
	include 'student.php';
	switch($_GET['action']){
		case 'create':
			$response = studentCreate($_POST);
		break;

		case 'read':
			$response = studentRead($_GET);
		break;

		case 'update':
			$response = studentUpdate($_POST);
		break;

		case 'delete':
			$response = studentDelete($_POST);
		break;
	}
}

//process event req
if( isset($_GET['event']) || isset($_POST['event']) ) {
	include 'event.php';
	switch($_GET['action']){
		case 'create':
		break;

		case 'read':
		break;

		case 'update':
		break;

		case 'delete':
		break;
	}
}

//process attendance req
if( isset($_GET['attendance']) || isset($_POST['attendance']) ) {
	include 'attendance.php';
	switch($_GET['action']){
		case 'create':
			$response = attendanceCreate($_GET);
		break;

		case 'read':
		break;

		case 'update':
		break;

		case 'delete':
		break;
	}
}


//system access check
if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	if($username == 'admin' && $password == 'admin'){
		$_SESSION['authorized'] = true;
	}
}
if(isset($_GET['logout'])) {
	unset($_SESSION);
	session_destroy();
}

// check authorization
if(!isset($_SESSION['authorized'])){
	$response = array('auth'=>false);
}else{
	$response = array('auth'=>true);
}


//return json array
echo json_encode($response);
exit;