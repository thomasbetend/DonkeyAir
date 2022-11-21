<?php

class Reservation 
{
    private ?int $id;
    private ?int $user_id;
    private ?float $price;
    private ?DateTime $date;


    public static function createdFromSqlRow (array $row): self
    {
        $reservation = new self();
        $reservation->id = $row['id_reservation'];
        $reservation->user_id = $row['user_id'];
        $reservation->price = $row['price'];
        $reservation->date = DateTime::createFromFormat("Y-m-d H:i:s", $row['date']);

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

    public function getDDate(): string 
    {
        return $this->date->format("d/m/Y");
    }
}


