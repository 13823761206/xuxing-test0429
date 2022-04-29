<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';

defined('BASE_ROOT') || define('BASE_ROOT', dirname(dirname(__FILE__)));
$dotenv = Dotenv\Dotenv::createImmutable(BASE_ROOT);
$dotenv->load();

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';



$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
