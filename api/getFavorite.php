<?php
require_once('./connect.php');
session_start();
$Names=[];
$userId=$_SESSION['user_id'];
$sth = $dbh->query("SELECT f_target FROM `favorite` WHERE f_user='$userId'", PDO::FETCH_ASSOC);
$rows = $sth->fetchAll();
foreach ($rows as $value) {
	$sth = $dbh->query("SELECT obj_NAME FROM `object` WHERE obj_Id='$value[f_target]'", PDO::FETCH_ASSOC);
	$rows_target_name = $sth->fetchAll();
	foreach ($rows_target_name as $Name) {
		$Names[]=$Name[obj_NAME];
	}
}
$Names=json_encode($Names);
echo "$Names";
 ?>