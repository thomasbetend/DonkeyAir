<?php

class ReservationFlightsListView
{
    public static function render($flight, $searchDepartureAirport, $searchArrivalAirport, $reservationFlight, $userFlight): void {
        include('reservation-flights.html.php');
    }
}