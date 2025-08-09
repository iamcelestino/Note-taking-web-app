<?php
declare(strict_types=1);

namespace App\Repositories;
use App\Contracts\{UserRepositoryInterface, DatabaseInterface};

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private DatabaseInterface $database
    ){}

    public function findOrCreateUser(array $googleUser): array
    {
        return [];
    }

    public function updatePasswordByEmail(string $email, string $hashedPassword): array|bool
    {
        return $this->database->query(
            "UPDATE users SET password = :password WHERE email = :email",
            [
                'password' => $hashedPassword,
                'email' => $email
            ]
        );
    }
}