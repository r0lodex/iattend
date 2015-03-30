<?php

include('database.php');

function studentCreate($input){
	// process inpput data
	$a = (isset($input['name'])) ? $input['name']:null;
	$b = (isset($input['icno'])) ? $input['icno']:null;
	$c = (isset($input['matrix'])) ? $input['matrix']:null;
	$d = (isset($input['serial'])) ? $input['serial']:null;

	// create an array of data
	$data = array(
		'a' => $input['name'],
		'b' => $input['icno'],
		'c' => $input['matrix'],
		'd' => $input['serial']
	);

	// prepare database query
	$sql = "INSERT INTO student (fullname,ic,matrix_no,serial_no) vALUES (:a,:b,:c,:d)";
	$dbc = Database::connect();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$dbc = null;

	return array();
}

function studentRead($input){
	// process input data
	$a = (isset($input['id'])) ? $input['id']:null;

	// create an array of data
	$data = array(
		'a' => $a
	);

	// prepare database query
	$sql = ($a == null || $a == 0) ? "SELECT * FROM student" : "SELECT * FROM student WHERE id=:a";
	$dbc = Database::connect();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$rows = $qry->fetchAll(PDO::FETCH_ASSOC);
	$dbc = null;

	return array($rows);
}

function studentUpdate($input){
	// process input data
	$a = (isset($input['name'])) ? $input['name']:null;
	$b = (isset($input['icno'])) ? $input['icno']:null;
	$c = (isset($input['matrix'])) ? $input['matrix']:null;
	$d = (isset($input['serial'])) ? $input['serial']:null;
	$e = (isset($input['id'])) ? $input['id']:null;

	// this will cause error. bail out.
	if($e == null) {
		return array('error'=>'Invalid request!');
	}

	// create an array of data
	$data = array(
		'a' => $a,
		'b' => $b,
		'c' => $c,
		'd' => $d,
		'e' => $e,
	);

	// prepare database query
	$sql = "UPDATE student SET fullname=IFNULL(:a,fullname), ic=IFNULL(:b,ic), matrix_no=IFNULL(:c,matrix_no), serial_no=IFNULL(:d,serial_no) WHERE id=:e";
	$dbc = Database::connect();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);

	/*$sql = "SELECT * FROM student WHERE id=:e";
	$qry = $dbc->prepare($sql);
	$qry->execute(array('e'=>$e));
	$row = $qry->fetch(PDO::FETCH_ASSOC);
	$dbc = null;*/

	return array();
}

function studentDelete($input){
	// crete an array of data from input
	$data = array(':a' => $input['id']);

	// prepare database query
	$sql = "DELETE FROM student WHERE id=:a";
	$dbc = Database::connect();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$dbc = null;

	return array();
}

