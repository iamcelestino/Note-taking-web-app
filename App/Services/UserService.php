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
        
        $user = $this->userModel->where('email', $user[0]->email) ?? null;
        $password['confirmPassword'] = password_hash($password['confirmPassword'], PASSWORD_DEFAULT);

        $confirmPassword = ['password' => $password['confirmPassword']];
        
        if($user && password_verify($password['oldPassword'], $user[0]->password)) {
            $this->userModel->update($user[0]->user_id, $confirmPassword);
        }

        throw new \Exception("Invalid password");
    }
}

