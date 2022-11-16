<?php

class User 
{
    private ?int $id;
    private ?string $firstname;
    private ?string $lastname;
    private ?string $email;
    private ?string $password;
    private ?string $nationality;

    public static function createdFromSqlRow (array $row): self
    {
        $user = new self();
        $user->id = $row['iduser'];
        $user->firstname = $row['firstname'];
        $user->lastname = $row['lastname'];
        $user->email = $row['email'];
        $user->password = $row['password'];
        $user->nationality = $row['nationality'];

        return $user;
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getFirstname(): string 
    {
        return $this->firstname;
    }

    public function getLastname(): string 
    {
        return $this->lastname;
    }

    public function getEmail(): string 
    {
        return $this->email;
    }

    public function getPassword(): string 
    {
        return $this->password;
    }

    public function getNationality(): string 
    {
        return $this->nationality;
    }
}


