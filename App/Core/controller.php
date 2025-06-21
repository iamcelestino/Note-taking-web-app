<?php
declare(strict_types=1);

namespace App\Core;

abstract class Controller 
{
    abstract protected function index(): void;

    protected function view(string $view, array $data): void
    {
        extract($data);
        $path = "../App/Views/{$view}.php";
        require_once file_exists($path) ? $path : "../App/Views/404.php";
    }

    protected function loadModel(string $model)
    {
        $modelPath = "App\\Models\\$model";
        if(class_exists($modelPath)) {
            return new $modelPath();
        }

        throw new \Exception("Model ". $modelPath . "Not found");
    }

    protected function redirect(string $link): void
    {
        header("location ". config('base_url') .trim($link, "/"));
    }

}