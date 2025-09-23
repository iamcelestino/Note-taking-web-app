<?php

namespace App\Contracts;

interface PasswordResetInterface 
{
    public function requestReset(string $email): bool;
    public function resetPassword(string $token, mixed $newPassword): bool;
}