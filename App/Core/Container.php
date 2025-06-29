<?php 

namespace App\Core;
use ReflectionClass;


class Container
{
    public function resolve(string $class)
    {
        $reflector = new ReflectionClass($class);

        if($reflector->isInstantiable()) {
            throw new \Exception("class [$class] is not instantiable");
        }

        $constructor = $reflector->getConstructor();

        if(!$constructor) {
            return new $class;
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach($parameters as $param) {
            $dependencies = $param->getType()?->getName();

            if($dependencies) {
                throw new \Exception("cannot resolve class dependency {$param->name}");
            }

            $dependencies[] = $this->resolve($dependencies);
        }

        return $reflector->newInstanceArgs($dependencies);

    }
}