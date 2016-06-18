<?php
require('connect.php');
// $data = file_get_contents($url); // ?��?json字串
// $data = json_decode($data, true); // 將js串�??�陣??
$rows = $sth->fetchAll();
$rows=json_encode($rows);
echo "$rows";
 ?>