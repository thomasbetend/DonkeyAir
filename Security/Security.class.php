<?php

class Security
{

    public static function isloggedIn($session): void
    {
        if(empty($session)){
            header("location:index.php");
            exit;
        }
    }

    public static function isloggedInAdmin($session): void
    {
        if(empty($session['admin'])){
            header("location:home.php");
            exit;
        }
    }

    public static function impossibleReservation($session): void{
        if(empty($session)){
            header("location:/reservation-impossible");
            exit;
        }
    }

}