<?php
session_start();
require('./api/connect.php');
$userId='1136582603031323';
$targetName=$_POST['target'];
$sth = $dbh->query("SELECT att_Id FROM `attraction` WHERE att_Name='$targetName'", PDO::FETCH_ASSOC);
$rows = $sth->fetchAll();
foreach ($rows as $value) {
	$target=$value['att_Id'];
}
if (empty($target)) {
	$sth = $dbh->query("SELECT res_Id FROM `restaurant` WHERE res_Name='$targetName'", PDO::FETCH_ASSOC);
	$rows = $sth->fetchAll();
	foreach ($rows as $value) {
		$target=$value['res_Id'];
	}
}
echo $target;
$sth = $dbh->prepare("INSERT INTO favorite(`f_user`,`f_target`) VALUES(:id,:target)");
$sth->bindParam(':id',$userId,PDO::PARAM_STR);
$sth->bindParam(':target',$target,PDO::PARAM_STR);
$sth->execute();
if ($sth->errorCode())
	{
		if ($sth->errorInfo()[0]!='') {
			print_r($sth->errorInfo());
		}
	}
 ?>