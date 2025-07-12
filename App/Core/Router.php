<?php

declare(strict_types=1);

namespace App\Core;
use App\Core\Container;

class Router
{
    protected array $routes = [
        'GET'=> [],
        'POST'=> []
    ];

    public function __construct(protected Container $container)
    {
        $this->container = $container;
    }
    
    public function get(string $path, array $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, array $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch(string $method, string $uri): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';

        if(!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            echo "404, not found uri";
            exit;
        }

        [$controller, $method] = $this->routes[$method][$uri];

        if(!class_exists($controller) || !method_exists($controller, $method)) {
            http_response_code(500);
            echo "controller no found";
            exit;
        }

        $instance = $this->container->resolve($controller);

        call_user_func([$instance, $method]);
    }

}