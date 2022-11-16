<?php

use Database as GlobalDatabase;

define ('ENV', 'prod');

class DataBase 
{
    public static function getConnexion()
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

    public static function insert(string $table, array $data): void
    {
        $cols = implode(", ", array_keys($data));
        $values = implode(", ", array_values($data));

        $sql = "INSERT INTO " . $table . " (" . $cols . ") VALUES (". $values . ")";

        $stmt = (Database::getConnexion())->prepare($sql);
        $stmt -> execute();
    }

    public static function update(string $table, $data, $id): void 
    {   
        foreach($data as $key=>$values){
            if($values){
                $newData[] = $key . " = '" . $values . "'";
            }
        }
        $cols = implode(", ", $newData);

        $sql = "UPDATE " . $table . " " . $cols . " WHERE id = :id";

        $stmt = (Database::getConnexion())->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
