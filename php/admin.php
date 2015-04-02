<?php
function adminCreate($input){
	// process inpput data
	$a = (isset($input['username'])) ? $input['username']:null;
	$b = (isset($input['password'])) ? $input['password']:null;
	$c = (isset($input['fullname'])) ? $input['fullname']:null;
	$d = (isset($input['email'])) ? $input['email']:null;
	$e = (isset($input['phone'])) ? $input['phone']:null;

	// create an array of data
	$data = array(
		'a' => $a,
		'b' => $b,
		'c' => $c,
		'd' => $d,
		'e' => $e
	);

	// prepare database query
	$sql = "INSERT INTO user (username, password, fullname, email, phone) VALUES (:a,:b,:c,:d,:e)";
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$dbc = null;
}

function adminRead($input){
	// process input data
	$a = (isset($input['id'])) ? $input['id']:null;

	// create an array of data
	$data = array(
		'a' => $a
	);

	// prepare database query
	$sql = ($a == null || $a == 0) ? "SELECT * FROM user" : "SELECT * FROM user WHERE id=:a";
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$rows = $qry->fetchAll(PDO::FETCH_ASSOC);
	$dbc = null;

	echo json_encode($rows);
}

function adminUpdate($input){
	// process input data
	$a = (isset($input['username'])) ? $input['username']:null;
	$b = (isset($input['password'])) ? $input['password']:null;
	$c = (isset($input['fullname'])) ? $input['fullname']:null;
	$d = (isset($input['email'])) ? $input['email']:null;
	$e = (isset($input['phone'])) ? $input['phone']:null;
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
	$sql = "UPDATE user SET username=IFNULL(:a,username), password=IFNULL(:b,password), fullname=IFNULL(:c,fullname), email=IFNULL(:d,email), phone=IFNULL(:e,phone) WHERE id=:f";
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
}

function adminDelete($input){
	// crete an array of data from input
	$data = array(':a' => $input['id']);

	// prepare database query
	$sql = "DELETE FROM user WHERE id=:a";
	$dbc = Database();
	$qry = $dbc->prepare($sql);
	$qry->execute($data);
	$dbc = null;
}