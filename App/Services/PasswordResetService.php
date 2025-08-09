<?php

namespace App\Services;
use App\Mail\PasswordResetMail;
use App\Contracts\{PasswordResetRepositoryInterface, UserRepositoryInterface};

class PasswordResetService
{
    public function __construct(
        private PasswordResetRepositoryInterface $passwordRepository,
        private UserRepositoryInterface $userRepository
    ){}

    public function requestReset(string $email): bool
    {
        $token = generateToken();
        $this->passwordRepository->deleteByEmail($email);
        $this->passwordRepository->create($email, $token);
        PasswordResetMail::send($email, $token);
        return true;
    }

    public function resetPassword(string $token, mixed $newPassword): bool
    {
        $resetRecord = $this->passwordRepository->findByToken($token);

        if(!$resetRecord || !isset($resetRecord['email'])) {
            return false;
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $email = $resetRecord['email'];

        $this->userRepository->updatePasswordByEmail($email, $hashedPassword);
        
        $this->passwordRepository->deleteByEmail($email);

        return true;
    }
}