<?php
include __DIR__."/../vendor/autoload.php";


$url = parse_url($_SERVER['REQUEST_URI']);

$path = isset($url['path']) ? $url['path'] : '/';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

use App\Database\MySQL;
$bdd= new MySQL();
$bdd->connectBdd();
//import des class
use App\Controller\HomeController;
use App\Controller\ErrorController;
<<<<<<< HEAD
use App\Repository\UserRepository;
//créer des objets controller
$homeController = new HomeController;
$errorController = new ErrorController;
$userRepository = new UserRepository;
=======
//créer des objets controller
$homeController = new HomeController();
$errorController = new ErrorController();
>>>>>>> f0990a67843346b2ee48b1ba83b7dfc8d5b18aaf


switch ($path) {
    case '/':
        $homeController->index();
<<<<<<< HEAD
        // dd($userRepository->find(1));
        dd($userRepository->findAll());
=======
>>>>>>> f0990a67843346b2ee48b1ba83b7dfc8d5b18aaf
        break;

    case '/login':
        echo "login";
        break;
    case '/logout':
        echo "logout";
        break;
    case '/chocoblast/add';
        echo "ajout d'un chocoblast";
        break;
    case '/chocoblast/all';
        echo "afficher tous les chocoblasts";
        break;
    case '/chocoblast/id';
        echo "affchage d'un chocoblast";
        break;
    case '/chocoblast/update/id';
        echo "modifier le chocoblast par son ID";
        break;
    case '/chocoblast/delete/id';
        echo "supprimer un chocoblast par son id";
        break;
    default:
        $errorController->error404();
        break;
}