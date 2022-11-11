<?php

namespace Core;

use Core\Request\Request;
use Core\Response\Response;
use Core\Routing\RouterInterface;
use Core\Routing\RoutingActionResolverInterface;

class Kernel
{
    private RouterInterface $router;

    private RoutingActionResolverInterface $routingActionResolver;

    public function __construct(RouterInterface $router, RoutingActionResolverInterface $routingActionResolver)
    {
        $this->router = $router;
        $this->routingActionResolver = $routingActionResolver;
    }

    public function run(Request $request, array $config): ?Response
    {
        $response = null;

        if ($this->router->match($request->getUri())) {
            $this->routingActionResolver->resolveAction($request->getUri());
        } else {
            print_r('Not Found Route!');
        }

        return $response;
    }
}