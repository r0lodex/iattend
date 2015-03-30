<?php
//start session is not exists
if(!isset($_SESSION)) {	session_start(); }

// database connection function
include('database.php');

//process student req
if( isset($_GET['student']) ){
	include 'student.php';
	studentRead($_GET);
}
if( isset($_POST['student']) ) {
	include 'student.php';
	if(isset($_POST['id'])) {
		if(isset($_POST['delete'])) {
			studentDelete($_POST);
		}else{
			studentUpdate($_POST);
		}
	}else{
		studentCreate($_POST);
	}
}

//process event req
if( isset($_GET['event']) ){
	include 'event.php';
	eventRead($_GET);
}
if( isset($_POST['event']) ) {
	include 'event.php';
	if(isset($_POST['id'])) {
		if(isset($_POST['delete'])) {
			eventDelete($_POST);
		}else{
			eventUpdate($_POST);
		}
	}else{
		studentCreate($_POST);
	}
}

//process attendance req
if( isset($_GET['attendance']) ){
	include 'attendance.php';
	attendanceRead($_GET);
}
if( isset($_POST['attendance']) ) {
	include 'attendance.php';
	if(isset($_POST['id'])) {
		if(isset($_POST['delete'])) {
			attendanceDelete($_POST);
		}else{
			attendanceUpdate($_POST);
		}
	}else{
		attendanceCreate($_POST);
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

exit;