<?php
// 引入composer
require_once 'vendor/autoload.php';

defined('API_ROOT') || define('API_ROOT', dirname(__FILE__));

$dotenv = Dotenv\Dotenv::createImmutable(API_ROOT);
$dotenv->load();


return  [
    'paths' => [
        'migrations' => [API_ROOT . '/db/migrations'],
        'seeds' => API_ROOT . '/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'production',
        'production' => [
            'adapter' => 'mysql',
            'host' => $_ENV['DB_HOST'] ,
            'name' => $_ENV['DB_NAME'] ,
            'user' => $_ENV['DB_USER'],
            'pass' => $_ENV['DB_PASSWORD'] ,
            'port' => $_ENV['DB_PORT'] ,
            'table_prefix' => $_ENV['DB_TABLE_PREFIX'],
            'charset' => 'utf8mb4',
        ]
    ],
    'version_order' => 'creation'
];
