<?php 
declare(strict_types=1);

namespace App\Contracts;

interface UserInterface extends BaseInterface
{
    public function findByEmail(string $email): array|bool|object;
    public function create(string $email, string $token): bool|array;
    public function findBytoken(string $token): ?array;
    public function deleteByEmail(string $email);
    public function findOrCreateUser(array $googleUser): array;
    public function updatePasswordByEmail(string $email, string $hashedpassword): array|bool;
}