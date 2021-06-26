<?php

$database = new Database;
$statement = $database->query("SELECT * FROM lite_colors", $params = array(), $fetchmode = 'fetchAll');
$colors = array();

foreach($statement as $color){
    $colors[$color->id] = $color->name;
}

define("COLORS", $colors);

?>