<?php

class UserFlightRepository 
{       
    public static function getList(
        array $data = [
            "id" => "", 
            "user_id" => "",
            "flight_id" => "",
            "insurance" => "",
        ]): array 
    {
        $sql = 'SELECT *
                FROM user_flight uf
                /* INNER JOIN reservation r ON rf.reservation_id = r.id_reservation
                INNER JOIN flight f ON rf.flight_id = f.id_flight */
                WHERE 1';

        $params = [];

        if($data["id"]){
            $sql .= ' AND id_user_flight = :id';
            $params[':id'] = $data["id"]; 
        }

        if($data["user_id"]){
            $sql .= ' AND user_id = :user_id';
            $params[':user_id'] = $data["user_id"];  
        }

        if($data["flight_id"]){
            $sql .= ' AND flight_id = :flight_id';
            $params[':flight_id'] = $data["flight_id"];  
        }

        if($data["insurance"]){
            $sql .= ' AND insurance = :insurance';
            $params[':insurance'] = $data["insurance"];  
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