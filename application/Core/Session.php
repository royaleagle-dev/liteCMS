<?php

class Session{

    public function __construct(){
        session_start();
    }
    public function set_session(array $session_items){
        foreach ($session_items as $key => $value){
            $_SESSION[$key] = $value;
        }

    }
    public function check_session_exist(array $session_items){
        $successful_checks = [];
        foreach($session_items as $item){
            if(isset($_SESSION[$item])){$successful_checks[] = 1;}
        }
        if(count($successful_checks) == count($session_items)){
            return true;
        }
    }

    public static function end_session(){
        session_destroy();
    }

    public static function flash_message($message){
        $_SESSION['message'] = $message;
        return $_SESSION['message'];
    }

    public static function clear_flash_message($message){
        unset($_SESSION['msg']);
    }

}

?>