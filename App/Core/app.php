<?php
declare(strict_types=1);

namespace App\Core;

class App 
{
    protected string|object $controller = 'HomeController';
    protected string $method = 'index';
    protected array $params = [];

    public function __construct()
    {
        $URL = $this->parse_url();

        if (isset($URL[0])) {
            
            $possibleController = ucfirst($URL[0]) . 'Controller';
            $controllerPath = "../App/Controllers/" . $possibleController . ".php";

            if (file_exists($controllerPath)) {
                $this->controller = $possibleController;
                unset($URL[0]);
            }
        }
        
        $controllerClass = "App\\Controllers\\" . $this->controller;

        if (!class_exists($controllerClass)) {
            throw new \Exception("Controller {$controllerClass} not found.");
        }

        $this->controller = new $controllerClass();

        if (isset($URL[1]) && method_exists($this->controller, $URL[1])) {
            $this->method = $URL[1];
            unset($URL[1]);
        }

        $this->params = array_values($URL);

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parse_url(): array
    {
        $url = $_GET['url'] ?? 'home';
        return explode('/', filter_var(trim($url, '/'), FILTER_SANITIZE_URL));
    }
}
