<?php

include ARASH_DIR . 'Core/Assets/Assets.php';

use Core\Admin\Admin;
use Core\Csrf\Csrf;
use Core\View\View;
use Illuminate\Database\Capsule\Manager as DB;



if(!function_exists('ar_assets')){
    function ar_assets($type, $path){
        Core\Assets\AssetLoader::load($type, $path);
    }
    
}

if(!function_exists('dd')){
    function dd($value){
        dump($value);
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

if(!function_exists('addCup')){
    function addCup($role, $cap){
        return Admin::addCap($role, $cap);
    }
}

if(!function_exists('addCup')){
    function hasCap($role, $cap){
        return Admin::hasCap($role, $cap);
    }
}

if(!function_exists('addRole')){
    function addRole($role_name, $display_name, $capabilities = []){
        return Admin::addRole($role_name, $display_name, $capabilities);
    }
}

if(!function_exists('authorCan')){
    function authorCan($capabilities){
        return Admin::authorCan($capabilities);
    }
}

if(!function_exists('getCapRole')){
    function getCapRole($role_name){
        return Admin::getCapRole($role_name);
    }
}

if(!function_exists('getRole')){
    function getRole($role_name){
        return Admin::getRole($role_name);
    }
}

if(!function_exists('removeRole')){
    function removeRole($role_name){
        return Admin::removeRole($role_name);
    }
}

if(!function_exists('removeRole')){
    function removeCap($role_name, $capability){
        return Admin::removeCap($role_name, $capability);
    }
}

if(!function_exists('getSuperAdmins')){
    function getSuperAdmins(){
        return Admin::getSuperAdmins();
    }
}

if(!function_exists('isSuperAdmin')){
    function isSuperAdmin($user_id){
        return Admin::isSuperAdmin($user_id);
    }
}