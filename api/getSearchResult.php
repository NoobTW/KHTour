<?php
require('connect.php');
header('Content-Type: application/json; charset=utf-8');
$sth = $dbh->query("SELECT res_name FROM `restaurant`", PDO::FETCH_ASSOC);
$rows = $sth->fetchAll();

$result = array();

foreach($rows as $row){
	array_push($result, $row['res_name']);
}

echo json_encode($result);
?>