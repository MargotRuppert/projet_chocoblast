<?php

namespace App\Repository;

use App\Database\MariaDB;
use App\Entity\Entity;

abstract class AbstractRepository
{
    //Attribut pour la connexion
    protected \PDO $connexion;

    //Initialisation de la connexion à la BDD
    protected function setConnexion(): void
    {
        $this->connexion = (new MariaDB())->connectBdd();
    }

    /**
     * Méthode pour trouver une entité par son id
     * @param int $id Id de l'entité à rechercher
     * @return Entity|null
     */
    abstract public function find(int $id):?Entity;
    
    /**
     * Méthode pour trouver toutes les entités
     * @return array<Entity>
     */
    abstract public function findAll():array;
}
