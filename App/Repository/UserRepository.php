<?php

namespace App\Repository;

use App\Entity\EntityInterface;
use App\Repository\AbstractRepository;
use App\Entity\User;

class UserRepository extends AbstractRepository
{
    //constructeur
    public function __construct()
    {
        $this->setConnexion();
    }

    //ajouter un utilisateur
    public function saveUser(User $user): void
    {
        $request = "INSERT INTO users(firstname, lastname, email, pseudo, password, img_profile, grants, `status`)
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
    public function find(int $id): ?EntityInterface{
        $sql = "SELECT firstname, lastname, email, pseudo,password, img_profile, grants, `status` FROM users WHERE id = ?";
        $req = $this->connexion->prepare($sql);

        $req->bindValue(1,$id, \PDO::PARAM_INT);
        $req->execute();

        $user = $req->fetch(\PDO::FETCH_ASSOC);

        return new USER($user["firstname"], $user["lastname"], $user["email"], $user["password"]);
    }

    //afficher tous les utilisateurs
        public function findAll(): array{
        $sql = "SELECT firstname, lastname, email, pseudo,`password`, img_profile, grants, `status` FROM users";
        $req = $this->connexion->prepare($sql);

        $req->execute();

        $user = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $user;
    }
    //modifier un utilisateur


}
