<?php

declare(strict_types=1);

namespace App\Contracts;
use PDO;

interface DatabaseInterface
{
    public function connection(): PDO;
    public function query(string $query, array $queryData, string $queryDataType = "object"): array|bool;
    public function lastInsertId(): string;
    public function beginTransation(): void;
    public function commit(): void;
    public function rollBack(): void;
}