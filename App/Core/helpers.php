<?php

namespace App\Core;

function config($key, $default = null)
{
    static $config;

    if (!$config) {
        $config = require __DIR__ . '/../App/Core/config.php';
    }

    return $config[$key] ?? $default;
}


function dd(mixed $data) {
    echo '';
    print_r($data);
    echo '';
}