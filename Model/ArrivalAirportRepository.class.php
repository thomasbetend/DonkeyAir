<?php

class ArrivalAirportRepository 
{       
    public static function getList($id, $arrival_airport_name): array 
    {
        $sql = 'SELECT *
                FROM arrival_airport
                WHERE 1';

        $params = [];

        if($id){
            $sql .= ' AND id = :id';
            $params[':id'] = $id; 
        }

        if($arrival_airport_name){
            $sql .= ' AND arrival_airport_name = :arrival_airport_name';
            $params[':arrival_airport_name'] = $arrival_airport_name;  
        }

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare($sql);
        foreach($params as $key=>$param){
            $stmt->bindValue($key, $param, PDO::PARAM_STR);
        }
        $stmt->execute();

        $arrivalAirports = [];
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $arrivalAirports[] = ArrivalAirport::createdFromSqlRow($row);
        }

        return $arrivalAirports;
    }
}