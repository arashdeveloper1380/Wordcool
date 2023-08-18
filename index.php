<?php

/**
 * Plugin Name: Arash Framework
*/

class Boot {

    public function __construct(){
        self::constants();
        self::init();
    }

    public function constants(){
        define('ARASH_DIR', plugin_dir_path(__FILE__));
        define('ARASH_URL', plugin_dir_url(__FILE__));
        define('ARASH_CONFIG', ARASH_DIR . 'config/');
        define('ARASH_MIGRATIONS', ARASH_DIR . 'database/migrations/');
    }

    public function init(){
        register_activation_hook(__FILE__, [$this, 'activePlugin']);
        register_deactivation_hook(__FILE__, [$this, 'deactivePlugin']);

        include ARASH_DIR . "routes/route.php";
        include ARASH_DIR . "Config/database.php";
        include ARASH_DIR . "Config/yoyo.php";
        include ARASH_DIR . "init.php";
        
    }
    public function activePlugin(){

    }

    public function deactivePlugin(){
        
    }
}

new Boot;