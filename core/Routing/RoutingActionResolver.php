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
        $partUri = explode('/', $uri);

        $controllerName = $this->generateClassName->getClassName($partUri[0], 'Controller');
        $repositoryName = $this->generateClassName->getClassName($partUri[0], 'Repository');

        $reflectionController = new ReflectionClass($controllerName);

        /** @var AbstractController $controller */
        $controller = $reflectionController->newInstance(new $repositoryName());

        if (count($partUri) === 1) {
            $controller->showAll();
        } elseif (count($partUri) === 2) {
            $controller->get($partUri[1]);
        }
    }
}