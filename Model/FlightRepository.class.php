<?php

class FlightRepository 
{   
    public static function getList(
        $data = [
            "id" => '', 
            "departure_date" => '', 
            "arrival_date" => '', 
            "departure_airport_id" => '',
            "arrival_airport_id" => '',
            "price" => '',
            "nb_seats" => '',
            "name" => '',
        ]): array
    {
        $sql = 'SELECT *
                FROM flight f
                INNER JOIN departure_airport da ON f.departure_airport_id = da.id
                INNER JOIN arrival_airport aa ON f.arrival_airport_id = aa.id
                WHERE 1';

        $params = [];

        if($data['id']){
            $sql .= ' AND id = :id';
            $params[':id'] = $data['id']; 
        }

        if($data['departure_date']){
            $sql .= ' AND departure_date = :departure_date';
            $params[':departure_date'] = $data['departure_date'];  
        }

        if($data['arrival_date']){
            $sql .= ' AND arrival_date = :arrival_date';
            $params[':arrival_date'] = $data['arrival_date'];  
        }

        if($data['price']){
            $sql .= ' AND price = :price';
            $params[':price'] = $data['price'];  
        }

        if($data['nb_seats']){
            $sql .= ' AND nb_seats = :nb_seats';
            $params[':nb_seats'] = $data['nb_seats'];  
        }

        if($data['departure_airport_id']){
            $sql .= ' AND departure_airport_id = :departure_airport_id';
            $params[':departure_airport_id'] = $data['departure_airport_id'];  
        }
        
        if($data['arrival_airport_id']){
            $sql .= ' AND arrival_airport_id = :arrival_airport_id';
            $params[':arrival_airport_id'] = $data['arrival_airport_id'];  
        }

        if($data['name']){
            $sql .= ' AND name = :name';
            $params[':name'] = $data['name'];  
        }

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare($sql);
        foreach($params as $key=>$param){
            $stmt->bindValue($key, $param, PDO::PARAM_STR);
        }
        $stmt->execute();

        $flights = [];
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $flights[] = Flight::createdFromSqlRow($row);
        }

        return $flights;
    }
}