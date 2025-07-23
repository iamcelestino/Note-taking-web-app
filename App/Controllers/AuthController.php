<?php

namespace App\Controllers;

use App\Contracts\UserRepositoryInterface;
use App\Core\Controller;
use App\Services\AuthService;
use Google_Client;
use Google_Service_OAuth2;

class AuthController extends Controller
{
    public function __construct (
        protected UserRepositoryInterface $userRepo
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

    public function resetPassword(): void
    {
        $this->view('reset_password', []);
    }
}
