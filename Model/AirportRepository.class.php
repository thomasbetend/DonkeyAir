<?php

class AirportRepository 
{       
    public static function getList(
        array $data = [
            "id" => '', 
            "airport_name" => '',
        ]): array 
    {
        $sql = 'SELECT *
                FROM airport
                WHERE 1';

        $params = [];

        if($data["id"]){
            $sql .= ' AND id_airport = :id';
            $params[':id'] = $data["id"]; 
        }

        if($data["airport_name"]){
            $sql .= ' AND airport_name = :airport_name';
            $params[':airport_name'] = $data["airport_name"];  
        }

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare($sql);
        foreach($params as $key=>$param){
            $stmt->bindValue($key, $param, PDO::PARAM_STR);
        }
        $stmt->execute();

        $airports = [];
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $airports[] = Airport::createdFromSqlRow($row);
        }

        return $airports;
    }
}