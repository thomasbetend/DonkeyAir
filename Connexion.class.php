<?php

define ('ENV', 'prod');

class Connexion 
{
    public static function getDataBase()
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
}
