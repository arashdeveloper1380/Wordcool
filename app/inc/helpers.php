<?php

include ARASH_DIR . 'Core/assets.php';

function ar_header(){
    App\Controllers\Controller::headerSection();
}

function ar_footer(){
    App\Controllers\Controller::footerSection();
}

function ar_assets($type, $path){
    Core\AssetLoader::load($type, $path);
}

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

function errors(){
    Core\ValidateSession::showErrors();
}

function redirectBack(){
    Core\Redirect::back();
}

function redirectUrl($url){
    Core\Redirect::url($url);
}

function route($route){
    return home_url() . $route;
}

function routeWithParam($route, $param = ''){
    return home_url() . $route . '/' . $param;
}

function setSession($key, $value){
    $session = Core\Session::getInstance();
    $session->set($key, $value);
}

function getSession($key){
    $session = Core\Session::getInstance();

    if ($session->get($key)) {
        $success = $session->get($key);
        echo $success;
        unset($_SESSION[$key]);
    }
}

function createUser($username,  $meail, $password){
    return AR_User::createUser($username,  $meail, $password);
}