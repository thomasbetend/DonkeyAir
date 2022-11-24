<?php
Database::getConnection();
use Database as GlobalDatabase;

define ('ENV', 'test');

class DataBase 
{
    public static function getConnection()
    {   
        $db = 'mysql:host=localhost; dbname=donkey_air';
        $userDB = 'root';
        $passDB = '';
        
        try {
            $pdo = new PDO($db, $userDB, $passDB);
        } 
        catch (PDOException $pe){
            if(ENV === 'test'){
                echo $pe->getMessage();
            } else {
                header('error.php');
            }
        }

        return $pdo;
    }

    public static function bind(string $sql, array $data):void 
    {
        $stmt = (Database::getConnection())->prepare($sql);
        foreach($data as $key=>$param){
            $stmt->bindValue($key, $param, PDO::PARAM_STR);
        }
        $stmt -> execute();
    }

    public static function insertReservation(
        array $data = [
            "user_id" => "",
            "price" => "",
            "date" =>"",
        ]): void
    {
        $cols = implode(", ", array_keys($data));

        $sql = "INSERT INTO reservation (" . $cols . ") VALUES (:user_id, :price, :date)";

        Database::bind($sql, $data);
    }

    public static function insertReservationFlight(
        array $data = [
            "flight_id" => "",
            "reservation_id" => "",
            "nb_passengers" => "",
            "price" => "",
        ]): void
    {
        $cols = implode(", ", array_keys($data));

        $sql = "INSERT INTO reservation_flight (" . $cols . ") VALUES (:flight_id, :reservation_id, :price, :nb_passengers)";

        Database::bind($sql, $data);
    }

    public static function insertUser(
        array $data = [
            "firstname" => "",
            "lastname" => "",
            "email" => "",
            "password" => "",
        ]): void
    {
        $cols = implode(", ", array_keys($data));

        $sql = "INSERT INTO user (" . $cols . ") VALUES (:firstname, :lastname, :email, :password)";

        Database::bind($sql, $data);
    }

    public static function insertFlight(
        array $data = [
            "departure_date" => "", 
            "arrival_date" => "", 
            "departure_airport_id" => "",
            "arrival_airport_id" => "",
            "price" => "",
            "nb_seats" => "",
            "name" => "",
        ]): void
    {
        $cols = implode(", ", array_keys($data));

        $sql = "INSERT INTO flight (" . $cols . ") VALUES (:departure_date, :arrival_date, :departure_airport_id, :arrival_airport_id, :price, :nb_seats, :name)";

        Database::bind($sql, $data);
    }

    public static function insertUserFlight(
        array $data = [
            "user_id" => "", 
            "flight_id" => "", 
            "insurance" => "",
        ]): void
    {
        $cols = implode(", ", array_keys($data));

        $sql = "INSERT INTO user_flight (" . $cols . ") VALUES (:user_id, :flight_id, :insurance)";

        $stmt = (Database::getConnection())->prepare($sql);
        foreach($data as $key=>$param){
            if($key === "insurance"){
                $stmt->bindValue($key, $param, PDO::PARAM_BOOL);
            } else {
                $stmt->bindValue($key, $param, PDO::PARAM_INT);
            }
        }
        $stmt -> execute();
    }

    public static function update(string $table, array $data, int $id): void 
    {   
        foreach($data as $key=>$values){
            if(is_null($values)){
                $newData[] = $key . " = ' ' ";
            } else {
                $newData[] = $key . " = '" . $values . "'";
            }
        }
        $cols = implode(", ", $newData);

        $sql = "UPDATE " . $table . " SET " . $cols . " WHERE id_" . $table . "= :id";

        $stmt = (Database::getConnection())->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
