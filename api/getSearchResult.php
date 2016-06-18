<?php
require('connect.php');
$sth = $dbh->query("SELECT res_name FROM `restaurant`", PDO::FETCH_ASSOC);
$rows = $sth->fetchAll();
$rows=json_encode($rows);
echo "$rows";

 ?>