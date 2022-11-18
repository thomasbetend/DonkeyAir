<?php include_once('header.php'); ?>

<?php

require('../Connection/Database.class.php');
require('../Model/Reservation.class.php');
require('../Model/ReservationRepository.class.php');

$searchRightsToAccess = ReservationRepository::getList(
    [
            "id" => $_GET['id'],
            "user_id" => $_SESSION['id'],
            "price" =>"",
            "nb_passengers" => "",
    ]
);

if(empty($searchRightsToAccess)){
    header('location:home.php');
}


