<?php

namespace Core\Service\ReflectionService;

use Core\SyntaxHelper;
use http\Exception;
use ReflectionClass;

class GenerateClassName implements GenerateClassNameInterface
{

    public function getClassName(string $uri, string $add): string
    {
        return "App\\$add\\" . \ucfirst(\implode('', \array_slice(
                $explodedStr = \str_split(explode('/', $uri)[1]),
                0,
                \count($explodedStr) - 1
            ))) . $add;

    }
}