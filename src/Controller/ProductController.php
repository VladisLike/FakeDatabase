<?php

namespace App\Controller;

use Core\Common\AbstractController;
use Core\Repository\RepositoryInterface;

final class ProductController extends AbstractController
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function showAll()
    {
        dump($this->repository->findAll());
    }

    public function get(int $id)
    {
        dump($this->repository->find($id));
    }

    public function getBy(array $criteria)
    {
        dump($this->repository->findBy($criteria));
    }

    public function getCount(): int
    {
        return $this->repository->getAllModelCount();
    }

}