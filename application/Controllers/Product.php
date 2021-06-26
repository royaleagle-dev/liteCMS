<?php

class Product extends Controller{
    public function list($args){
        print "THis is the product list with the ff arguments";
        print_r($args);
    }

    public function index(){
        print "I'm loading the index function of the Product";
    }
}