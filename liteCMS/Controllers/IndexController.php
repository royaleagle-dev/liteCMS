<?php

class IndexController extends Controller{
    
    public function listings($params){
    	$paramList = array();
    	foreach($params as $value){
    		$paramList[] = $value;
    	}
    	print_r($paramList);
    }

    public function index(){
        
        $this->view->context = array('title'=>'From New', 'colors'=>['red', 'indigo', 'orange']);
        $this->view->render("Templates/_index.html");
    }

}

?>