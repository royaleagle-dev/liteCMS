<?php

$controller = $pathArray[0];
$action = '';

if(array_key_exists(1, $pathArray)){
    $action = $pathArray[1];
}

$params = $pathArray;
if(array_key_exists(1, $params)){
    unset($params[0]);
    unset($params[1]);
}

//$testArray = array('controller'=>$controller, 'action'=>$action, 'params'=>$params);

$routes = Route::$registered_routes = array('admin', '', 'index');

$settings = parse_ini_file("settings.ini");

if($settings['dbase_set'] == 'false'){
    $pathArray[0] = 'setDB';
    Route::set($pathArray, 'setDB', 'SetDatabaseController');
}elseif($controller == ''){
    //$routes[] = ''; //home route, (app/root)
    Route::set($pathArray, '', 'IndexController');
    
}elseif(in_array($controller, $routes)){
        Route::set($pathArray, 'admin', 'AdminIndexController', $action, $params);
        //add other routes as required
}else{
    require_once "Core/404.php";
}

?>