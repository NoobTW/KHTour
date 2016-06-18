<?php
session_start();
require('./api/connect.php');
$userId=$_SESSION['user_id'];
$sth = $dbh->query("SELECT f_target FROM `favorite` WHERE f_id='$user_id'", PDO::FETCH_ASSOC);
$rows = $sth->fetchAll();
foreach ($rows as $value) {
	echo $value['f_target'];
}
 ?>