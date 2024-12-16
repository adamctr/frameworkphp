<?php

use src\Minification;

require '../vendor/autoload.php';

require_once '../includes/autoload.php';
Autoloader::register();
define('APP_ENV', 'development');

if (APP_ENV === 'production') {
    $minification = new Minification();
    $minification->minifyAssets();
}

require_once '../includes/database.php';

/*$migrations = new Migrations();
$migrations->migrate();*/

require_once '../routes/index.php';











