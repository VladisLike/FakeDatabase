<?php

use App\Controller\CarController;
use App\Controller\ProductController;
use App\Controller\UserController;
use App\Model\Car;
use App\Repository\CarRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Core\Kernel;
use Core\Request\Request;
use Core\Routing\Router;
use Core\Routing\RoutingActionResolver;
use Core\Service\ReflectionService\GenerateClassName;
use Core\Service\RepositoryService\ObjectManager;

chdir(dirname(__DIR__));
require_once 'vendor/autoload.php';

define("PATH", \getcwd());

//$controller = new ProductController(new ProductRepository());
//$controller->getBy(['discount' => 8]);

//$controller = new UserController(new UserRepository());
//$controller->get(1);

//$controller = new CarController(new CarRepository());
//$controller->get(1);

$request = new Request();
$request->withParams($_SERVER);
$generateClassName = new GenerateClassName();

$app = new Kernel(new Router($generateClassName), new RoutingActionResolver($generateClassName));
$app->run($request, []);

