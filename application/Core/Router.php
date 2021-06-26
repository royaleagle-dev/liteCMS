<?php 

class Router{

    protected $currentController = '';
    protected $currentAction = 'index';
    protected $args = [];
    
    public function __construct(){
        $url = $this->getCurrentUrl();
        if($url == null){
            $this->currentController = 'Index';
        }else if ($url[1] == ''){
            $this->currentController = ucwords($url[0]);
        }else{
            $this->currentController = ucwords($url[0]);
            $this->currentAction = $url[1];
            $this->args = array_values($url[2]);
        }
        //load appropriat controller, action and arguments
        require_once "../application/Controllers/$this->currentController.php";
        $controller = $this->currentController = new $this->currentController();
        $action = $this->currentAction;
        $controller->$action($this->args);

    }

    public function getCurrentUrl(){
        $controller = '';
        $action = '';
        $params = '';
        if (isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = explode('/', $url);
            $controller = $url[0];
            unset($url[0]);
            if(array_key_exists(1, $url)){
                $action = $url[1];
                unset($url[1]);
                $params = $url;

            }
            return [$controller, $action, $params];
        }
        
    }
}

?>