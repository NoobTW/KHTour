<?php
require('connect.php');
header('Content-Type: application/json; charset=utf-8');

@$type = trim($_GET['type']);
$result = array();

if($type=='res'){
	$sth = $dbh->query("SELECT obj_Name FROM `object` WHERE obj_Type=1", PDO::FETCH_ASSOC);
	$rows = $sth->fetchAll();	
	foreach($rows as $row){
		array_push($result, $row['obj_Name']);
	}
}else if($type=='att'){
	$sth = $dbh->query("SELECT obj_Name FROM `object` WHERE obj_Type=0", PDO::FETCH_ASSOC);
	$rows = $sth->fetchAll();	
	foreach($rows as $row){
		array_push($result, $row['obj_Name']);
	}
}else{
	$sth = $dbh->query("SELECT obj_Name FROM `object` WHERE obj_Type=1", PDO::FETCH_ASSOC);
	$rows = $sth->fetchAll();	
	foreach($rows as $row){
		array_push($result, $row['obj_Name']);
	}
	$sth = $dbh->query("SELECT obj_Name FROM `object` WHERE obj_Type=0", PDO::FETCH_ASSOC);
	$rows = $sth->fetchAll();	
	foreach($rows as $row){
		array_push($result, $row['obj_Name']);
	}
}
echo json_encode($result);
?>