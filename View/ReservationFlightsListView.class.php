<?php

class ReservationFlightsListView
{
    public static function render($flight, $searchDepartureAirport, $searchArrivalAirport, $reservationFlight): void {
        include('reservation-flights.html.php');
    }
}