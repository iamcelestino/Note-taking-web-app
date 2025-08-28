<?php
namespace App\Controllers;

use App\Contracts\{UserInterface, DatabaseInterface};
use App\Core\Controller;
use App\Services\PasswordResetService;
use Google_Client;
use Google_Service_OAuth2;

class AuthController extends Controller
{
    public function __construct (
        protected UserInterface $user,
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

        $user = $this->user->findOrCreateUser([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'picture' => $googleUser->picture,
        ]);

        $_SESSION['user'] = $user;
        header('Location: /home');

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

    public function sendPasswordResetEmail(): void
    {
        $this->view('send_password_reset_email', []);
    }

    public function handleForgotPassword()
    {
        $email = $_POST['email'] ?? '';

        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {   
            $passwordResetService = new PasswordResetService($this->user);
            $passwordResetService->requestReset($email);

            $this->redirect('/resetPasswordEmail');
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

        $passwordResetService = new PasswordResetService($this->user);

        $passwordResetService->resetPassword($token, $password);

        if($passwordResetService->resetPassword($token, $password)) {
            echo "Succesfully reseted password";
        } else {
            echo "Invalid Password";
        }
    }
}
