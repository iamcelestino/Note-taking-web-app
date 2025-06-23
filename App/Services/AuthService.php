<?php
declare(strict_types=1);

namespace App\Services;
use App\Contracts\UserInterface;
use Exception;

class AuthService 
{
    public function __construct (
        protected UserInterface $userModel
    ){}

    public function signup(array $user): void
    {
        if(empty($user['full_name'])) {
             throw new Exception("Full name not completed");
        }

        if(empty($user['email']) || (!filter_var($user['email'], FILTER_VALIDATE_EMAIL))) {
             throw new Exception("This email is not ok");
        }

        if(empty($user['password']) || $user['password'] <= 4) {
            throw new Exception("This email is not ok");
        }

        if($this->userModel->findByEmail($user['email'])) {
            throw new Exception("");
        }

        $user['password']= password_hash($user['password'], PASSWORD_DEFAULT);
        $this->userModel->insert($user);
    }
}

