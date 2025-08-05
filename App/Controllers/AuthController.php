<?php

namespace App\Controllers;

use App\Contracts\DatabaseInterface;
use App\Contracts\UserRepositoryInterface;
use App\Core\Controller;
use App\Repositories\{PasswordResetRepository, UserRepository};
use App\Services\PasswordResetService;
use Google_Client;
use Google_Service_OAuth2;

class AuthController extends Controller
{
    public function __construct (
        protected UserRepositoryInterface $userRepo,
        protected DatabaseInterface $database
    ){}

    public function index(): void
    {
        $this->view('login', []);
    }

    public function getGoogleClient(): Google_Client
    {
        $client = new Google_Client();
        $client->setClientId(config('googleSecret')['clientId']);
        $client->setClientSecret(config('googleSecret')['clientSecret']);
        $client->setRedirectUri(config('googleSecret')['redirectUri']);
        $client->addScope('email');
        $client->addScope('profile');
        return $client;
    }

    public function callback(): void
    {
        $client = $this->getGoogleClient();
        if (!isset($_GET['code'])) {
            echo "The authorization code is missing";
            return;

        }

        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token);

        $oauth = new Google_Service_OAuth2($client);
        $googleUser = $oauth->userinfo->get();

        $user = $this->userRepo->findOrCreateUser([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'picture' => $googleUser->picture,
        ]);

        $_SESSION['user'] = $user;
        header('Location: /');

    }

    public function redirectToGoogle(): void
    {
        $client = $this->getGoogleClient();
        $authUrl = $client->createAuthUrl();
        header('Location: ' . $authUrl);
        exit;
    }

    public function forgotPassword(): void
    {
        $this->view('forgot_password', []);
    }

    public function handleForgotPassword()
    {
        $email = $_POST['email'] ?? '';

        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $passwordResetService = new PasswordResetService(
                new PasswordResetRepository($this->database),
                new UserRepository($this->database)
            );

            $passwordResetService->requestReset($email);

            echo "A link was sent for you to reset your password";
        }else {
            echo "Invalid email format";
        }
    }

    public function resetPassword(): void
    {
        $token = $_GET['token'] ?? '';
        $this->view('reset_password', ['token' => $token]);
    }

    public function handleResetPassword()
    {
        $token = $_POST['token'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        if($password != $confirmPassword || strlen($password) < 6) {
            echo "password does match or it too short";
            return;
        }

        $passwordResetService = new PasswordResetService(
            new PasswordResetRepository($this->database),
            new UserRepository($this->database)
        );

        if($passwordResetService->resetPassword($token, $password)) {
            echo "Succesfully reseted password";
        } else {
            echo "Invalid Password";
        }

    }
}
