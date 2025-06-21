<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../App/Core/helpers.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use App\Core\App;

$app = new App();

