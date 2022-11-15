<?php

require('User.class.php');
require('Connexion.class.php');

class UsersList 
{       
    public function __construct(public string $sql)
    {
    }

    public function getList(): array {

        $pdo = Connexion::getDataBase();
        $stmt = $pdo->prepare($this->sql);
        $stmt->execute();

        $users = [];

        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $users[] = User::createdFromSqlRow($row);
        }

        return $users;
    }
}