<?php
require_once('./connect.php');
session_start();
$_SESSION['user_id'] = $_POST['id'];

$user_id=$_POST['id'];
$user_name=$_POST['name'];
$sth = $dbh->prepare("INSERT INTO user(`user_id`,`user_name`) VALUES(:id,:name)");
$sth->bindParam(':id',$user_id,PDO::PARAM_STR);
$sth->bindParam(':name',$user_name,PDO::PARAM_STR);
$sth->execute();
/*if ($sth->errorCode())
	{
		if ($sth->errorInfo()[0]!='') {
			print_r($sth->errorInfo());
		}
	}*/
?>