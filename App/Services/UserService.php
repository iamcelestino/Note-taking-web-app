<?php
declare(strict_types=1);

namespace App\Services;
use Google_Client;
use App\Contracts\{
    UserInterface, 
    UserValidateInterface
};

class UserService 
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

        throw new \Exception("Invalid data, no user");
    }


    public function changePassword(array $password, array $user): bool
    {
        $this->validator->changePassword($password);

        $user = $this->userModel->where('email', $user['email'])[0] ?? null;
        $password['confirmPassword'] = password_hash($password['confirmPassword'], PASSWORD_DEFAULT);
        
        if($user && password_verify($password['confirmPassword'], $user->password)) {
            $this->userModel->update($user['user_id'], $password);
        }

        throw new \Exception("Invalid password");
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

}

