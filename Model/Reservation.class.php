<?php

class Reservation 
{
    private int $id;
    private int $user_id;
    private float $price;

    public static function createdFromSqlRow (array $row) : self
    {
        $reservation = new self;
        $reservation->id = $row['id'];
        $reservation->user_id = $row['user_id'];
        $reservation->price = $row['price'];

        return $reservation;
    }
}