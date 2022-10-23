<?php

namespace App\Repository;

use App\Model\Car;
use Core\Repository\AbstractRepository;

class CarRepository extends AbstractRepository
{

    function getModel(): string
    {
        return Car::class;
    }
}