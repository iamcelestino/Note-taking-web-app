<?php 
declare(strict_types=1);

namespace App\Models;
use App\Contracts\UserInterface;
use App\Core\Model;

class User extends Model implements UserInterface
{
    public function findByEmail(string $email): array|bool|object
    {
        return $this->where('email', $email);
    }

    public function findOrCreateUser(array $googleUser): array
    {
        return [
            'name' => $googleUser['name'],
            'email' => $googleUser['email'],
            'picture' => $googleUser['picture']
        ];
    }

    public function updatePasswordByEmail(string $email, string $hashedPassword): array|bool
    {
        return $this->query(
            "UPDATE users SET password = :password WHERE email = :email",
            [
                'password' => $hashedPassword,
                'email' => $email
            ]
        );
    }
        
    public function create(string $email, string $token): bool|array
    {
        return $this->query(
            "INSERT INTO password_resets (email, token) VALUES (?, ?)",
            [$email, $token]
        );
    }

    public function findByToken(string $token): ?array
    {
        return $this->query(
            "SELECT *
            FROM password_resets 
            WHERE token = :token
            ",
            ['token' => $token],
            "array"
        )[0] ?? null;
    }
    
    public function deleteByEmail(string $email): bool|array
    {
        return $this->query(
            "DELETE FROM password_resets WHERE email = :email",
            ['email' => $email]
        );
    }
}