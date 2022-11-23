<?php

class CalendarController
{
    public static function calendar()
    {
        include("./View/calendar.php");
    }

    public static function getMatchCalendar($day, $month, $year)
    {   
        $date = DateTime::createFromFormat("d M Y", $day . " " . $month . " " . $year);
        $date->format("Y-m-d");

        $flightMatchCalendar = FlightRepository::getList(
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

        if(!empty($flightMatchCalendar)){
            echo json_encode(['exist' => true]);
        } else {
            echo json_encode(['exist' => false]);
        }
    }
}