<?php

namespace App\Services;
use App\Contracts\PasswordResetRepositoryInterface;
use App\Mail\PasswordResetMail;


class PasswordResetService
{
    public function __construct(
        private PasswordResetRepositoryInterface $passwordRepository
    )
    {
        $this->passwordRepository = $passwordRepository;
    }

    public function requestReset(string $email): bool
    {
        $token = generateToken();
        $this->passwordRepository->deleteByEmail($email);
        $this->passwordRepository->create($email, $token);
        PasswordResetMail::send($email, $token);
        return true;
    }

    public function resetPassword(string $token, string $newPassword): bool
    {
        return true;
    }
}