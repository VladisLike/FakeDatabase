<?php

namespace Core\Routing;

interface RoutingActionResolverInterface
{
    /**
     * @param string $uri
     *
     * @return mixed
     */
    public function resolveAction(string $uri);
}