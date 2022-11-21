<?php

class FlightsListView
{
    public static function render($flights): void 
    {
        include('flights.html.php');
    }

    public static function renderWithoutReservationButton($flights): void 
    {
        include('flights-without-reservation-button.html.php');
    }

    public static function renderCart($flights, $price, $nb_passengers): void 
    {
        include('flights-cart.html.php');
    }

    public static function renderPriceTotal($flights, $price, $nb_passengers): void 
    {
        include('flights-cart.html.php');
    }
}