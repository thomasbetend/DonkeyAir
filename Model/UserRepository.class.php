<?php

class UsersRepository 

{   
    public static function getList( $id, $firstname, $lastname, $email, $password, $nationality): array 
    {
        $sql = 'SELECT *
                FROM user
                WHERE 1';

        $params = [];

        if($id){
            $sql .= ' AND id = :id';
            $params[':id'] = $id; 
        }

        if($firstname){
            $sql .= ' AND firstname = :firstname';
            $params[':firstname'] = $firstname;  
        }

        if($lastname){
            $sql .= ' AND lastname = :lastname';
            $params[':lastname'] = $lastname;  
        }

        if($password){
            $sql .= ' AND password = :password';
            $params[':password'] = $password;  
        }

        if($nationality){
            $sql .= ' AND nationality = :nationality';
            $params[':nationality'] = $nationality;  
        }

        $pdo = Database::getConnexion();
        $stmt = $pdo->prepare($sql);
        foreach($params as $key=>$param){
            $stmt->bindValue($key, $param, PDO::PARAM_STR);
        }
        $stmt->execute();

        $users = [];
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $users[] = User::createdFromSqlRow($row);
        }

        return $users;
    }
}