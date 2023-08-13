<?php

use Core\Csrf\Csrf;
use Core\View\View;
use Illuminate\Database\Capsule\Manager as DB;

include ARASH_DIR . 'Core/Assets/Assets.php';

if(!function_exists('ar_assets')){
    function ar_assets($type, $path){
        Core\Assets\AssetLoader::load($type, $path);
    }
    
}

if(!function_exists('dd')){
    function dd($data){
        ini_set("highlight.comment", "#969896; font-style: italic");
        ini_set("highlight.default", "#FFFFFF");
        ini_set("highlight.html", "#D16568");
        ini_set("highlight.keyword", "#7FA3BC; font-weight: bold");
        ini_set("highlight.string", "#F2C47E");
        $output = highlight_string("<?php\n\n" . var_export($data, true), true);
        echo "<div style=\"background-color: #1C1E21; padding: 1rem\">{$output}</div>";
        die();
    }
}

if(!function_exists('errors')){
    function errors(){
        Core\ValidateSession\ValidateSession::showErrors();
    }
}

if(!function_exists('redirectBack')){
    function redirectBack(){
        Core\Redirect\Redirect::back();
    }
}

if(!function_exists('redirectUrl')){
    function redirectUrl($url){
        Core\Redirect\Redirect::url($url);
    }
}

if(!function_exists('route')){
    function route($route){
        return home_url() . $route;
    }
}

if(!function_exists('routeWithParam')){
    function routeWithParam($route, $param = ''){
        return home_url() . $route . '/' . $param;
    }
    
}

if(!function_exists('setSession')){
    function setSession($key, $value){
        $session = Core\Session\Session::getInstance();
        $session->set($key, $value);
    }
}

if(!function_exists('getSession')){
    function getSession($key){
        $session = Core\Session\Session::getInstance();
    
        if ($session->get($key)) {
            $success = $session->get($key);
            echo $success;
            unset($_SESSION[$key]);
        }
    }
}

if(!function_exists('createUser')){
    function createUser($username,  $meail, $password){
        return AR_User::createUser($username,  $meail, $password);
    }
}

if(!function_exists('view')){
    function view($view, $data = []){
        View::renderBlade($view, $data);
    }
}

if(!function_exists('db')){
    function db(){
        return new DB;
    }
}

if(!function_exists('csrf')){
    function csrf(){
        $csrf = new Csrf();
        $csrf->generateToken();
    }
}