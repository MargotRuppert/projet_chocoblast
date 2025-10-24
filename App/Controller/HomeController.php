<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Repository\UserRepository;
use App\DTO\TestDTO;
use App\DTO\TestDTOWrapper;

class HomeController extends AbstractController
{
    //Import du repository utilisateur
    private UserRepository $userRepository;

    public function __construct()
    {
        //Initialisation du repository utilisateur
        $this->userRepository = new UserRepository();
    }

    /* 
    //Exemple utilisation d'un DTO
    public function index() {
        $user = $this->userRepository->findV2(1);
        $dto = TestDTOWrapper::wrappUserToTestDTO($user);
        dd($user, $dto);
        $this->render("home", "vide");
    } */

    /**
     * Méthode pour afficher la page d'accueil
     * @return void affiche la page d'accueil
     */
    public function index() 
    {
        $this->render("home", "vide");
    }

    /**
     * Méthode de test d'authentification
     * @return void affiche la page de test
     */
    public function test()
    {
        $this->render("test", "test");
    }

        public function showCgu()
    {
        $this->render("cgu", "cgu");
    }
}
