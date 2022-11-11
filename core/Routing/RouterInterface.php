<?php

namespace Core\Routing;

interface RouterInterface
{
    public function match(string $uri): bool;
}