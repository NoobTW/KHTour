<?php
session_start();
require('./connect.php');
$userId='1136582603031323';
$targetName=$_POST['target'];
$sth = $dbh->query("SELECT obj_Id FROM `object` WHERE obj_Name='$targetName'", PDO::FETCH_ASSOC);
$rows = $sth->fetchAll();
foreach ($rows as $value) {
	$target=$value['obj_Id'];
}
echo $target;
$sth = $dbh->prepare("DELETE FROM `favorite` WHERE f_user=:user AND f_target=:target");
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