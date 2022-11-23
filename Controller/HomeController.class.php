<?php

class HomeController 
{
    public static function home() 
    {
        $airports = AirportRepository::getList(
            [
                "id" => '', 
                "airport_name" => '',
            ]
        );
        
        if($_POST){
        
            $flights = FlightRepository::getList(
                [
                    "id" => '', 
                    "around_date" => $_POST['around_date'],
                    "precise_date" => '',
                    "departure_airport_id" => intval($_POST['departure']),
                    "arrival_airport_id" => intval($_POST['arrival']),
                    "price" => '',
                    "nb_seats" => '',
                    "name" => '',
                ]
            );
        
            /* checking if airport chosen in selects are in database */
        
            $airportSelectExisting = [
                AirportRepository::getList(
                    [
                        "id" => intval($_POST['departure']),
                        "airport_name" => "",
                    ]
                ),
                AirportRepository::getList(
                    [
                        "id" => intval($_POST['arrival']),
                        "airport_name" => "",
                    ]
                    ),
            ];
        
            if(empty($airportSelectExisting)){
                ErrorRepository::toErrorPage();
            }
        
        }

        include("./View/home.php");
    }

}