<?php
define('DB_NAME','khtour');
define('DB_USER','root');
define('DB_PASSWD','khtour');
define('DB_HOST','localhost');
define('DB_TYPE','mysql');
date_default_timezone_set("Asia/Taipei");
header('Content-Type: application/json; charset=utf-8');
$dbh = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWD);
$sth = $dbh->query("SELECT * FROM `restaurant`", PDO::FETCH_ASSOC);
$rows = $sth->fetchAll();
$rows = removePrefix($rows);
$rows=json_encode($rows);
echo "$rows";

function removePrefix(array $input) {

    $return = array();
    foreach ($input as $key => $value) {
        if (strpos($key, 'res_') === 0)
            $key = substr($key, 4);

        if (is_array($value))
            $value = removePrefix($value); 

        $return[$key] = $value;
    }
    return $return;
}
 ?>