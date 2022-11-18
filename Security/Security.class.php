<?php

class Security
{

    public static function isloggedIn($session): void
    {
        if(empty($session)){
            header("location:home.php");
            exit;
        }
    }

    public static function impossibleReservation($session): void{
        if(empty($session)){
            header("location:reservation-impossible.php");
            exit;
        }
    }

}