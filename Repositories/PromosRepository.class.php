<?php

class PromosRepository
{
    public static function getListByArrivalAirportId($id): array

    {
        $sql = 'SELECT *
            FROM flight f
            INNER JOIN departure_airport da ON f.departure_airport_id = da.id_departure_airport
            INNER JOIN arrival_airport aa ON f.arrival_airport_id = aa.id_arrival_airport
            WHERE arrival_airport_id = :arrival_airport_id';

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':arrival_airport_id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $flights = [];
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $flights[] = Flight::createdFromSqlRow($row);
        }

        return $flights;
    }
}