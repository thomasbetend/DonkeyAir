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
    private string $name;

    public static function createdFromSqlRow (array $row): self
    {
        $flight = new self;
        if(!empty($row['idflight'])) $flight->id = $row['idflight'];
        if(!empty($row['departure_date'])) $flight->departure_date = DateTime::createFromFormat("Y-m-d H:i:s", $row['departure_date']);
        if(!empty($row['arrival_date'])) $flight->arrival_date = DateTime::createFromFormat("Y-m-d H:i:s", $row['arrival_date']);
        if(!empty($row['price'])) $flight->price = $row['price'];
        if(!empty($row['number_seats'])) $flight->number_seats = $row['number_seats'];
        if(!empty($row['departure_airport'])) $flight->departure_airport = $row['departure_airport'];
        if(!empty($row['arrival_airport'])) $flight->arrival_airport = $row['arrival_airport'];
        if(!empty($row['name'])) $flight->name = $row['name'];

        return $flight;
    }

    public function getDepartureDate(): string 
    {   
        return $this->departure_date->format("d/m/Y");
    }

    public function getArrivalDate(): string 
    {
        return $this->departure_date->format("d/m/Y");
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getPrice(): float 
    {
        return $this->price;
    }

    public function getNumberSeats(): int 
    {
        return $this->number_seats;
    }

    public function getDepartureAirport(): string 
    {
        return $this->departure_airport;
    }

    public function getArrivalAirport(): string 
    {
        return $this->arrival_airport;
    }

    public function getName(): string 
    {
        return $this->name;
    }

    /* function get flight duration : needs 2 getters */

    public function getDepartureDateTime(): DateTime
    {
        return $this->departure_date;
    }

    public function getArrivalDateTime(): DateTime
    {
        return $this->arrival_date;
    }
    
    public function getDuration(): string
    {
        $diff = $this->getDepartureDateTime()->diff($this->getArrivalDateTime());

        return $diff->format("%H:%I");
    }
}
