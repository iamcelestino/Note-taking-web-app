<?php

require __DIR__ . '/../App/Helpers/Helpers.php';
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Core\Router;
use App\Core\Config;
use App\Core\Container;
use App\Contracts\UserInterface;
use App\Contracts\UserValidateInterface;
use App\Contracts\UserRepositoryInterface;
use App\Repositories\GoogleUserRepository;
use App\Controllers\AuthController;
use App\Validators\UserValidator;
use App\Models\User;
use App\Controllers\{SignupController, HomeController, LoginController};

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

Config::load(__DIR__ . '/../App/Config/App.php');

$container = new Container();
$container->bind(UserInterface::class, User::class);
$container->bind(UserValidateInterface::class, UserValidator::class);
$container->bind(UserRepositoryInterface::class, GoogleUserRepository::class);

$router = new Router($container);
$router->get('/', [HomeController::class, 'index']);
$router->get('/login', [LoginController::class, 'index']);
$router->post('/login/submit', [LoginController::class, 'submit']);
$router->get('/signup', [SignupController::class, 'index']);
$router->post('/signup/submit', [SignupController::class, 'submit']);
$router->get('/auth/google', [AuthController::class, 'redirectToGoogle']);
$router->get('/callback.php', [AuthController::class, 'callback']);

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$router->dispatch($method, $uri);



