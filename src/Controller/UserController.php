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

    public function run()
    {
        var_dump($this->repository->findAll());
//        var_dump($this->repository->findBy([
//            'last_name' => 'Ivanov',
//            'active' => true
//        ]));
    }
}