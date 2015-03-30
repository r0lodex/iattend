<?php
function attendanceCreate($input) {
	// process input data
	$a = (isset($input['serial_no'])) ? $input['serial_no']:null;
	$b = (isset($input['eventid'])) ? $input['eventid']:null;

	// create an array of data
	$data = array(
		'a' => $a,
		'b' => $b
	);

	$sql = "INSERT INTO attendance SELECT null, id, :b, NOW() FROM student WHERE serial_no=:a
		AND NOT EXISTS (SELECT * FROM attendance att join student std on std.id=att.student_id WHERE std.serial_no=:a AND att.event_id=:b)";
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$dbc = null;
}

function attendanceRead($input) {
	// process input data
	$a = (isset($input['id'])) ? $input['id']:null;

	// create data array
	$data = array(
		'a' => $a
	);

	// prepare database query
	$sql = "SELECT std.fullname,std.matrix_no,att.time_reg,att.id,evn.name FROM attendance att join student std ON std.id=att.student_id join event evn on evn.id=:a WHERE att.event_id=:a";
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$rows = $qry->fetchAll(PDO::FETCH_ASSOC);
	$dbc = null;
	echo json_encode($rows);
}

function attendanceDelete($input) {
	// process input data
	$a = (isset($input['id'])) ? $input['id']:null;

	// create data array
	$data = array(
		'a' => $a
	);

	// prepare database query
	$sql = "DELETE FROM attendance WHERE id=:a";
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$dbc = null;
}
