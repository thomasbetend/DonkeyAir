<?php

class User 
{
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $password;
    private int $id;

    public static function createdFromSqlRow(array $row): self
    {
        $user = new self;
        $user->id = $row['id'];
        $user->firstname = $row['firstname'];
        $user->lastname = $row['firstname'];
        $user->email = $row['email'];
        $user->password = $row['password'];

        return $user;
    }
}