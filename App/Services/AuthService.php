<?php
declare(strict_types=1);

namespace App\Services;
use App\Contracts\{UserInterface, UserValidateInterface};
use Google_Client;

class AuthService 
{
    public function __construct (
        protected UserInterface $userModel,
        protected UserValidateInterface $validator
    ){}

    public function signup(array $user): void
    {
        $this->validator->validate($user);
        $user['password']= password_hash($user['password'], PASSWORD_DEFAULT);
        $this->userModel->insert($user);
    }

    public function login(array $data): bool
    {
        $this->validator->login($data);

        $user = $this->userModel->where('email', $data['email'])[0] ?? null;
        
        if ($user && password_verify($data['password'], $user->password)) {
            return true;
        }

        throw new \Exception("Invalid data");
    }

    public function getGoogleClient(): Google_Client
    {
        $client = new Google_Client();
        $client->setClientId();
        $client->setClientSecret();
        $client->setRedirectUri();
        $client->addScope();
        $client->addScope();

        return $client;
    }

    public function signupWithGoogle(): void
    {
        
    }

}

