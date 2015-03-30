<?php
//start session is not exists
if(!isset($_SESSION)) {	session_start(); }

// database connection function
include('database.php');

// init response array
$response = array();

//process student req
if( isset($_GET['student']) )
	include 'student.php';
	$response = studentRead($_GET);
}
if( isset($_POST['student']) ) {
	include 'student.php';
	if(isset($_POST['id'])) {
		$response = studentUpdate($_POST);
		if(isset($_POST['delete'])) {
			$response = studentDelete($_POST);
		}
	}else{
		$response = studentCreate($_POST);
	}
}

//process event req
if( isset($_GET['event']) )
	include 'event.php';
	$response = eventRead($_GET);
}
if( isset($_POST['event']) ) {
	include 'event.php';
	if(isset($_POST['id'])) {
		$response = eventUpdate($_POST);
		if(isset($_POST['delete'])) {
			$response = eventDelete($_POST);
		}
	}else{
		$response = studentCreate($_POST);
	}
}

//process attendance req
if( isset($_GET['attendance']) )
	include 'attendance.php';
	$response = attendanceRead($_GET);
}
if( isset($_POST['attendance']) ) {
	include 'attendance.php';
	if(isset($_POST['id'])) {
		$response = attendanceUpdate($_POST);
		if(isset($_POST['delete'])) {
			$response = attendanceDelete($_POST);
		}
	}else{
		$response = attendanceCreate($_POST);
	}
}


//system access check
if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	if($username == 'admin' && $password == 'admin'){
		$_SESSION['authorized'] = true;
		header('Location: ../app');
	}
}
if(isset($_GET['logout'])) {
	unset($_SESSION);
	session_destroy();
	header('Location: ../');
}

//return json array
echo json_encode($response);
exit;