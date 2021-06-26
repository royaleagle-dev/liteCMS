<?php

spl_autoload_register(function($class){
    $dirs = ['../application/Core'];
    foreach ($dirs as $dir){
        $filePath = $dir."/$class.php";
        if (file_exists($filePath)){
            require_once "$filePath";
        }else{
            exit("<b>Core Error: </b> Cannot Load Class $class");
        }
    }
});

require_once "../application/config/config.php";
require_once "../application/config/routes.php";
require_once "../application/config/colors.php";
require_once "../application/Core/Login.php";
require_once "../application/helpers/redirect.php";
use Authentication\Login as Auth;

?>