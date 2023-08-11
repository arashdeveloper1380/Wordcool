<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once ARASH_DIR . 'env.php';
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB;

if (isset($config) && is_array($config)) {
    $db->addConnection([
        'driver'   => 'mysql',
        'host'     => 'localhost',
        'database' => $config['DB_DATABASE'],
        'username' => $config['DB_USERNAME'],
        'password' => $config['DB_PASSWORD'],
        'charset'  => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'   => 'wp_',
    ]);
}

$db->setAsGlobal();

$db->bootEloquent();



if (isset($config) && is_array($config)) {
    $params = [
        'database'  => $config['DB_DATABASE'],
        'username'  => $config['DB_USERNAME'],
        'password'  => $config['DB_PASSWORD'],
        'prefix'    => 'wp_'
    ];
    Corcel\Database::connect($params);
}