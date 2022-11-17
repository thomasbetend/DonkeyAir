<?php

class ReservationRepository
{   
    public static function getList(
        array $data = [
            "id" => '', 
            "user_id" => '', 
            "price" => '', 
            "nb_passengers" => '',
        ]): array 
    {
        $sql = 'SELECT *
                FROM reservation r
                INNER JOIN user ON r.user_id=user.id_user
                WHERE 1';

        $params = [];

        if($data["id"]){
            $sql .= ' AND id_reservation = :id';
            $params[':id'] = $data["id"]; 
        }

        if($data["user_id"]){
            $sql .= ' AND user_id = :user_id';
            $params[':user_id'] = $data["user_id"];  
        }

        if($data["price"]){
            $sql .= ' AND price = :price';
            $params[':price'] = $data["price"];  
        }

        if($data["nb_passengers"]){
            $sql .= ' AND nb_passengers = :nb_passengers';
            $params[':nb_passengers'] = $data["nb_passengers"];  
        }

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare($sql);
        foreach($params as $key=>$param){
            $stmt->bindValue($key, $param, PDO::PARAM_STR);
        }
        $stmt->execute();

        $reservations = [];
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $reservations[] = Reservation::createdFromSqlRow($row);
        }

        return $reservations;
    }
}