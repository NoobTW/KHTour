<?php
define('DB_NAME','khtour');
define('DB_USER','root');
define('DB_PASSWD','khtour');
define('DB_HOST','localhost');
define('DB_TYPE','mysql');
date_default_timezone_set("Asia/Taipei");
$now=date('Y-m-d');
$dbh = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWD);
 ?>