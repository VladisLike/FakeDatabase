<?php

namespace Core\Repository;

use Core\Common\Model;

interface RepositoryInterface
{
    public function find(int $id): ?Model;

    public function findAll(): array;

    public function findBy(array $criteria): array;

}