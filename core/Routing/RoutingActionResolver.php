<?php

namespace Core\Routing;

use Core\Common\AbstractController;
use Core\Service\ReflectionService\GenerateClassNameInterface;
use ReflectionClass;

class RoutingActionResolver implements RoutingActionResolverInterface
{
    private GenerateClassNameInterface $generateClassName;

    public function __construct(GenerateClassNameInterface $generateClassName)
    {
        $this->generateClassName = $generateClassName;
    }

    /**
     * @inheritDoc
     */
    public function resolveAction(string $uri)
    {
        $controllerName = $this->generateClassName->getClassName($uri, 'Controller');
        $repositoryName = $this->generateClassName->getClassName($uri, 'Repository');

        $reflectionController = new ReflectionClass($controllerName);

        /** @var AbstractController $controller */
        $controller = $reflectionController->newInstance(new $repositoryName());

        $controller->showAll();
    }
}