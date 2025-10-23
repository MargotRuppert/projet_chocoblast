<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Service\SecurityService;


class SecurityController extends AbstractController
{
    private readonly SecurityService $securityService;

    public function __construct()
    {
        $this->securityService = new SecurityService();
    }

    //Méthode login
    public function login()
    {
        $this->securityService->connexion();
        $this->render('', '');
    }

    //Méthode logout
    public function logout() {}

    //Méthode  register
    public function register()
    {
        $data = [];
        if ($this->formSubmit($_POST)) {
            $data["message"] = $this->securityService->addUser($_POST);
            unset($_POST);
        }
        $this->render('register', '', $data);
    }
}