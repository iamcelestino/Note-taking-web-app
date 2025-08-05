<?php
declare(strict_types=1);

namespace App\Repositories;
use App\Contracts\{
    PasswordResetRepositoryInterface, 
    DatabaseInterface
};

class PasswordResetRepository implements  PasswordResetRepositoryInterface 
{
    public function __construct(
        protected DatabaseInterface $database
    ){}
    
    public function create(string $email, string $token): bool|array
    {
        return $this->database->query(
            "INSERT INTO password_resets (email, token) VALUES (?, ?)",
            [$email, $token]
        );
    }

    public function findByToken(string $token): ?array
    {
        return $this->database->query(
            "SELECT *
            FROM password_resets 
            WHERE  token = :token
            ",
            [
                'token' => $token
            ]
        );
    }
    public function deleteByEmail(string $email): bool|array
    {
        return $this->database->query(
            "DELETE FROM password_resets WHERE email = :email",
            ['email' => $email]
        );
    }

}