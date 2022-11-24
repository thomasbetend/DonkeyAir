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

            $today = date("Y-m-d");

            if(!empty($_POST['around_date']) && $_POST['around_date'] < $today){
                $flights = [];
            } else {
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
            }
        
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