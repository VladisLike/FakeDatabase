<?php

namespace App\Repository;

use App\Model\Product;
use Core\Repository\AbstractRepository;

class ProductRepository extends AbstractRepository
{

    function getModel(): string
    {
        return Product::class;
    }
}