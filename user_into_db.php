<?php
define('DB_NAME','khtour');
define('DB_USER','root');
define('DB_PASSWD','123456');
define('DB_HOST','localhost');
define('DB_TYPE','mysql');
date_default_timezone_set("Asia/Taipei");
$dbh = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWD);
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