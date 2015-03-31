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
	// adjustment
	$data['e'] = date('1970-01-01 H:i:s',strtotime($data['e'])-28800);

	// prepare database query
	$sql = "INSERT INTO event (name,descp,venue,day,time) vALUES (:a,:b,:c,:d,:e)";
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$dbc = null;
}

function eventRead($input){
	$sql = "SELECT id,`name`,descp,venue,day,TIME(CONVERT_TZ(`time`,'+00:00','+08:00')) AS time FROM event";
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute();
	$rows = $qry->fetchAll(PDO::FETCH_ASSOC);
	$dbc = null;
	if($input == 'ret'){
		return $rows;
	}
	echo json_encode($rows);
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
	// adjustment
	$data['e'] = date('1970-01-01 H:i:s',strtotime($data['e'])-28800);

	// prepare database query
	$sql = "UPDATE event SET name=IFNULL(:a,name), descp=IFNULL(:b,name), venue=IFNULL(:c,name), day=IFNULL(:d,day), time=IFNULL(:e,time) WHERE id=:f";
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$dbc = null;
}

function eventList(){
	$buff = '';
	$res = eventRead('ret');
	foreach($res as $row){
		$buff.='<div class="col-md-4">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h4><strong class="text-capitalize">'.$row["name"].'</strong><br>
							<small class="small text-muted">'.$row["descp"].'</small>
							</h4>
						</div>
						<div class="panel-body">
							<p class="small">
								<strong>Venue</strong> &raquo; '.$row["venue"].'<br>
								<strong>Date &amp; Time</strong> &raquo; '.$row["day"].' @ '.$row["time"].'<br>
							</p>
						</div>
					</div>
				</div>';
	}
	echo $buff;
}
