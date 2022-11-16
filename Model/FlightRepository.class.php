<?php

class FlightRepository 
{   
    public static function getList( $id, $departure_date, $arrival_date, $departure_airport_id, $arrival_airport_id, $price, $number_seats, $name): array 
    {
        $sql = 'SELECT *
                FROM flight f
                INNER JOIN departure_airport da ON f.departure_airport_id = da.id
                INNER JOIN arrival_airport aa ON f.arrival_airport_id = aa.id
                WHERE 1';

        $params = [];

        if($id){
            $sql .= ' AND id = :id';
            $params[':id'] = $id; 
        }

        if($departure_date){
            $sql .= ' AND departure_date = :departure_date';
            $params[':departure_date'] = $departure_date;  
        }

        if($arrival_date){
            $sql .= ' AND arrival_date = :arrival_date';
            $params[':arrival_date'] = $arrival_date;  
        }

        if($price){
            $sql .= ' AND price = :price';
            $params[':price'] = $price;  
        }

        if($number_seats){
            $sql .= ' AND number_seats = :number_seats';
            $params[':number_seats'] = $number_seats;  
        }

        if($departure_airport_id){
            $sql .= ' AND departure_airport_id = :departure_airport_id';
            $params[':departure_airport_id'] = $departure_airport_id;  
        }
        
        if($arrival_airport_id){
            $sql .= ' AND arrival_airport_id = :arrival_airport_id';
            $params[':arrival_airport_id'] = $arrival_airport_id;  
        }

        if($name){
            $sql .= ' AND name = :name';
            $params[':name'] = $name;  
        }

        $pdo = Database::getConnexion();
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