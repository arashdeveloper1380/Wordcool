<?php
namespace core;

class AssetLoader {

    public static function load($type, $path){
        switch ($type){
            case 'css' :
                $path = ARASH_URL . 'public/assets/' . $path . '.css';
                echo '<link rel="stylesheet" type="text/css" href="' . $path . '">';
                break;

            case 'js' :
                $path = ARASH_URL . 'public/assets/' . $path . '.js';
                echo '<script src="' . $path . '"></script>';
                break;
        } 
        return $path;
    }
}