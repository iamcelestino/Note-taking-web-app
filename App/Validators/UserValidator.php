<?php 
declare(strict_types=1);

namespace App\Validators;
use App\Contracts\UserValidateInterface;
use Exception;

class UserValidator implements UserValidateInterface 
{
    public function validate(array $user): bool
    {
        if(empty($user['full_name'])) {
            throw new Exception("Full name not completed");
        }

        if(empty($user['email']) || (!filter_var($user['email'], FILTER_VALIDATE_EMAIL))) {
            throw new Exception("This email is not ok");
        }

        if(empty($user['password']) || $user['password'] <= 4) {
            throw new Exception("This password is not ok");
        }

        return false;   
    }

    public function login(array $user): bool
    {
        
        if(empty($user['email']) || (!filter_var($user['email'], FILTER_VALIDATE_EMAIL))) {
            throw new Exception("This email is not ok");
        }

        if(empty($user['password']) || $user['password'] <= 4) {
            throw new Exception("This password is not ok");
        }
        
        return false;
    }
}