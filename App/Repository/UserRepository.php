<?php

namespace App\Repository;

use App\Database\MySQL;
use App\Entity\User;

class UserRepository
{
    private \PDO $connexion;

    //constructeur
    public function __construct()
    {
        $this->connexion = (new MySQL())->connectBdd();
    }

    //ajouter un utilisateur
    public function saveUser(User $user): void
    {
        $request = "INSERT INTO users(firstname, lastname, email, pseudo, `password`, img_profil, grants, `status`)
        VALUE(?,?,?,?,?,?,?,?)";

        $req = $this->connexion->prepare($request);

        $req->bindValue(1, $user->getFirstname(), \PDO::PARAM_STR);
        $req->bindValue(2, $user->getLastname(), \PDO::PARAM_STR);
        $req->bindValue(3, $user->getEmail(), \PDO::PARAM_STR);
        $req->bindValue(4, $user->getPseudo(), \PDO::PARAM_STR);
        $req->bindValue(5, $user->getPassword(), \PDO::PARAM_STR);
        $req->bindValue(6, $user->getImgProfil(), \PDO::PARAM_STR);
        $req->bindValue(7, implode(",", $user->getGrants()), \PDO::PARAM_STR);
        $req->bindValue(8, $user->getStatus(), \PDO::PARAM_BOOL);
    
        $req->execute();
    
    }
    //afficher un utilisateur

    //afficher tous les utilisateurs

    //modifier un utilisateur


}
