<?php

namespace App\Core;
use Exception;

class Config 
{
    protected static array $config = [];

    public static function load(string $path): void
    {
        if( ! file_exists($path)) {
            throw new Exception("config file not found at {$path}"); 

        }
        self::$config = require $path;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return self::$config[$key] ?? $default;
    }

    public static function all(): array
    {
        return self::$config;
    }

}
