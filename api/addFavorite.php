<?php
session_start();
require('./connect.php');
$userId=$_SESSION['user_id'];

$targetName=$_POST['target'];
$sth = $dbh->query("SELECT obj_Id FROM `object` WHERE obj_Name='$targetName'", PDO::FETCH_ASSOC);
$rows = $sth->fetchAll();
foreach ($rows as $value) {
	$target=$value['obj_Id'];
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