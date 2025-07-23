<?php
declare(strict_types=1);

namespace App\Repositories;
use App\Contracts\PasswordResetRepositoryInterface;

class PasswordResetRepository implements  PasswordResetRepositoryInterface 
{
    public function create(string $email, string $token): bool{
        return true;
    }

    public function findBytoken(string $token): ?array
    {
        return [];
    }

    public function deleteByEmail(string $email): bool
    {
        return true;
    }
}