<?php

class CartController
{

    public static function getList(){

        include("./View/cart.html.php");

        foreach($_SESSION['cart'] as $element){

            $flight = FlightRepository::getList([
                "id" => $element['flight'], 
                "around_date" => '',
                "precise_date" => '',
                "departure_airport_id" => '',
                "arrival_airport_id" => '',
                "price" => '',
                "nb_seats" => '',
                "name" => '',
            ]);

            FlightsListView::renderCart($flight, $element['price'], $element['nb_passengers']);

        }
    }

    public static function validate()
    {
            /* insert into table reservation */
        
            Database::insertReservation(
                [
                "user_id" => $_SESSION['id'],
                "price" => $_SESSION['cart_price_total'],
                "date" => date("Y-m-d"),
                ]
            );
        
            foreach($_SESSION['cart'] as $element){
        
            /* insert into table reservation_flight */
        
            $reservations = ReservationRepository::getList(
                [
                    "id" => '',
                    "user_id" => $_SESSION['id'], 
                    "price" => '',
                    "date" => '',
                    "page" => '',
                ]
            );
        
            $lastreservation = $reservations[0];
        
            Database::insertReservationFlight(
                [
                    "flight_id" => $element['flight'],
                    "reservation_id" => $lastreservation->getId(),
                    "price" => $element['price'],
                    "nb_passengers" => $element['nb_passengers'],
                ]
            );
        
            /* update table flight */
        
            $flightToUpdate = FlightRepository::getList([
                "id" => $element['flight'], 
                "around_date" => '',
                "precise_date" => '',
                "departure_airport_id" => '',
                "arrival_airport_id" => '',
                "price" => '',
                "nb_seats" => '',
                "name" => '',
            ]);
        
            Database::update(
                'flight',
                [
                    "nb_seats" => $flightToUpdate[0]->getNbSeats() - $element['nb_passengers'],
                ],
                $element['flight'],
                );
            }
        
            /* empty the cart */
        
            $_SESSION['cart'] = array();
            $_SESSION['cart_price_total'] = 0;
        
            header('location:/reservation-details/' . $lastreservation->getId());
            exit;
    }

    public static function delete($id)
    {

        Security::isloggedIn($_SESSION);

        foreach($_SESSION['cart'] as $key=>$element){
            if($element['flight'] === intval($id)){
                $_SESSION['cart_price_total'] -= $_SESSION['cart'][$key]['price'];
                unset($_SESSION['cart'][$key]);
            }
        }


        header('location:/panier');
        exit;
    }

}