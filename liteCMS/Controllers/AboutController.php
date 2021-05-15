<?php

class AboutController extends Controller{
    
    public function index(){
        $this->view->context = array('title'=>'About Section');
        $this->view->render("Templates/about.html");
    }
}


?>