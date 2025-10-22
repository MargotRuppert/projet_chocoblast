<?php 

namespace App\Entity;

class User{
    private int $id;
    private string $firstname;
    private string $lastname;
    private ?string $pseudo;
    private string $email;
    private string $password;
    private ?string $imgProfil;
    private ?array $grants;
    private ?bool $status;

    //constructor
    public function __construct(string $firstname, string $lastname, string $email, string $password)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
    }

    //getters and setters
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
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

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
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

    public function setGrants(?array $grants): void
    {
        $this->grants = $grants;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): void
    {
        $this->status = $status;
    }

    //methodes
    public function hashPassword():void
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function verifPassword(string $plainPassword): bool 
    {
        return password_verify($plainPassword, $this->password);
    }

}