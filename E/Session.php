<?php

class Session
{

    public static function start(){
        session_start();
    }

    public static function set($index, $value){
        $_SESSION[$index] = $value;
    }

    public static function get($index){
        return $_SESSION[$index];
    }

    public static function check($index){
        if (isset($_SESSION[$index])){
            return true;
        }
    }

    public static function del($index){
        unset($_SESSION[$index]);
    }

}