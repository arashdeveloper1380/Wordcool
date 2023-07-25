<?php

/**
 * Plugin Name: Arash Framework
*/

require_once 'C:/xampp/htdocs/arash-framework/wp-content/plugins/Wordcool/vendor/autoload.php';

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

        self::configDatabase();
        self::migrations();

        include ARASH_DIR . "route.php";
//        include ARASH_DIR . "world.php";
    }

    public function configDatabase(){
        include ARASH_CONFIG . 'database.php';
    }

    public function migrations(){
        $sample = self::tables('sample')['sample'];
        $tablePureName = str_replace('wp_', '', $sample);

        self::existTable($tablePureName);
    }

    public function activePlugin(){

    }

    public function deactivePlugin(){
        
    }

    public function tables($table){
        global $wpdb;
        $table = $wpdb->prefix;

        return [
            'sample' => "{$table}sample"
        ];
    }

    public function existTable($table){
        global $wpdb;

        $tableName = ucfirst($table);
        $migrationName = "Create{$tableName}Table";

        $table_name = $wpdb->prefix . $table;

        $table_exists = $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) == $table_name;

        if (!$table_exists ) {
            include ARASH_MIGRATIONS . "create_{$table}_table.php";
            (new $migrationName())->up();
        } else {
            return;
        }
    }

}

new Boot;