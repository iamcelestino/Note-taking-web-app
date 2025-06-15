<?php
declare(strict_types=1);

namespace App\Core;

class App 
{
    protected string|object $controller = 'HomeController';
    protected string $method            = 'index';
    protected array $params             = [];

    public function __construct()
    {
        $URL = $this->parse_url();
        if(file_exists("../App/Controllers" . ucfirst($URL[0]) . " Controller.php")) {
            $this->controller = $URL[0];
            unset($URL[0]);
        }

        $controllerClass = "App\\Controllers\\" . $this->controller;
        $this->controller = new $controllerClass();

        if(isset($URL[1])) {
            if(method_exists($this->controller, $URL[1]));
            unset($URL[1]);
        }

        $URL = array_values($URL);
        $this->params = $URL;
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parse_url() 
    {
        $url = isset($_GET['url']) ? $_GET['url'] : 'HomeController';
        return explode("/", filter_var(trim($url, "/"), FILTER_SANITIZE_URL));
    }
}