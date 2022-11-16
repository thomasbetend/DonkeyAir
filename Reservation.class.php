<?php

class Reservation
{
    private int $id;
    private float $price;
    private int $nb_passengers;

    public static function createdFromSqlRow (array $row): self
    {
        $reservation = new self;
        if(!empty($row['idreservations'])) $reservation->id = $row['idreservations'];
        if(!empty($row['price'])) $reservation->price = $row['price'];
        if(!empty($row['nb_passengers'])) $reservation->nb_passengers = $row['nb_passengers'];

        return $reservation;
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getNb_passengers(): int
    {
        return $this->nb_passengers;
    }

}