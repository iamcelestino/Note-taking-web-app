<?php 
declare(strict_types=1);

namespace App\Validators;
use App\Contracts\UserValidateInterface;
use App\Exceptions\ValidateException;

class UserValidator implements UserValidateInterface 
{
    public function validate(array $user): bool
    {
        $errors = [];
        if(empty($user['full_name'])) {
            $errors['full_name'] = "Full name not completed";
        }

        if(empty($user['email']) || (!filter_var($user['email'], FILTER_VALIDATE_EMAIL))) {
            $errors['email'] = "This email is not ok";
        }

        if(empty($user['password']) || $user['password'] <= 4) {
            $errors['password'] = "This password is not ok";
        }

        if(!empty($errors)) {
            throw new ValidateException('Validation Failed', $errors);
        };

        return true;   
    }

    public function login(array $user): bool
    {
        if(empty($user['email']) || (!filter_var($user['email'], FILTER_VALIDATE_EMAIL))) {
            $errors['email'] = "This email is not ok";
        }

        if(empty($user['password']) || $user['password'] <= 4) {
            $errors['password'] = "This password is not ok";
        }

        return true;
    }
}