<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Core\Common\AbstractController;
use Core\Common\Model;
use Core\Repository\AbstractRepository;

class CarController extends AbstractController
{
    private AbstractRepository $carRepository;

    /**
     * @param AbstractRepository $carRepository
     */
    public function __construct(AbstractRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function index(int $id): Model
    {
        return $this->carRepository->find($id);
    }
}