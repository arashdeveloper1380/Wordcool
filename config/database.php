<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once ARASH_DIR . 'env.php';

if (isset($config) && is_array($config)) {
    $params = [
        'database'  => $config['DB_DATABASE'],
        'username'  => $config['DB_USERNAME'],
        'password'  => $config['DB_PASSWORD'],
        'prefix'    => 'wp_'
    ];
    Corcel\Database::connect($params);
}