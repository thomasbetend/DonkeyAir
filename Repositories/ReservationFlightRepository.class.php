<?php

class ReservationFlightRepository 
{       
    public static function getList(
        array $data = [
            "id" => "", 
            "flight_id" => "",
            "reservation_id" => "",
            "nb_passengers" => "",
            "price" => "",

        ]): array 
    {
        $sql = 'SELECT *
                FROM reservation_flight rf
                /* INNER JOIN reservation r ON rf.reservation_id = r.id_reservation
                INNER JOIN flight f ON rf.flight_id = f.id_flight */
                WHERE 1';

        $params = [];

        if($data["id"]){
            $sql .= ' AND id_reservation_flight = :id';
            $params[':id'] = $data["id"]; 
        }

        if($data["flight_id"]){
            $sql .= ' AND flight_id = :flight_id';
            $params[':flight_id'] = $data["flight_id"];  
        }

        if($data["reservation_id"]){
            $sql .= ' AND reservation_id = :reservation_id';
            $params[':reservation_id'] = $data["reservation_id"];  
        }

        if($data["nb_passengers"]){
            $sql .= ' AND nb_passengers = :nb_passengers';
            $params[':nb_passengers'] = $data["nb_passengers"];  
        }

        if($data["price"]){
            $sql .= ' AND reservation_flight.price = :price';
            $params[':price'] = $data["price"];  
        }
        
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare($sql);
        foreach($params as $key=>$param){
            $stmt->bindValue($key, $param, PDO::PARAM_STR);
        }
        $stmt->execute();

        $reservationFlights = [];
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $reservationFlights[] = ReservationFlight::createdFromSqlRow($row);
        }

        return $reservationFlights;
    }
}