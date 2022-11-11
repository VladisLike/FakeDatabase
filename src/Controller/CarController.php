<?php

namespace App\Controller;

use Core\Common\AbstractController;
use Core\Repository\AbstractRepository;

class CarController extends AbstractController
{
    private AbstractRepository $repository;

    public function __construct(AbstractRepository $repository)
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