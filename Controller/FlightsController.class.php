<?php
// src/Controller/ArticlesListController.php

class FlightsController
{
    public function getList()
    {
        // Appeler la base pour recuperer les articles
            // -> en fonction du $_GET['page']
            // $length = 20;
            // $start = ($_GET['page'] - 1) * $length;
            // SELECT * FROM articles LIMIT $start, $length
            $articles = Article::getList($_GET['page'] ?? 1);

        // Passer les articles au template
        // Envoyer le collage à l'user echo
        (new ArticlesListView)->render($articles);
    }

    public static function add()
    {
        Security::isloggedInAdmin($_SESSION);

        $airports = AirportRepository::getList(
            [
                "id" => '', 
                "airport_name" => '',
            ]
        );

        if($_POST) {

            $errorMessage = [];

            if(empty($_POST['departure_date']) || empty($_POST['departure_hour']) || empty($_POST['arrival_date']) || empty($_POST['arrival_hour']) || empty($_POST['departure']) || empty($_POST['arrival']) || empty($_POST['price']) || empty($_POST['nb_seats']) || empty($_POST['flight_name'])){
                $errorMessage['fields'] = true; 
            }

            if($_POST['departure'] === $_POST['arrival']){
                $errorMessage['same_airport'] = true;
            }

            if(floatval($_POST['price']) < 0){
                $errorMessage['price'] = true; 
            }

            if(intval($_POST['nb_seats']) < 1){
                $errorMessage['nb_seats'] = true; 
            }

            if(($_POST['departure_date'] . ' ' . $_POST['departure_hour']. ':00') >= $_POST['arrival_date'] . ' ' . $_POST['arrival_hour']. ':00'){
                $errorMessage['time'] = true; 
            }

            $flightNameAlreadyExisting = FlightRepository::getList(
                [
                    "id" => "",
                    "around_date" => '',
                    "precise_date" => '',
                    "departure_airport_id" => "",
                    "arrival_airport_id" => "",
                    "price" => "",
                    "nb_seats" => "",
                    "name" => $_POST['flight_name'],
                ]
                );
            
            if(!empty($flightNameAlreadyExisting)){
                $errorMessage['flight_name'] = true; 
            }

            if(empty($errorMessage)){

                Database::insertFlight(
                    [
                        "departure_date" => $_POST['departure_date'] . ' ' . $_POST['departure_hour']. ':00',
                        "arrival_date" => $_POST['arrival_date'] . ' ' . $_POST['arrival_hour']. ':00', 
                        "departure_airport_id" => intval($_POST['departure']),
                        "arrival_airport_id" => intval($_POST['arrival']),
                        "price" => $_POST['price'],
                        "nb_seats" => intval($_POST['nb_seats']),
                        "name" => $_POST['flight_name'],
                    ]
                );

                $totlaFlightsList = FlightRepository::getList(
                    [
                        "id" => '', 
                        "around_date" => '',
                        "precise_date" => '', 
                        "departure_airport_id" => '',
                        "arrival_airport_id" => '',
                        "price" => '',
                        "nb_seats" => '',
                        "name" => '',
                    ]
                    );

                $lastAddedFlight = end($totlaFlightsList);

                header('location:/vol-ajoute/' . $lastAddedFlight->getId());
                exit();

            }
        }

        include('./View/add-flight.html.php');
    }

    public static function addSuccess($id)
    {

    Security::isloggedInAdmin($_SESSION);

    $flight = FlightRepository::getList(
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

        include('./View/add-flight-success.html.php');
    }

    public static function getDateFlights($day, $month, $year)
    {   
        $date = DateTime::createFromFormat("d M Y", $day . " " . $month . " " . $year);
        $date->format("Y-m-d");

        $flights = FlightRepository::getList(
            [
                "id" => '', 
                "around_date" => '',
                "precise_date" => $date->format("Y-m-d"),
                "departure_airport_id" => '',
                "arrival_airport_id" => '',
                "price" => '',
                "nb_seats" => '',
                "name" => '',
            ]
        );
        
        include('./View/date-flight.html.php'); 
        
        if($flights){
            FlightsListView::render($flights);
        } else {
            echo "<h4 class='text-center mt-4'>Pas de vols ce jour</h4>";
        }
        
        
    }
}
