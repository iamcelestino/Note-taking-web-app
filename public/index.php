<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../App/Core/helpers.php';

use Dotenv\Dotenv;
use App\Core\Router;
use App\Controllers\
{SignupController, HomeController};

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$router = new Router();

$router->get('/', [HomeController::class, 'index']);
$router->get('/signup', [SignupController::class, 'index']);

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$router->dispatch($method, $uri);



