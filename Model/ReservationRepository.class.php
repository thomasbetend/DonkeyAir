<?php

class ReservationRepository
{   
    public static function getList( $id, $user_id, $price, $nb_passengers): array 
    {
        $sql = 'SELECT *
                FROM reservation
                WHERE 1';

        $params = [];

        if($id){
            $sql .= ' AND id = :id';
            $params[':id'] = $id; 
        }

        if($user_id){
            $sql .= ' AND user_id = :user_id';
            $params[':user_id'] = $user_id;  
        }

        if($price){
            $sql .= ' AND price = :price';
            $params[':price'] = $price;  
        }

        if($nb_passengers){
            $sql .= ' AND nb_passengers = :nb_passengers';
            $params[':nb_passengers'] = $nb_passengers;  
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