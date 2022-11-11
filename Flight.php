<?php

class Flight 
{
    private int $id;
    private DateTime $departure_date;
    private DateTime $arrival_date;
    private float $price;
    private int $number_seats;
    private string $departure_airport;
    private string $arrival_airport;


    public static function createdFromSqlRow (array $row): self
    {
        $flight = new self;
        $flight->id = $row['id'];
        $flight->departure_date = DateTime::createFromFormat("Y-m-d H-i-s", $row['departure_date']);
        $flight->arrival_date = DateTime::createFromFormat("Y-m-d H-i-s", $row['arrival_date']);
        $flight->price = $row['price'];
        $flight->number_seats = $row['number_seats'];
        $flight->departure_airport = $row['departure_airport'];
        $flight->arrival_airport = $row['arrival_airport'];

        return $flight;
    }

    public function getDepartureDate(): DateTime 
    {
        return $this->departure_date;
    }

    public function getArrivalDate(): DateTime 
    {
        return $this->departure_date;
    }

    public function getDuration(): string
    {
        $diff = $this->getDepartureDate()->diff($this->getArrivalDate());

        return $diff->format("%H:%i");
    }
}