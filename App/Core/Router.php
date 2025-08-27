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
        $this->routes['GET'][] = ['path' => $path, 'handler' => $handler];
    }

    public function post(string $path, array $handler): void
    {
        $this->routes['POST'][] = ['path' => $path, 'handler' => $handler];
    }

    public function dispatch(string $method, string $uri): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';

        foreach ($this->routes[$method] as $route) {
            $pattern = preg_replace('#\{[a-zA-Z_][a-zA-Z0-9_]*\}#', '([a-zA-Z0-9_-]+)', $route['path']);
            $pattern = "#^" . rtrim($pattern, '/') . "$#";

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); 

                [$controller, $action] = $route['handler'];

                if (!class_exists($controller) || !method_exists($controller, $action)) {
                    http_response_code(500);
                    echo "Controller or method not found";
                    exit;
                }

                $instance = $this->container->resolve($controller);

                call_user_func_array([$instance, $action], $matches);
                return;
            }
        }

        http_response_code(404);
        echo "404, not found uri";
        exit;
    }
}
