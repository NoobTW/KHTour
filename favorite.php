<?php
session_start();
require('./api/connect.php');
$userId=$_SESSION['user_id'];
$targetName=$_POST['userName'];
$sth = $dbh->prepare("INSERT INTO favorite(`f_user`,`f_target`) VALUES(:id,:target)");
$sth->bindParam(':id',$user_id,PDO::PARAM_STR);
$sth->bindParam(':target',$targetName,PDO::PARAM_STR);
$sth->execute();
 ?>