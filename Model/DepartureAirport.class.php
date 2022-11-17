<?php

class DepartureAirport 
{
    private ?int $id;
    private ?string $departure_airport_name;

    public static function createdFromSqlRow (array $row): self
    {
        $departureAirport = new self();
        $departureAirport->id = $row['id_departure_airport'];
        $departureAirport->departure_airport_name = $row['departure_airport_name'];

        return $departureAirport;
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getName(): string 
    {
        return $this->departure_airport_name;
    }
}


