<?php
namespace App\Repositories;
use App\Contracts\UserRepositoryInterface;

class GoogleUserRepository implements UserRepositoryInterface
{
    public function findOrCreateUser(array $googleUser): array
    {
        return [
            'name' => $googleUser['name'],
            'email' => $googleUser['email'],
            'picture' => $googleUser['picture']
        ];
    }

    public function updatePasswordByEmail(string $email, string $hashedpassword): array|bool
    {
        return [];
    }
}