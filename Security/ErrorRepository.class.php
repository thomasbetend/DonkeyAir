<?php

class ErrorRepository
{
    public static function toErrorPage(): void
    {
        header("location:/erreur");
        exit;
    }

    public static function noMoreSeats($flight): void
    {
        if($flight->getNbSeats() < 1){
            header("location:/vol-complet");
            exit;
        }
    }

    public static function formError(array $errorMessage): void
    {
            if(!empty($errorMessage['fields'])){
                echo "Remplissez tous les champs";
            }
            else if(!empty($errorMessage['price'])){
                echo "Le prix doit être positif";
            }
            else if(!empty($errorMessage['nb_seats'])){
                echo "Il doit y avoir au minimum 1 place dans l'avion";
            }
            elseif (!empty($errorMessage['time'])){
                echo "La date de départ doit être antérieure à la date d'arrivée";
            }
            elseif(!empty($errorMessage['mail_used'])){
                echo "Mail déjà utilisé";
            }
            elseif(!empty($errorMessage['mail_incorrect'])){
                echo "Mail incorrect";
            }
            elseif(!empty($errorMessage['flight_name'])){
                echo "Nom de vol déjà utilisé";
            }
            elseif(!empty($errorMessage['same_airport'])){
                echo "Les deux aéroports doivent être différents";
            }
    }
}