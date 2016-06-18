<?php
require('connect.php');
header('Content-Type: application/json; charset=utf-8');
$sth = $dbh->query("SELECT res_name FROM `restaurant`", PDO::FETCH_ASSOC);
$rows = $sth->fetchAll();
$rows=json_encode($rows);
echo "$rows";
?>