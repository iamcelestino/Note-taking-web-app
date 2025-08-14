<?php 
declare(strict_types=1);

namespace App\Contracts;

interface UserInterface 
{
    public function findByEmail(string $email): array|bool|object;
    public function where(string $column, string $value): array|object|bool;
    public function first(string $column, string $value): array|object|bool;
    public function all(): array|object|bool;
    public function insert(array $data): array|bool;
    public function update(mixed $id, array $data): mixed;
    public function getPrimaryKey(): string|int;
    public function delete(int|string $id);
    public function create(string $email, string $token): bool|array;
    public function findBytoken(string $token): ?array;
    public function deleteByEmail(string $email);
    public function findOrCreateUser(array $googleUser): array;
    public function updatePasswordByEmail(string $email, string $hashedpassword): array|bool;
}