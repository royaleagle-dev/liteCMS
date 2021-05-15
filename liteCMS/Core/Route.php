<?php

class Route{
    
    public static $registered_routes = array();
 
    public static function set($controllerArray, $controller, $controllerName, $action = '', $params = ''){
        
        $controllerPath = "Controllers/$controllerName.php";
        
        if(file_exists($controllerPath)){
            if(in_array($controller, $controllerArray)){
                $loadController = new $controllerName();
                
                if($action == ''){
                    $loadController->index();
                }else{
                    if(method_exists($loadController, $action)){
                        $loadController->$action($params);
                    }else{
                        require_once "Core/404.php";
                    }
                }
                
            }else{
                //echo "Controller Not Found at inner Route";
            }
        }else{
            exit("<b>Route Error:</b> Cannot find controller $controllerName");
        }
        
    }
    
}

?>