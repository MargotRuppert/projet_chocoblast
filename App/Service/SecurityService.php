<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\Entity\User;

class SecurityService
{
    private readonly UserRepository $userRepository;
    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    public function addUser(array $post): string
    {        //verifier si les champs sont vides
        if (empty($post["firstname"]) || empty($post["lastname"]) || empty($post["email"]) || empty($post["password"])) {
            return "Veuillez remplir les quatre champs.";
        }
        //verifier le format des données
        if (!filter_var($post["email"], FILTER_VALIDATE_EMAIL)) {
            return "L'email n'est pas valide";
        }

        //verifier si le compte existe déjà ou non
        if ($this->userRepository->ifUserExists($post["email"])) {
            return "l'email n'est pas utilisable";
        }

        //sanitize les données
        function sanitize(string $value): string
        {
            return htmlspecialchars(strip_tags(trim($value)), ENT_NOQUOTES);
        }

        //hasher le mdp
        $post["password"] = password_hash($post["password"], PASSWORD_DEFAULT);

        $post["id"] = null;
        $post["imgProfil"] = "default.png";
        $post["pseudo"] = null;
        $post["grants"] = "ROLE_USER";
        $post["status"] = 1;

        $user = new User();
        //ajout en BDD
        $this->userRepository->saveUser($user->hydrateUser($post));

        return "Utilisateur bien ajouté à la BDD";
    }

    public function connexion() {}

    public function deconnexion() {}
}