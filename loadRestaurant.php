<?php
define('DB_NAME','khtour');
define('DB_USER','root');
define('DB_PASSWD','123456');
define('DB_HOST','localhost');
define('DB_TYPE','mysql');
date_default_timezone_set("Asia/Taipei");
$dbh = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWD);
$sth = $dbh->query("SELECT * FROM `restaurant`", PDO::FETCH_ASSOC);
// $data = file_get_contents($url); // 取得json字串
// $data = json_decode($data, true); // 將js串轉成陣列
$rows = $sth->fetchAll();
$rows=json_encode($rows);
echo "$rows";
 ?>