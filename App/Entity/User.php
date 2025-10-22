<?php

namespace App\Entity;

use App\Entity\EntityInterface;

class User implements EntityInterface
{
    //Attributs
    private ?int $id;
    private ?string $lastname;
    private ?string $firstname;
    private ?string $pseudo;
    private ?string $email;
    private ?string $password;
    private ?string $imgProfil;
    private ?array $grants;
    private ?bool $status;

    //constructeur
    public function __construct(
        ?string $firstname = null,
        ?string $lastname = null,
        ?string $email = null,
        ?string $password = null,
    ) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->pseudo = null;
        $this->imgProfil = null;
        $this->grants = [];
        $this->status = true;
        $this->id = null;
    }

    //Getters et Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): void
    {
        $this->firstname;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getImgProfil(): ?string
    {
        return $this->imgProfil;
    }

    public function setImgProfil(?string $imgProfil): void
    {
        $this->imgProfil = $imgProfil;
    }

    public function getGrants(): ?array
    {
        return $this->grants;
    }
    public function setGrants(?string $grants)
    {
        $grants = explode(',', $grants);
        $this->grants = $grants;
    }

    public function addGrant(?string $grant): void
    {
        $this->grants[] = $grant;
    }

    public function removeGrant(?string $grant): void
    {
        unset($this->grants[array_search($grant, $this->grants)]);
        sort($this->grants);
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): void
    {
        $this->status = $status;
    }

    //Méthodes
    /**
     * Méthode pour hasher le password
     * @return void
     */
    public function hashPassword(): void
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    /**
     * Méthode pour vérifier si le hash password est valide
     * @param string $plainPassword mot de passe en clair
     * @return bool true si valide false si invalide
     */
    public function verifPassword(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->password);
    }

    /**
     * Méthode pour hydrater un Objet User à partir d'un tableau de données
     * @param array $userData (tableau de données d'un User)
     * @return User retourne un Objet User
     */
    public static function hydrateUser(array $userData): User
    {
        $user = new User(
            $userData["firstname"],
            $userData["lastname"],
            $userData["email"],
            $userData["password"]
        );

        $user->setId($userData["id"]);
        $user->setPseudo($userData["pseudo"]);
        $user->setImgProfil($userData["imgProfil"]);
        if (gettype($userData["grants"]) === "string") {
            $userData["grants"] = explode(",", $userData["grants"]);
        }
        foreach ($userData["grants"] as $grant) {
            $user->addGrant($grant);
        }

        $user->setStatus($userData["status"]);

        return $user;
    }

    /**
     * Méthode pour convertir un Objet User en tableau de données
     * @return array retourne un tableau de données d'un User
     */
    public function toArray(): array
    {
        $userData =  [];
        //Create an array from the object properties
        foreach ($this as $key => $value) {
            $userData[$key] = $value;
        }
        return $userData;
    }
}
