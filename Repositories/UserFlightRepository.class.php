<?php

class UserFlightRepository 
{       
    public static function getList(
        array $data = [
            "id" => "", 
            "user_id" => "",
            "flight_id" => "",
            "insurance" => "",
            "id_reservation_flight" => "",
        ]): array 
    {
        $sql = 'SELECT *
                FROM user_flight uf
                JOIN flight f ON uf.flight_id = f.id_flight 
                JOIN reservation_flight rf ON rf.flight_id = f.id_flight
                WHERE 1';

        $params = [];

        if($data["id"]){
            $sql .= ' AND uf.id_user_flight = :id';
            $params[':id'] = $data["id"]; 
        }

        if($data["user_id"]){
            $sql .= ' AND uf.user_id = :user_id';
            $params[':user_id'] = $data["user_id"];  
        }

        if($data["flight_id"]){
            $sql .= ' AND uf.flight_id = :flight_id';
            $params[':flight_id'] = $data["flight_id"];  
        }

        if($data["insurance"]){
            $sql .= ' AND uf.insurance = :insurance';
            $params[':insurance'] = $data["insurance"];  
        }

        if($data["id_reservation_flight"]){
            $sql .= ' AND rf.id_reservation_flight = :id_reservation_flight';
            $params[':id_reservation_flight'] = $data["id_reservation_flight"];  
        }

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare($sql);
        foreach($params as $key=>$param){
            $stmt->bindValue($key, $param, PDO::PARAM_STR);
        }
        $stmt->execute();

        $userFlights = [];
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $userFlights[] = UserFlight::createdFromSqlRow($row);
        }

        return $userFlights;
    }
}