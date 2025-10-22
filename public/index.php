<?php

include __DIR__ . "../../vendor/autoload.php";

$url = parse_url($_SERVER['REQUEST_URI']);

$path = isset($url['path']) ? $url['path'] : '/';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

//Import des classes
use App\Controller\HomeController;
use App\Controller\ErrorController;
use App\Repository\UserRepository;
use App\Controller\SignInController;

//Création object controller

$homeController = new HomeController;
$errorController = new ErrorController;
$signInController = new SignInController;
$userRepo = new UserRepository;

//Router

switch ($path) {
    case '/':
        $homeController->index();
        break;

    case '/login':
        echo "login";
        break;

    case '/signup':
        $signInController->addUser();
        $signInController->signIn();
        break;

    case '/logout':
        echo "Déconnexion";
        break;

    case '/chocoblast/add':
        echo "Ajout d'un chocoblast";
        break;

    case '/chocoblast/all':
        echo "Afficher tous les chocoblast";
        break;

    case '/chocoblast/id':
        echo "Affichage d'un chocoblast par son ID";
        break;

    case '/chocoblast/update/id':
        echo "Modifier le chocoblast par son ID";
        break;

    case '/chocoblast/delete/id':
        echo "Supprimer un chocoblast par son ID";
        break;

    default:
        $errorController->error404();
        break;
}
