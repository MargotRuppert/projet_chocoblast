<?php

namespace App\Repository;

use App\Database\MySQL;
use App\Entity\EntityInterface;

abstract class AbstractRepository
{
    //Attributs pour la connexion
    protected \PDO $connexion;

    //Initialisation de la connexion à la BDD
    protected function setConnexion(): void
    {
        $this->connexion = (new MySQL())->connectBdd();
    }

    /**
     * @param int $id Id de l'entité à rechercher
     * @return Entity|null
     */
    abstract public function find(int $id): ?EntityInterface;

    /**
     * @return array<Entity>
     */
    abstract public function findAll(): array;
}
