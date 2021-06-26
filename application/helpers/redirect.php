<?php

function redirect($urlAlias){
    //print_r(ROUTES);
    if (array_key_exists($urlAlias, ROUTES)){
        $orig_url = ROUTES[$urlAlias];
        return URL_ROOT.$orig_url;
    }else{
        exit("<b>Redirect Error: </b> Cannot redirect to $urlAlias because it's not registered");
    }
}

function redirect_with_args($urlAlias, array $args){
    if (array_key_exists($urlAlias, ROUTES)){
        $orig_url = ROUTES[$urlAlias];
        $urlArgs = implode('/', $args);
        $orig_url = $orig_url.'/'.$urlArgs;
        return URL_ROOT.$orig_url;
    }
}

$test = redirect_with_args('post_delete', array(1));
//echo $test;

?>