<?php

return [
    'app_name' => $_ENV['APP_NAME'] ?? 'my app',
    'app_env' => $_ENV['APP_ENV'] ?? 'production',
    'debug' => $_ENV['APP_DEBUG'] ?? 'false',

    'db' => [
        'host' => $_ENV['DB_HOST'],
        'port' => $_ENV['DB_PORT'],
        'name' => $_ENV['DB_NAME'],
        'user' => $_ENV['DB_USER'],
        'pass' => $_ENV['DB_PASS'],
    ],

    'googleSecret' => [
        'clientId' => $_ENV['CLIENT_ID'],
        'clientSecret' => $_ENV['CLIENT_SECRET'],
        'redirectUri' => $_ENV['REDIRECT_URIS'],
        'projectId' => '',
    ],

    'base_url' => $_ENV['BASE_URL'],

    'smtp_config' => [
        'host' => $_ENV['MAIL_HOST'], 
        'username'=> $_ENV['MAIL_USERNAME'], 
        'password' => $_ENV['MAIL_PASSWORD'], 
        'port' => $_ENV['MAIL_PORT']
    ]
];
