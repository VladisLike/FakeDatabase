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

    public function run()
    {
//        var_dump($this->repository->findBy([
//            'discount' => 8,
//            'in_stock' => true,
//        ]));
        var_dump($this->repository->find(1));

    }


}