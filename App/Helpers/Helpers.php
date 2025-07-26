<?php
declare(strict_types=1);

if (!function_exists('config')) {
    function config(string $key, mixed $default = null): mixed
    {
        return \App\Core\Config::get($key, $default);
    }
}

function generateToken(): string {
    return bin2hex(random_bytes(32));
}

function dd(mixed $data): void
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die();
}
