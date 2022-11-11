<?php

namespace Core\Routing;

use Core\Service\ReflectionService\GenerateClassNameInterface;

class Router implements RouterInterface
{
    private GenerateClassNameInterface $generateClassName;

    public function __construct(GenerateClassNameInterface $generateClassName)
    {
        $this->generateClassName = $generateClassName;
    }


    public function match(string $uri): bool
    {
        $result = false;
        $className = $this->generateClassName->getClassName($uri, 'Controller');

        if (class_exists($className)) {
            $result = true;
        }

        return $result;
    }

}
