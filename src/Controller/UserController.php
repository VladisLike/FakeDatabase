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
        var_dump($this->repository->findAll());
    }

    public function user(int $id)
    {
        var_dump($this->repository->find($id));
    }

    public function userBy(array $criteria)
    {
        var_dump($this->repository->findBy($criteria));
    }


}