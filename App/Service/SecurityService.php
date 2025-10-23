<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\Entity\User;

class SecurityService
{
    private readonly UserRepository $userRepository;
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    //logique métier add user
    public function addUser(): string{
        //verifier si les champs sont vides
            if (empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || empty($_POST["password"])) {
                return "Veuillez remplir les quatre champs.";
            }
            //verifier le format des données
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                return "L'email n'est pas valide";
            }

            //verifier si le compte existe déjà ou non
            if ($this->userRepository->ifUserExists($_POST["email"])) {
                return "l'email n'est pas utilisable";
            }

            //sanitize les données
            function sanitize(string $value): string
            {
                return htmlspecialchars(strip_tags(trim($value)), ENT_NOQUOTES);
            }

            //hasher le mdp
            $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);

            $user = new User($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"]);
            //ajout en BDD
            $this->userRepository->saveUser($user);
            return "Utilisateur bien ajouté en BDD";

    }

    //logique métier connexion
    public function connexion(){

    }

    //logique métier deconnexion
    public function deconnexion(){

    }
}
