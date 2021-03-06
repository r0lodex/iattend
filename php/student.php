<?php
function studentCreate($input){
	// process inpput data
	$a = (isset($input['fullname'])) ? $input['fullname']:null;
	$b = (isset($input['ic'])) ? $input['ic']:null;
	$c = (isset($input['matrix_no'])) ? $input['matrix_no']:null;
	$d = (isset($input['serial_no'])) ? $input['serial_no']:null;
	$e = (isset($input['course'])) ? $input['course']:null;

	// create an array of data
	$data = array(
		'a' => $a,
		'b' => $b,
		'c' => $c,
		'd' => $d,
		'e' => $e
	);

	// prepare database query
	$sql = "INSERT INTO student (fullname,ic,matrix_no,serial_no,course) VALUES (:a,:b,:c,:d,:e)";
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$dbc = null;
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
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$rows = $qry->fetchAll(PDO::FETCH_ASSOC);
	$dbc = null;

	echo json_encode($rows);
}

function studentUpdate($input){
	// process input data
	$a = (isset($input['fullname'])) ? $input['fullname']:null;
	$b = (isset($input['ic'])) ? $input['ic']:null;
	$c = (isset($input['matrix_no'])) ? $input['matrix_no']:null;
	$d = (isset($input['serial_no'])) ? $input['serial_no']:null;
	$e = (isset($input['course'])) ? $input['course']:null;
	$f = (isset($input['id'])) ? $input['id']:null;

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
		'f' => $f
	);

	// prepare database query
	$sql = "UPDATE student SET fullname=IFNULL(:a,fullname), ic=IFNULL(:b,ic), matrix_no=IFNULL(:c,matrix_no), serial_no=IFNULL(:d,serial_no), course=IFNULL(:e,course) WHERE id=:f";
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
}

function studentDelete($input){
	// crete an array of data from input
	$data = array(':a' => $input['id']);

	// prepare database query
	$sql = "DELETE FROM student WHERE id=:a";
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$dbc = null;
}