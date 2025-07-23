<?php

namespace App\Services;
use App\Contracts\PasswordResetRepositoryInterface;


class PasswordResetService
{
    public function __construct(
        private PasswordResetRepositoryInterface $passwordRepository
    )
    {
        $this->passwordRepository = $passwordRepository;
    }

    public function requestReset(): void
    {

    }

    public function resetPassword(string $token, string $newPassword): bool
    {
        return true;
    }
}