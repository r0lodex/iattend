<?php
//start session is not exists
if(!isset($_SESSION)) {	session_start(); }

// database connection function
include('database.php');


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
			$response = eventCreate($_POST);
		break;

		case 'read':
			$response = eventRead($_GET);
		break;

		case 'update':
			$response = eventUpdate($_POST);
		break;

		case 'delete':
			$response = eventDelete($_POST);
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
	header('Location: ../');
}

// check authorization
if(!isset($_SESSION['authorized'])){
	$response['auth'] = false;
}else{
	$response['auth'] = true;
	header('Location: ../app');
}


//return json array
echo json_encode($response);
exit;