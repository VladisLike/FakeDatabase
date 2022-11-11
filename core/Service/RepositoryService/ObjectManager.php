<?php

namespace Core\Service\RepositoryService;

use Core\Common\Model;
use Core\Repository\AbstractRepository;
use Core\SyntaxHelper;
use ReflectionClass;

class ObjectManager implements ObjectManagerInterface
{
    private array $data;
    private ReflectionClass $targetClass;
    private AbstractRepository $repository;

    public function __construct(AbstractRepository $repository)
    {
        $this->repository = $repository;
        $reflection = new ReflectionClass($this->repository->getModel());
        $this->data = $this->getDataByClass($reflection);
        $this->targetClass = $reflection;
    }

    private function getDataByClass(ReflectionClass $reflection): array
    {
        return require PATH . '/src/data/' .
            \strtolower($reflection->getShortName()) . 's.php';
    }


    public function getObject(array $item): Model
    {
        $classProperties = $this->targetClass->getProperties();
        $properties = \array_map(function (\ReflectionProperty $property) use ($item) {
            $this->propertyAnalyses(
                $formattedProperty = SyntaxHelper::camelToSnake($property->getName()),
                $item
            );
            return $item[$formattedProperty];
        }, $classProperties);

        return $this->targetClass->newInstance(...$properties);
    }

    private function propertyAnalyses(string $property, array &$item): void
    {
        if (!\is_array($item[$property])) {
            return;
        }

        $objectIds = $item[$property];
        $className = \ucfirst(\implode('', \array_slice(
            $explodedProperty = \str_split($property),
            0,
            \count($explodedProperty) - 1
        )));

        $reflection = new ReflectionClass("App\\Model\\$className");

        $classes = [];
        $oldReflection = $this->targetClass;
        $oldDate = $this->data;
        $this->targetClass = $reflection;
        $this->data = $this->getDataByClass($reflection);

        foreach ($objectIds as $objectId) {
            $classes[] = $this->repository->find($objectId);
        }

        $this->targetClass = $oldReflection;
        $this->data = $oldDate;

        $item[$property] = $classes;
    }


    public function getData(): array
    {
        return $this->data;
    }

    public function getTargetClass(): ReflectionClass
    {
        return $this->targetClass;
    }

}