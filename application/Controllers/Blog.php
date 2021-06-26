<?php

class Blog extends Controller {

    public function construct(){
        //continue from here
    }

    public function post($post){
        print $post[0];
        print "<hr>";
        print $post[1];
    }

}

?>