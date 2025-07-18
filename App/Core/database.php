<?php
declare(strict_types=1);

namespace App\Core;
use App\Contracts\DatabaseInterface;
use PDO;
use PDOException;

class Database implements DatabaseInterface
{
    private static ?PDO $pdo = null;
    private string $dsn = "mysql:host=127.0.0.1;dbname=app_note_taking;charset=utf8mb4";

    public function connection(): PDO
    {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO(
                    $this->dsn,
                    config['db']['user'],
                    config['db']['pass'],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
            } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
        }

        return self::$pdo;
    }
    public function query(string $query, array $queryData, string $queryDataType = "object"): array|bool
    {
        $statement = $this->connection()->prepare($query);
        if($statement && $statement->execute($queryData)) {
            return $queryDataType === "object" 
            ? $statement->fetchAll(PDO::FETCH_OBJ)
            : $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function lastInsertId(): string
    {
        return $this->connection()->lastInsertId();
    }

    public function beginTransation(): void
    {
         $this->connection()->beginTransaction();
    }

    public function commit(): void
    {
        $this->connection()->commit();
    }

    public function rollBack(): void
    {
        $this->connection()->rollBack();
    }
}