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
	$sql = "SELECT std.fullname,std.matrix_no,std.course,DATE_FORMAT(CONVERT_TZ(att.time_reg,'+00:00','+08:00'),'%d %b %Y @ %T') as time_reg,att.id,evn.name FROM attendance att join student std ON std.id=att.student_id join event evn on evn.id=:a WHERE att.event_id=:a";
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$rows = $qry->fetchAll(PDO::FETCH_ASSOC);
	$dbc = null;
	if(isset($input['ret'])){
		return $rows;
	}
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

function attendanceList($input) {
	$input['ret'] = true;
	$res = attendanceRead($input);

	$i = 1;
	$total = sizeof($res);
	$buff = "<div class=\"page-header\">
		<h1><small class=\"small text-muted\">Report</small><br>".$input['title']." <a href=\"#print\" onclick=\"window.print()\" class=\"btn btn-default btn-xs\"><span class=\"glyphicon glyphicon-print\"></span> Print</a></h1>
		</div><div><p>Total Attendees: ".$total."</p><table class=\"table\"><thead><tr><th>#</th><th>Student's Name</th><th>Matrix No</th><th>Course</th><th>Time In</th></tr></thead><tbody>";
	foreach($res as $row){
		$buff.="<tr><td>".$i."</td><td>".$row['fullname']."</td><td>".$row['matrix_no']."</td><td>".$row['course']."</td><td>".$row['time_reg']."</td></tr>";
		$i++;
	}
	$buff.= "</tbody></table></div>";
	echo $buff;
}