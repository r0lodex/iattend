<?php
function eventCreate($input){
	// crete an array of data from input
	$data = array(
		'a' => $input['name'],
		'b' => $input['descp'],
		'c' => $input['venue'],
		'd' => $input['day'],
		'e' => $input['time']
	);

	// prepare database query
	$sql = "INSERT INTO event (name,descp,venue,day,time) vALUES (:a,:b,:c,:d,:e)";
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$dbc = null;
}

function eventRead($input){
	$sql = "SELECT * FROM event";
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute();
	$rows = $qry->fetchAll(PDO::FETCH_ASSOC);
	$dbc = null;
	return $rows;
}

function eventDelete($input){
	// crete an array of data from input
	$data = array(':a' => $input['id']);

	// prepare database query
	$sql = "DELETE FROM event WHERE id=:a";
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$dbc = null;
}

function eventUpdate($input){
	// crete an array of data from input
	$data = array(
		'a' => $input['name'],
		'b' => $input['descp'],
		'c' => $input['venue'],
		'd' => $input['day'],
		'e' => $input['time'],
		'f' => $input['id']
	);

	// prepare database query
	$sql = "UPDATE event SET name=IFNOT(:a,name), descp=IFNOT(:b,name), vanue=IFNOT(:c,name), day=IFNOT(:d,day), time=IFNOT(:e,time) WHERE id=:f";
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$dbc = null;
}

function eventList(){
	$buff = '';
	$res = eventRead(null);
	foreach($res as $row){
		$buff.="<tr>
		<td><p><strong>".$row['name']."</strong><br><small class=\"text-muted\">".$row['descp']."</small></p></td>
		<td><code class=\"bg-success text-info\">".date('d M Y',strtotime($row['day']))."</code></td>
		<td><code class=\"bg-info text-success\">".date('g:ia',strtotime($row['time']))."</code></td>
		<td>".$row['venue']."</td></tr>";
	}
	echo $buff;
}
