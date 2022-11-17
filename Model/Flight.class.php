<?php

class Flight 
{
    private ?int $id;
    private ?DateTime $departure_date;
    private ?DateTime $arrival_date;
    private ?int $departure_airport_id;
    private ?int $arrival_airport_id;
    private ?float $price;
    private ?int $number_seats;
    private ?string $name;

    public function __construct()
    {

    }

    public static function createdFromSqlRow (array $row): self
    {
        $flight = new self();
        $flight->id = $row['id'];
        $flight->departure_date = DateTime::createFromFormat("Y-m-d H:i:s", $row['departure_date']);
        $flight->arrival_date = DateTime::createFromFormat("Y-m-d H:i:s", $row['arrival_date']);
        $flight->departure_airport_id = $row['departure_airport_id'];
        $flight->arrival_airport_id = $row['arrival_airport_id'];
        $flight->price = $row['price'];
        $flight->number_seats = $row['number_seats'];
        $flight->name = $row['name'];

        return $flight;
    }

    public function getDepartureDate(): string 
    {   
        return $this->departure_date->format("d/m/Y");
    }

    public function getDepartureHour(): string
    {   
        return $this->departure_date->format("H:i");
    }

    public function getArrivalDate(): string 
    {
        return $this->arrival_date->format("d/m/Y");
    }

    public function getArrivalHour(): string 
    {
        return $this->arrival_date->format("H:i");
    }

    /*  ------  */

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

    /*  ------  */

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

    public function getDepartureAirportId(): int 
    {
        return $this->departure_airport_id;
    }

    public function getArrivalAirportId(): int 
    {
        return $this->arrival_airport_id;
    }

    public function getName(): string 
    {
        return $this->name;
    }

    public function toSqlArray(): array
    {
        return [
            'id' => $this->id,
            'departure_date' => $this->departure_date->format("Y-m-d H:i:s"),
            'arrival_date' => $this->arrival_date->format("Y-m-d H:i:s"),
            'price' => $this->price,
            'number_seats' => $this->number_seats,
            'departure_airport_id' => $this->departure_airport_id,
            'arrival_airport_id' => $this->arrival_airport_id,
            'name' => $this->name,
        ];
    }

}


