<?php
declare(strict_types=1);

namespace App\Services;
use App\Contracts\{UserInterface, UserValidateInterface};

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

}

