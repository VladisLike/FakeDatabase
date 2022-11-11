<?php

namespace Core\Service\ReflectionService;

use ReflectionClass;

interface GenerateClassNameInterface
{
    public function getClassName(string $uri, string $add): string;

}