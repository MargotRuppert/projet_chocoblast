<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Repository\UserRepository;
use App\Entity\User;

class SignInController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    public function signIn()
    {
        $this->render("sign_In", "Sign In", []);
    }

    //ajout formulaire en post

    public function addUser()
    {
        if (isset($_POST["ajouter"])) {

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
            // dd($user);
            //ajout en BDD
            $this->userRepository->saveUser($user);

            return "Utilisateur bien ajouté à la BDD";
        }
    }
}
