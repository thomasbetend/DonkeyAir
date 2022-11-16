<?php

class FlightsList 
{       
    public function __construct(public string $sql)
    {
    }

    public function getList(): array {

        $pdo = Connexion::getDataBase();
        $stmt = $pdo->prepare($this->sql);
        $stmt->execute();

        $flights = [];

        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $flights[] = Flight::createdFromSqlRow($row);
        }

        return $flights;
    }
}