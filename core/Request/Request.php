<?php

namespace Core\Request;

class Request
{
    private array $params = [];

    public function getParams(): array
    {
        return $this->params;
    }

    public function withParams(array $query)
    {
        $this->params = $query;
    }

    public function getUri(): string
    {
        return $this->params['REQUEST_URI'];
    }

}