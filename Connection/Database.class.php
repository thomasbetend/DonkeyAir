<?php

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

    public static function insertReservation(
        string $table, 
        array $data = [
            "user_id" => "",
            "price" => "",
            "nb_passengers" =>"",
        ]): void
    {
        $cols = implode(", ", array_keys($data));

        $sql = "INSERT INTO " . $table . " (" . $cols . ") VALUES (:user_id, :price, :nb_passengers)";

        $stmt = (Database::getConnection())->prepare($sql);
        foreach($data as $key=>$param){
            $stmt->bindValue($key, $param, PDO::PARAM_STR);
        }
        $stmt -> execute();
    }

    public static function insertUser(
        string $table, 
        array $data = [
            "firstname" => "",
            "lastname" => "",
            "email" => "",
            "password" => "",
        ]): void
    {
        $cols = implode(", ", array_keys($data));

        $sql = "INSERT INTO " . $table . " (" . $cols . ") VALUES (:user_id, :price)";

        $stmt = (Database::getConnection())->prepare($sql);
        foreach($data as $key=>$param){
            $stmt->bindValue($key, $param, PDO::PARAM_STR);
        }
        $stmt -> execute();
    }

    public static function update(string $table, array $data, int $id): void 
    {   
        foreach($data as $key=>$values){
            if($values){
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
