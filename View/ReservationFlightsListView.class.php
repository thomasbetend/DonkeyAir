<?php

class ReservationFlightsListView
{
    public static function render($reservationFlights, $flight, $reservation): void {
        include('reservationflights.html.php');
    }
}