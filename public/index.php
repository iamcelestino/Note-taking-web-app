<?php

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Core\{
    Container, Database,
    Router, Config,
};
use App\Contracts\{
    UserInterface, UserValidateInterface, 
    UserRepositoryInterface, DatabaseInterface
};
use App\Controllers\{
    SignupController, 
    HomeController, 
    LoginController,
    AuthController
};
use App\Repositories\GoogleUserRepository;
use App\Validators\UserValidator;
use App\Models\User;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

Config::load(__DIR__ . '/../App/Config/App.php');

$container = new Container();
$container->bind(UserInterface::class, User::class);
$container->bind(UserValidateInterface::class, UserValidator::class);
$container->bind(UserRepositoryInterface::class, GoogleUserRepository::class);
$container->bind(DatabaseInterface::class, Database::class);

$router = new Router($container);
$router->get('/', [HomeController::class, 'index']);
$router->get('/login', [LoginController::class, 'index']);
$router->post('/login/submit', [LoginController::class, 'submit']);
$router->get('/signup', [SignupController::class, 'index']);
$router->post('/signup/submit', [SignupController::class, 'submit']);
$router->get('/auth/google', [AuthController::class, 'redirectToGoogle']);
$router->get('/callback.php', [AuthController::class, 'callback']);
$router->get('/forgotPassword', [AuthController::class, 'forgotPassword']);
$router->get('/resetPasswordEmail', [AuthController::class, 'sendPasswordResetEmail']);
$router->post('/forgotPassword', [AuthController::class, 'handleForgotPassword']);
$router->get('/resetPassword', [AuthController::class, 'resetPassword']);
$router->post('/resetPassword', [AuthController::class, 'handleResetPassword']);

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$router->dispatch($method, $uri);



