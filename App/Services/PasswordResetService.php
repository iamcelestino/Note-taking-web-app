<?php

namespace App\Services;
use App\Mail\PasswordResetMail;
use App\Contracts\{PasswordResetInterface, UserInterface};

class PasswordResetService implements PasswordResetInterface
{
    public function __construct(
        private UserInterface $user
    ){}

    public function requestReset(string $email): bool
    {
        $token = generateToken();
        $this->user->deleteByEmail($email);
        $this->user->create($email, $token);
        PasswordResetMail::send($email, $token);
        return true;
    }

    public function resetPassword(string $token, mixed $newPassword): bool
    {
        $resetRecord = $this->user->findByToken($token);

        if(!$resetRecord || !isset($resetRecord['email'])) {
            return false;
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $email = $resetRecord['email'];

        $this->user->updatePasswordByEmail($email, $hashedPassword);
        
        $this->user->deleteByEmail($email);

        return true;
    }
}