<?php

class FlightRepository 
{   
    public static function getList(
        array $data = [
            "id" => '', 
            "min_date" => '', 
            "max_date" => '', 
            "departure_airport_id" => '',
            "arrival_airport_id" => '',
            "price" => '',
            "nb_seats" => '',
            "name" => '',
        ]): array
    {
        $sql = 'SELECT *
                FROM flight f
                INNER JOIN departure_airport da ON f.departure_airport_id = da.id_departure_airport
                INNER JOIN arrival_airport aa ON f.arrival_airport_id = aa.id_arrival_airport
                WHERE 1';

        $params = [];

        if($data['id']){
            $sql .= ' AND id_flight = :id';
            $params[':id'] = $data['id']; 
        }

        if($data['min_date']){
            $sql .= ' AND departure_date > :min_date';
            $params[':min_date'] = $data['min_date'];  
        }

        if($data['max_date']){
            $sql .= ' AND arrival_date < :max_date';
            $params[':max_date'] = $data['max_date'];  
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