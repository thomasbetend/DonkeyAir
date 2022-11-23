<?php

use FlightRepository as GlobalFlightRepository;

class FlightRepository 
{   
    public static function getList(
        array $data = [
            "id" => '', 
            "around_date" => '',
            "precise_date" => '',
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

        if($data['around_date']){
            $min_date = date('Y-m-d', strtotime($data['around_date']. ' - 2 days'));
            $max_date = date('Y-m-d', strtotime($data['around_date']. ' + 2 days'));

            $sql .= ' AND departure_date BETWEEN :min_date AND :max_date';
            $params[':min_date'] = $min_date;  
            $params[':max_date'] = $max_date;  
        }

        if($data['precise_date']){
            $sql .= ' AND departure_date LIKE :precise_date';
            $params[':precise_date'] = $data['precise_date'];  
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
            $sql .= ' AND name LIKE :name';
            $params[':name'] = $data['name'];  
        }

    /*  $length = 20;
        $start = ($_GET["page"] - 1) * $length;
        $sql .= " LIMIT " . $start . ", " . $length; */

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare($sql);
        foreach($params as $key=>$param){
            if(($key === ":name") || ($key === ":precise_date")){
                $stmt->bindValue($key, "%" . $param . "%", PDO::PARAM_STR);
            } else {
                $stmt->bindValue($key, $param, PDO::PARAM_STR);
            }
        }
        $stmt->execute();

        $flights = [];
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $flights[] = Flight::createdFromSqlRow($row);
        }

        return $flights;
    }

}