<?php

namespace App\Controller;

use Core\Common\AbstractController;
use Core\Common\Model;
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
        var_dump($this->repository->findAll());
    }

    public function car(int $id)
    {
        var_dump($this->repository->find($id));
    }

    public function carBy(array $criteria)
    {
        var_dump($this->repository->findBy($criteria));
    }
}