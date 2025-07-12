<?php
declare(strict_types=1);

namespace App\Core;

use Exception;

abstract class Model extends Database 
{
    protected mixed $table;
    public array $errors = [];
    
    public function __construct()
    {
        if(property_exists($this, 'table')) {
            $this->table = strtolower((new \ReflectionClass($this))->getShortName()) . 's';
        }
    }

    public function where(string $column, string $value): array|object|bool
    {
        $column = addslashes($column);
        $query = "SELECT * FROM " . $this->table . " WHERE " . $column . " = :value";
        $data = $this->query($query, [
            'value' => $value
        ]);

        return $data;
    }

    public function first(string $column, string $value): array|object|bool
    {
        $column = addslashes($column);
        $query = "SELECT * FROM " . $this->table . " WHERE " . $column . " = :value";
        return $this->query($query, ['value' => $value]);

    }

    public function all(): array|object|bool
    {
        $query = "SELECT * FROM ". $this->table;
        return $this->query($query, []);
    }

    public function insert(array $data): array|bool
    {
        $keys = array_keys($data);
        $columns = implode(',', $keys);
        $values = implode(',:', $keys);

        $query = "INSERT INTO $this->table($columns)  VALUES(:$values)";
        return $this->query($query, $data);
    }

    public function update(mixed $id, array $data): mixed
    {
        $string = '';
        foreach($data as $key => $value) {
            $string .= "$key = :$key, ";
        }

        $strg = rtrim($string, ", ");
        $primaryKey = $this->getPrimaryKey();
        $data[$primaryKey] = $id;

        $query = "UPDATE $this->table 
                SET $strg 
                WHERE $primaryKey = :$primaryKey";

        return $this->query($query, $data);

    }

    public function getPrimaryKey(): string|int
    {
        static $primaryKeys = [];
        if(!isset($primaryKeys[$this->table])) {
            $query = "SHOW KEYS FROM {$this->table} WHERE Key_name = 'primary'";
            $result = $this->query($query, [], 'array');

            if(!empty($result)) {
                $primaryKeys[$this->table] = $result[0]['Column_name'];
            } else {
                throw new Exception("Primary key not found for table {$this->table}");

            }
        }
        return $primaryKeys[$this->table];
    }

    public function delete(int|string $id) 
    {
        $primaryKey = $this->getPrimaryKey();
        $query =  "DELETE FROM $this->table WHERE $primaryKey = :$primaryKey";
        $data[$primaryKey] = $id;
        return $this->query($query, $data);
    }

}