<?php
include ARASH_DIR . 'app/inc/helpers.php';
include ARASH_DIR . 'core/assets.php';

class View{

    public static function render($view, $data = []) {
        $viewPath = ARASH_DIR . 'resources/' . str_replace('.', '/', $view) . '.php';
        if (file_exists($viewPath)) {
            if (isset($data) && is_array($data)) {
                extract($data);
            }
            require $viewPath;
        } else {
            throw new Exception('File not found: ' . $viewPath);
        }
    }

}