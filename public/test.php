<?php

require_once "../application/config/config.php";
require_once "../application/Core/Database.php";

function urlFormatter($postTitle){
    return str_replace(' ', '-', $postTitle );
}

$url = "This is my first post-writing exercise";
$url = urlFormatter($url);
print $url;