<?php

class User 
{
    private int $id;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $password;
    private string $nationality;

    public static function createdFromSqlRow (array $row): self
    {
        $user = new self;
        if(!empty($row['iduser'])) $user->id = $row['iduser'];
        if(!empty($row['firstname'])) $user->firstname = $row['firstname'];
        if(!empty($row['lastname'])) $user->lastname = $row['lastname'];
        if(!empty($row['email'])) $user->email = $row['email'];
        if(!empty($row['password'])) $user->password = $row['password'];
        if(!empty($row['nationality'])) $user->nationality = $row['nationality'];

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


