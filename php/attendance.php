<?php

function attendanceRead($input) {

}

function attendanceCreate($input) {
	// process input data
	$a = (isset($input['serial'])) ? $input['serial']:null;
	$b = (isset($input['event'])) ? $input['event']:null;

	// bail possible error condition
	if($a == null || $b == null) {
		return array('error'=>'Scanning error!');
	}

	// create an array of data
	$data = array(
		'a' => $a,
		'b' => $b
	);

	$sql = "INSERT INTO attendance SELECT null, id, :b, NOW() FROM student WHERE serial_no=:a
		AND NOT EXISTS (SELECT * FROM attendance att join student std on std.id=att.student_id WHERE std.serial_no=:a AND att.event_id=:b)";
	$dbc = Database::connect();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$dbc = null;

	return array();
}