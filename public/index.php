<?php

require __DIR__ . '/../App/Core/helpers.php';
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Core\Router;
use App\Core\Container;
use App\Contracts\UserInterface;
use App\Contracts\UserValidateInterface;
use App\Validators\UserValidator;
use App\Models\User;
use App\Controllers\{SignupController, HomeController, LoginController};

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$_ENV = array_merge($_ENV, $_SERVER);

define('config', require __DIR__ . '/../App/Core/config.php');

$container = new Container();
$container->bind(UserInterface::class, User::class);
$container->bind(UserValidateInterface::class, UserValidator::class);

$router = new Router($container);
$router->get('/', [HomeController::class, 'index']);
$router->get('/login', [LoginController::class, 'index']);
$router->post('/login/submit', [LoginController::class, 'submit']);
$router->get('/signup', [SignupController::class, 'index']);
$router->post('/signup/submit', [SignupController::class, 'submit']);

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$router->dispatch($method, $uri);



