<?php

class Reservation 
{
    private ?int $id;
    private ?int $user_id;
    private ?float $price;
    private ?int $nb_passengers;

    public static function createdFromSqlRow (array $row): self
    {
        $reservation = new self();
        $reservation->id = $row['idreservation'];
        $reservation->user_id = $row['user_id'];
        $reservation->price = $row['price'];
        $reservation->nb_passengers = $row['nb_passengers'];

        return $reservation;
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getUserId(): int 
    {
        return $this->user_id;
    }

    public function getPrice(): float 
    {
        return $this->price;
    }

    public function getNbPassengers(): int 
    {
        return $this->nb_passengers;
    }
}


