<?php

include ARASH_DIR . 'core/assets.php';

function ar_header(){
    app\Controllers\Controller::headerSection();
}

function ar_footer(){
    app\Controllers\Controller::footerSection();
}

function ar_assets($type, $path){
    core\AssetLoader::load($type, $path);
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
    core\ValidateSession::showErrors();
}

function redirectBack(){
    core\Redirect::back();
}

function redirectUrl($url){
    core\Redirect::url($url);
}

function route($route){
    return home_url() . $route;
}

function setSession($key, $value){
    $session = core\Session::getInstance();
    $session->set($key, $value);
}

function getSession($key){
    $session = core\Session::getInstance();

    if ($session->get($key)) {
        $success = $session->get($key);
        echo $success;
        unset($_SESSION[$key]);
    }
}

function createUser($username,  $meail, $password){
    return AR_User::createUser($username,  $meail, $password);
}