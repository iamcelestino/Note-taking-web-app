<?php
declare(strict_types=1);

namespace App\Contracts;
use PDO;

interface DatabaseInterface
{
    public function connection(): PDO;
    public function query(string $query, array $queryData, string $queryDataType = "object"): array|bool;
}
