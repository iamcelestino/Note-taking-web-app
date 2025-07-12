<?php
declare(strict_types=1);
namespace App\Core;

use ReflectionClass;

class Container 
{
    protected array $bindings = [];

    public function bind(string $abstract, string $concrete) {
        $this->bindings[$abstract] = $concrete;
    }

    public function resolve(string $class) {

        $reflector = new ReflectionClass($class);

        if (!$reflector->isInstantiable()) {
            throw new \Exception("Class [$class] is not instantiable.");
        }

        $constructor = $reflector->getConstructor();
        if (!$constructor) {
            return new $class;
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $type = $parameter->getType();
            if ($type === null) {
                throw new \Exception("Cannot resolve class dependency {$parameter->name}");
            }

            $dependencyClass = $type->getName();

            if (isset($this->bindings[$dependencyClass])) {
                $dependencies[] = $this->resolve($this->bindings[$dependencyClass]);
            } else {
                $dependencies[] = $this->resolve($dependencyClass);
            }
        }

        return $reflector->newInstanceArgs($dependencies);
    }
}
