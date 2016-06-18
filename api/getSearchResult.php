<?php
require('connect.php');
header('Content-Type: application/json; charset=utf-8');

@$type = trim($_GET['type']);
$result = array();

if($type=='res'){
	$sth = $dbh->query("SELECT res_name FROM `restaurant`", PDO::FETCH_ASSOC);
	$rows = $sth->fetchAll();	
	foreach($rows as $row){
		array_push($result, $row['res_name']);
	}
}else if($type=='att'){
	$sth = $dbh->query("SELECT att_name FROM `attraction`", PDO::FETCH_ASSOC);
	$rows = $sth->fetchAll();	
	foreach($rows as $row){
		array_push($result, $row['att_name']);
	}
}else{
	$sth = $dbh->query("SELECT res_name FROM `restaurant`", PDO::FETCH_ASSOC);
	$rows = $sth->fetchAll();	
	foreach($rows as $row){
		array_push($result, $row['res_name']);
	}
	$sth = $dbh->query("SELECT att_name FROM `attraction`", PDO::FETCH_ASSOC);
	$rows = $sth->fetchAll();	
	foreach($rows as $row){
		array_push($result, $row['att_name']);
	}
}
echo json_encode($result);
?>