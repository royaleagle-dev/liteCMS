<?php

class View{
    
    public $context;
    
    public function render($template){
        
        Template::load($template, $this->context);
    }
    
}

?>