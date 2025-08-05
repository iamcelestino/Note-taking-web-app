<?php
declare(strict_types=1);

namespace App\Contracts;

interface PasswordResetRepositoryInterface {
    public function create(string $email, string $token): bool|array;
    public function findBytoken(string $token): ?array;
    public function deleteByEmail(string $email);
}