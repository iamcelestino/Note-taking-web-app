<?php

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Core\{
    Container, Database,
    Router, Config,
};

use App\Contracts\{
    UserValidateInterface,
    DatabaseInterface,
    NoteInterface,
    NoteValidateInterface,
    UserInterface,
    TagInterface,
    NoteTagInterface
};

use App\Controllers\{
    SignupController, 
    HomeController, 
    LoginController,
    AuthController,
    NoteController
};
use App\Models\{
    Note, User,
    Tag, NoteTag
};
use App\Validators\{
    UserValidator, 
    NoteValidator
};

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

Config::load(__DIR__ . '/../App/Config/App.php');

$container = new Container();
$container->bind(UserInterface::class, User::class);
$container->bind(UserValidateInterface::class, UserValidator::class);
$container->bind(NoteInterface::class, Note::class);
$container->bind(NoteValidateInterface::class, NoteValidator::class);
$container->bind(DatabaseInterface::class, Database::class);
$container->bind(TagInterface::class, Tag::class);
$container->bind(NoteTagInterface::class, NoteTag::class);

$router = new Router($container);
$router->get('/home', [HomeController::class, 'index']);
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
$router->get('/note/create', [NoteController::class, 'createNote']);
$router->post('/note/create', [NoteController::class, 'createNote']);
$router->get('/note/delete/{id}', [NoteController::class, 'deleteNote']);
$router->post('/note/delete/{id}', [NoteController::class, 'deleteNote']);
$router->get('/note/update/{id}', [NoteController::class, 'updateNote']);
$router->post('/note/update/{id}', [NoteController::class, 'updateNote']);
$router->get('/note/archived', [NoteController::class, 'getArchivedNotes']);
$router->get('/note/search', [NoteController::class, 'searchNote']);

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$router->dispatch($method, $uri);



