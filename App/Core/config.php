<?php

return [
    'app_name' => $_ENV['APP_NAME'] ?? 'my app',
    'app_env' => $_ENV['APP_ENV'] ?? 'produtction',
    'debug' => $_ENV['APP_DEBUG'] ?? 'false',

    'db' => [
        'host' => $_ENV['DB_HOST'],
        'port' => $_ENV['DB_PORT'],
        'name' => $_ENV['DB_NAME'],
        'user' => $_ENV['DB_USER'],
        'pass' => $_ENV['DB_PASS'],
    ],

    'base_url' => $_ENV['BASE_URL'],
    'assets_url' => $_ENV['ASSETS_URL']
];
