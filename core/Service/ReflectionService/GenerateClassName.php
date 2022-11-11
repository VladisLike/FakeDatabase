<?php

namespace Core\Service\ReflectionService;

class GenerateClassName implements GenerateClassNameInterface
{

    public function getClassName(string $uri, string $add): string
    {
        return "App\\$add\\" . \ucfirst(\implode('', \array_slice(
                $explodedStr = \str_split($uri),
                0,
                \count($explodedStr) - 1
            ))) . $add;

    }
}