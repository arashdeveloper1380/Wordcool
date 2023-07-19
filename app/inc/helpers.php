<?php

function ar_header(){
    Controller::headerSection();
}

function ar_footer(){
    Controller::footerSection();
}

function ar_assets($type, $path){
    AssetLoader::load($type, $path);
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
    ValidateSession::showErrors();
}

function redirectBack(){
    Redirect::back();
}

function redirectUrl($url){
    Redirect::url($url);
}

function route($route){
    return home_url() . $route;
}

function setSession($key, $value){
    $session = Session::getInstance();
    $session->set($key, $value);
}

function getSession($key){
    $session = Session::getInstance();

    if ($session->get($key)) {
        $success = $session->get($key);
        echo $success;
        unset($_SESSION[$key]);
    }
}