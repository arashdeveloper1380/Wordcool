<?php

namespace Core;

class Redirect {

    public static function url($url){
        header("Location: " . $url);
        exit();
    }

    public static function back(){
        if(isset($_SERVER['HTTP_REFERER'])) {
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit();
        }
    }

}