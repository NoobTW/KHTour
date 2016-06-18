<?php
require('connect.php');
$user_id=$_POST['user_id'];
$user_name=$_POST['user_name'];
$sth = $dbh->prepare("INSERT INTO user(`user_id`,`user_name`) VALUES(:id,:name)");
$sth->bindParam(':id',$user_id,PDO::PARAM_STR);
$sth->bindParam(':name',$user_name,PDO::PARAM_STR);
$sth->execute();
if ($sth->errorCode())
	{
		if ($sth->errorInfo()[0]!='') {
			print_r($sth->errorInfo());
		}
	}

 ?>