<?php

namespace App\Controller;

use Core\Common\AbstractController;
use Core\Repository\RepositoryInterface;

final class UserController extends AbstractController
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function showAll()
    {
        print_r($this->repository->findAll());
    }

    public function get(int $id)
    {
        print_r($this->repository->find($id));
    }

    public function getBy(array $criteria)
    {
        print_r($this->repository->findBy($criteria));
    }


}