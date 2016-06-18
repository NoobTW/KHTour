<?php
require('./api/connect.php');
$sth = $dbh->query("SELECT * FROM `attraction` LIMIT 5", PDO::FETCH_ASSOC);
$rows = $sth->fetchAll();
$rows = removePrefix($rows);
// print_r($rows);
foreach ($rows as $value) {
    ?>
                <h3> <?php echo "$value[Name]";?> </h3>
        <div class="card">
            <div class="pic">
                <?php
                echo "<img src='$value[Picture1]' alt=''>";
                ?>
            </div>
            <div class="descrip">
                <div class="rate" id='star-rating'>
                    <input type="radio" name="example" class="rating" value="1" />
                    <input type="radio" name="example" class="rating" value="2" />
                    <input type="radio" name="example" class="rating" value="3" />
                    <input type="radio" name="example" class="rating" value="4" />
                    <input type="radio" name="example" class="rating" value="5" />
                </div>
                <p class="address"><?php echo "$value[Add]";?></p>
                <p class="illustrate">
                    <?php echo "$value[Toldescribe]";?>
                </p>
            </div>
            <div class="clear"></div>
        </div>
    <?php
}

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
