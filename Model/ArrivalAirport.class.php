<?php

class ArrivalAirport 
{
    private ?int $id;
    private ?string $arrival_airport_name;

    public static function createdFromSqlRow (array $row): self
    {
        $arrivalAirport = new self();
        $arrivalAirport->id = $row['id_arrival_airport'];
        $arrivalAirport->arrival_airport_name = $row['arrival_airport_name'];

        return $arrivalAirport;
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getName(): string 
    {
        return $this->arrival_airport_name;
    }
}


