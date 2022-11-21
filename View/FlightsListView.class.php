<?php

class FlightsListView
{
    public static function render($flights): void {
        include('flights.html.php');
    }

    public static function renderWithoutReservationButton($flights): void {
        include('flightsWithoutReservationButton.html.php');
    }

    public static function renderCart($flights, $price, $nb_passengers): void {
        include('flightsCart.html.php');
    }
}