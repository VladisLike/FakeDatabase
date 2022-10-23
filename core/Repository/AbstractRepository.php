<?php

namespace Core\Repository;

use Core\Common\Model;
use Core\SyntaxHelper;
use ReflectionClass;

abstract class AbstractRepository implements RepositoryInterface
{
    private array $data;
    private ReflectionClass $targetClass;

    public function __construct()
    {
        $reflection = new ReflectionClass($this->getModel());
        $this->data = $this->getDataByClass($reflection);
        $this->targetClass = $reflection;
    }

    private function getDataByClass(ReflectionClass $reflection): array
    {
        return require PATH . '/src/data/' .
            \strtolower($reflection->getShortName()) . 's.php';
    }

    private function determineInstanceArguments(array $item): array
    {
        $classProperties = $this->targetClass->getProperties();
        return \array_map(function (\ReflectionProperty $property) use ($item) {
            $this->propertyAnalyses(
                $formattedProperty = SyntaxHelper::camelToSnake($property->getName()),
                $item
            );
            return $item[$formattedProperty];
        }, $classProperties);
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
            $classes[] = $this->find($objectId);
        }

        $this->targetClass = $oldReflection;
        $this->data = $oldDate;

        $item[$property] = $classes;
    }

    public function find(int $id): ?Model
    {
        foreach ($this->data as $item) {
            if ($item['id'] === $id) {
                $arguments = $this->determineInstanceArguments($item);
                return $this->targetClass->newInstance(...$arguments);
            }
        }

        return null;
    }

    public function findAll(): array
    {
        $models = [];

        foreach ($this->data as $item) {
            $properties = $this->determineInstanceArguments($item);
            $models[] = $this->targetClass->newInstance(...$properties);
        }

        return $models;
    }

    public function findBy(array $criteria): array
    {
        $models = [];

        foreach ($this->data as $item) {
            if ($this->determineItemCompareWith($item, $criteria)) {
                $properties = $this->determineInstanceArguments($item);
                $models[] = $this->targetClass->newInstance(...$properties);
            }
        }

        return $models;
    }

    protected function determineItemCompareWith(array $item, array $criteria): bool
    {
        $isCompared = true;
        $diffArray = \array_diff($item, $criteria);

        foreach ($criteria as $key => $value) {
            if (\array_key_exists($key, $diffArray)) {
                $isCompared = false;
            }
        }

        return $isCompared;
    }

    abstract function getModel(): string;
}