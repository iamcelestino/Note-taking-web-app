<?php
declare(strict_types=1);

namespace App\Contracts;

interface UserRepositoryInterface 
{
    public function findOrCreateUser(array $googleUser): array;
    public function updatePasswordByEmail(string $email, string $hashedpassword): array|bool;
}