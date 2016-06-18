<?php
require_once('./connect.php');
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