<?php

include('database.php');

function eventCreate($input){
	// crete an array of data from input
	$data = array(
		'a' => $input['name'],
		'b' => $input['descp'],
		'c' => $input['vanue'],
		'd' => $input['day'],
		'e' => $input['time']
	);

	// prepare database query
	$sql = "INSERT INTO event (name,descp,vanue,day,time) vALUES (:a,:b,:c,:d,:e)";
	$dbc = Database::connect();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$dbc = null;

	return array();
}

function eventDelete($input){
	// crete an array of data from input
	$data = array(':a' => $input['id']);

	// prepare database query
	$sql = "DELETE FROM event WHERE id=:a";
	$dbc = Database::connect();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$dbc = null;

	return array();
}

function eventUpdate($input){
	// crete an array of data from input
	$data = array(
		'a' => $input['name'],
		'b' => $input['descp'],
		'c' => $input['vanue'],
		'd' => $input['day'],
		'e' => $input['time'],
		'f' => $input['id']
	);

	// prepare database query
	$sql = "UPDATE event SET name=COALESCE(name,:a), descp=COALESCE(descp,:b), vanue=COALESCE(vanue,:c), day=COALESCE(day,:d), time=COALESCE(time,:e) WHERE id=:f";
	$dbc = Database::connect();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$dbc = null;

	return array();
}