<?php
declare(strict_types=1);

namespace App\Contracts;

Interface BaseInterface {   
    public function where(string $column, string $value): array|object|bool;
    public function first(string $column, string $value): array|object|bool;
    public function all(): array|object|bool;
    public function insert(array $data): array|bool;
    public function update(mixed $id, array $data): mixed;
    public function getPrimaryKey(): string|int;
    public function delete(int|string $id);
}