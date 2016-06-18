<?php
require('../connect.php');
$term=$_GET['term'];

$sth = $dbh->query("SELECT att_Name FROM `attraction` WHERE `att_Name` LIKE '%".$term."%'", PDO::FETCH_ASSOC);
$rows = $sth->fetchAll();
$rows = removePrefix($rows);

$arr=Array();
foreach ($rows as $value) {
	$arr[]=$value["Name"]; //放入陣列
 } //end of for

$sth = $dbh->query("SELECT res_Name FROM `restaurant` WHERE `res_Name` LIKE '%".$term."%'", PDO::FETCH_ASSOC);
$rows = $sth->fetchAll();
$rows = removePrefix($rows);

foreach ($rows as $value) {
	$arr[]=$value["Name"]; //放入陣列
 } //end of for
echo json_encode($arr);

function removePrefix(array $input) {

    $return = array();
    foreach ($input as $key => $value) {
        if (strpos($key, 'att_') === 0)
            $key = substr($key, 4);

        if (strpos($key, 'res_') === 0)
            $key = substr($key, 4);

        if (is_array($value))
            $value = removePrefix($value);

        $return[$key] = $value;
    }
    return $return;
}
 ?>