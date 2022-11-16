<?php

class DepartureAirportRepository 
{       
    public static function getList( $id, $departure_airport_name): array 
    {
        $sql = 'SELECT *
                FROM departure_airport
                WHERE 1';

        $params = [];

        if($id){
            $sql .= ' AND id = :id';
            $params[':id'] = $id; 
        }

        if($departure_airport_name){
            $sql .= ' AND departure_airport_name = :departure_airport_name';
            $params[':departure_airport_name'] = $departure_airport_name;  
        }

        $pdo = Database::getConnexion();
        $stmt = $pdo->prepare($sql);
        foreach($params as $key=>$param){
            $stmt->bindValue($key, $param, PDO::PARAM_STR);
        }
        $stmt->execute();

        $departureAirports = [];
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $departureAirports[] = DepartureAirport::createdFromSqlRow($row);
        }

        return $departureAirports;
    }
}