<?php
declare(strict_types=1);

namespace App\Contracts;

Interface BaseInterface {   
    public function where(string $column, mixed $value): array|object|bool;
    public function first(string $column, string $value): array|object|bool;
    public function all(): array|object|bool;
    public function insert(array $data): array|bool;
    public function update(mixed $id, array $data): void;
    public function getPrimaryKey(): string|int;
    public function delete(int|string $id);
    public function lastInsertId(): int|string;
    public function beginTransation(): void;
    public function commit(): void;
    public function rollBack(): void;
}