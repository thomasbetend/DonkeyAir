<?php

class ReservationsController
{
    public static function getList($id): void
    {
        Security::isloggedIn($_SESSION);
        
        $searchReservationsTotal= ReservationRepository::getList(
            [
                "id" => '', 
                "user_id" => $_SESSION['id'], 
                "price" => '', 
                "date" => '',
                "page" => '',
            ]
        );

        include("./View/reservation-personal-space.html.php");


        $searchReservations= ReservationRepository::getList(
            [
                "id" => '', 
                "user_id" => $_SESSION['id'], 
                "price" => '', 
                "date" => '',
                "page" => $id,
            ]
        );

        ReservationsListView::render($searchReservations);

        ?> 
        </div>
        <?php

    }

    public static function getValidation($id): void 

    {

        $searchFlight = FlightRepository::getList(
            [
                "id" => $id, 
                "around_date" => '',
                "precise_date" => '', 
                "departure_airport_id" => '',
                "arrival_airport_id" => '',
                "price" => '',
                "nb_seats" => '',
                "name" => '',
            ]
        );

        Security::impossibleReservation($_SESSION);

        /* no more places on this flight */

        ErrorRepository::noMoreSeats($searchFlight[0]);

        /* --------- */

        $searchDepartureAirport = AirportRepository::getList(
            [
            "id" => $searchFlight[0]->getDepartureAirportId(), 
            "airport_name" => '',
            ]
        );
        $searchArrivalAirport = AirportRepository::getList(
            [
            "id" => $searchFlight[0]->getArrivalAirportId(), 
            "airport_name" => '',
            ]
        );

        if($_POST){


            $errorMessage = [];
        
            if($_POST['nb_passengers'] > $searchFlight[0]->getNbSeats()){
                if(($searchFlight[0]->getNbSeats())>1) {
                    $end = " places sur ce vol";
                } else {
                    $end = " place sur ce vol";
                } 
                $errorMessage['passengers'] = "Il ne reste que " . $searchFlight[0]->getNbSeats() . $end;
            }
        
            if(empty($_POST['nb_passengers'])){
                $errorMessage['passengers'] = "Renseignez le nombre de passagers";
            }
        
            if($_POST['nb_passengers'] < 0){
                $errorMessage['passengers'] = "Nombre de passagers incorrect";
            }
        
            if(count($errorMessage) === 0){

                var_dump($_POST); 

        
                /* incrementing cart */
        
                $_SESSION['cart'][] = [
                    'flight' => intval($id),
                    'nb_passengers' => intval($_POST['nb_passengers']),
                    'price' => $searchFlight[0]->getPrice() * intval($_POST['nb_passengers']),
                ];
        
                $_SESSION['cart_price_total'] += $searchFlight[0]->getPrice() * intval($_POST['nb_passengers']);
        
                header('location:/panier');
                exit;
            }
        }

    
        include("./View/reservation-validation.php");
    }

    public static function getDetails($id)
    
    {
        $reservationFlights = ReservationFlightRepository::getList(
            [
                "id"=>"",
                "flight_id" => "",
                "reservation_id" => $id,
                "price" => "",
                "nb_passengers" => "",
            ]
        );
        
        $searchRightsToAccess = ReservationRepository::getList(
            [
                    "id" => $id,
                    "user_id" => $_SESSION['id'],
                    "price" =>"",
                    "date" => "",
                    "page" => "",
            ]
        );
        
        Security::isloggedIn($searchRightsToAccess);
        
        include_once("./View/reservation-details.html.php");

        foreach ($reservationFlights as $reservationFlight){
        
            if(!empty($reservationFlight)){
            $idflight = $reservationFlight->getFlightId();
            } else {
            $idflight = "";
            }
        
            $flight = FlightRepository::getList(
                [
                    "id" => $idflight, 
                    "around_date" => '',
                    "precise_date" => '', 
                    "departure_airport_id" => '',
                    "arrival_airport_id" => '',
                    "price" => '',
                    "nb_seats" => '',
                    "name" => '',
                ]
            );
            
            $searchDepartureAirport = AirportRepository::getList(
                [
                "id" => $flight[0]->getDepartureAirportId(), 
                "airport_name" => '',
                ]
            );
        
            $searchArrivalAirport = AirportRepository::getList(
                [
                "id" => $flight[0]->getArrivalAirportId(), 
                "airport_name" => '',
                ]
            );

            ReservationFlightsListView::render($flight, $searchDepartureAirport, $searchArrivalAirport, $reservationFlight);
        }

    }

    public static function impossible() {

        include("./View/reservation-impossible.html.php");

    }

    public static function full() {

        include("./View/reservation-full.html.php");

    }

    public static function success() {

        Security::isloggedIn($_SESSION);

        $reservationList = ReservationRepository::getList(
            [
                "id" => "",
                "user_id" => $_SESSION['id'],
                "price" =>"",
                "date" => "",
                "page" => "",
            ]
        );

        $lastReservation[] = $reservationList[0];

        include("./View/reservation-success.html.php");

    }

}