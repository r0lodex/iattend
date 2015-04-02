<?php
//start session is not exists
if(!isset($_SESSION)) {	session_start(); }

// database connection function
include('database.php');


$json = file_get_contents("php://input");
$post = json_decode($json,true);

//process student req
if( isset($_GET['student']) ){
	include 'student.php';
	studentRead($_GET);
}
if( isset($post['student']) ) {
	include 'student.php';
	if(isset($post['id'])) {
		if(isset($post['delete'])) {
			studentDelete($post);
		}else{
			studentUpdate($post);
		}
	}else{
		studentCreate($post);
	}
}

//process event req
if( isset($_GET['event']) ){
	include 'event.php';
	eventRead($_GET);
}
if( isset($post['event']) ) {
	include 'event.php';
	if(isset($post['id'])) {
		if(isset($post['delete'])) {
			eventDelete($post);
		}else{
			eventUpdate($post);
		}
	}else{
		eventCreate($post);
	}
}

//process attendance req
if( isset($_GET['attendance']) ){
	include 'attendance.php';
	attendanceRead($_GET);
}
if( isset($post['attendance']) ) {
	include 'attendance.php';
	if(isset($post['id'])) {
		if(isset($post['delete'])) {
			attendanceDelete($post);
		}
	}else{
		attendanceCreate($post);
	}
}

//process admin req
if( isset($_GET['admin']) ){
	include 'admin.php';
	adminRead($_GET);
}
if( isset($post['admin']) ) {
	include 'admin.php';
	if(isset($post['id'])) {
		if(isset($post['delete'])) {
			adminDelete($post);
		}else{
			adminUpdate($post);
		}
	}else{
		adminCreate($post);
	}
}

//system access check
if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	if($username == 'admin'){
		if($username == 'admin' && $password == 'admin'){
			$_SESSION['authorized'] = true;
			$_SESSION['superuser'] = true;
			header('Location: ../app');
		}else{
			header('Location: ../');
		}
	}else{
		$sql = "SELECT * FROM user WHERE username=:a && password=:b";
		$data = array('a'=>$username,'b'=>$password);
		$dbc = Database();
		$qry = $dbc->prepare($sql);
		$qry->execute($data);
		$row = $qry->fetch(PDO::FETCH_ASSOC);
		$dbc = null;

		if($row){
			$_SESSION['authorized'] = true;
			header('Location: ../app');
		}else{
			header('Location: ../');
		}
	}
}
if(isset($_GET['logout'])) {
	unset($_SESSION);
	session_destroy();
	header('Location: ../');
}

exit;