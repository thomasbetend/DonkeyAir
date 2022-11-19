<?php

class ReservationFlight 
{
    private ?int $id;
    private ?int $flight_id;
    private ?string $reservation_id;

    public static function createdFromSqlRow (array $row): self
    {
        $reservationFlight = new self();
        $reservationFlight->id = $row['id_reservation_flight'];
        $reservationFlight->flight_id = $row['flight_id'];
        $reservationFlight->reservation_id = $row['reservation_id'];

        return $reservationFlight;
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getFlightId(): int 
    {
        return $this->flight_id;
    }

    public function getReservationId(): int 
    {
        return $this->reservation_id;
    }
}


