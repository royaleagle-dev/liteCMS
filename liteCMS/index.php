<?php

$path = isset($_GET['path'])?$_GET['path']:'/';
$pathArray = explode('/', $path);

//autoload all classes in the project
spl_autoload_register(function($class){
   $directories = array('Controllers', 'Core', 'Templates', 'Views');
    for($i=0; $i<count($directories); $i++){
        $filepath = $directories[$i].'/'.$class.'.php';
        //print $filepath;
        if(!file_exists($filepath)){
           continue;
        }else{
            require_once $filepath;
        }
    }
});

require_once "Routes.php";
?>