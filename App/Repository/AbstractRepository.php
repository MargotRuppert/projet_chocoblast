<?php

namespace App\Repository;

use App\Database\MySQL;
use App\Entity\EntityInterface;

abstract class AbstractRepository{
    protected \PDO $connexion;

    protected function setConnexion(){
        return $this->connexion = (new MySQL())->connectBDD();
    }
    /**
     * $param int $id Id de l'entité à rechercher
     */
    abstract public function find(int $id):?EntityInterface;
    /**
     * @return array<EntityInterface>
     */
    abstract public function findAll():array;
}