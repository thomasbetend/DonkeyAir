<?php

class UserRepository 

{   
    public static function getList(
        array $data = [
            "id" => '', 
            "firstname" => '', 
            "lastname" => '', 
            "email" => '',
            "password" => '',
            "nationality" => '',
        ]): array 
    {
        $sql = 'SELECT *
                FROM user
                WHERE 1';

        $params = [];

        if($data['id']){
            $sql .= ' AND id_user = :id';
            $params[':id'] = $data['id']; 
        }

        if($data['firstname']){
            $sql .= ' AND firstname = :firstname';
            $params[':firstname'] = $data['firstname'];  
        }

        if($data['lastname']){
            $sql .= ' AND lastname = :lastname';
            $params[':lastname'] = $data['lastname'];  
        }

        if($data['email']){
            $sql .= ' AND email = :email';
            $params[':email'] = $data['email'];  
        }

        if($data['password']){
            $sql .= ' AND password = :password';
            $params[':password'] = $data['password'];  
        }

        if($data['nationality']){
            $sql .= ' AND nationality = :nationality';
            $params[':nationality'] = $data['nationality'];  
        }

        $pdo = Database::getConnection();
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