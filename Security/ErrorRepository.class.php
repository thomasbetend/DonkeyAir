<?php

class ErrorRepository
{
    public static function toErrorPage(): void
    {
        header("location:error-page.php");
        exit;
    }

    public static function noMoreSeats($flight): void{
        if($flight->getNbSeats() < 1){
            header("location:reservation-full.php");
            exit;
        }
    }
}