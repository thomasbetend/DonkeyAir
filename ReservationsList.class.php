<?php

require('Reservation.class.php');
require('Connexion.class.php');

class ReservationsList
{
    public function __construct(public string $sql)
    {
    }

    public function getList(): array {

        $pdo = Connexion::getDataBase();
        $stmt = $pdo->prepare($this->sql);
        $stmt->execute();

        $reservations = [];

        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $reservations[] = User::createdFromSqlRow($row);
        }

        return $reservations;
    }
}
