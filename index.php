<?php

use App\Controller\CarController;
use App\Controller\ProductController;
use App\Controller\UserController;
use App\Repository\CarRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;

require_once 'vendor/autoload.php';

define("PATH", \getcwd());

//$controller = new ProductController(new ProductRepository());
//$controller->run();

//$controller = new UserController(new UserRepository());
//$controller->run();

$controller = new CarController(new CarRepository());
var_dump($controller->index(1));
exit();
