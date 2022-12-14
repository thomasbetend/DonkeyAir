<?php

class UserFlight 
{
    private ?int $id;
    private ?int $user_id;
    private ?int $flight_id;
    private ?bool $insurance;
    private ?int $id_reservation_flight;

    public static function createdFromSqlRow (array $row): self
    {
        $userFlight = new self();
        $userFlight->id = $row['id_user_flight'];
        $userFlight->user_id = $row['user_id'];
        $userFlight->flight_id = $row['flight_id'];
        $userFlight->insurance = $row['insurance'];
        $userFlight->id_reservation_flight = $row['id_reservation_flight'];

        return $userFlight;
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getUserId(): int 
    {
        return $this->user_id;
    }

    public function getFlightId(): int 
    {
        return $this->flight_id;
    }

    public function getInsurance(): bool 
    {
        return $this->insurance;
    }

    public function getIdReservationFlight(): int
    {
        return $this->id_reservation_flight;
    }

}


