<?php include_once('header.php'); ?>

<?php

require('../Connection/Database.class.php');
require('../Model/Flight.class.php');
require('../Repositories/FlightRepository.class.php');
require('../Model/Reservation.class.php');
require('../Repositories/ReservationRepository.class.php');
require('../Security/Security.class.php');
require('FlightsListView.class.php');
require('../Model/Airport.class.php');
require('../Repositories/AirportRepository.class.php');

Security::isloggedInAdmin($_SESSION);

$flight = FlightRepository::getList(
    [
        "id" => $_GET['id'], 
        "final_date" => '', 
        "departure_airport_id" => '',
        "arrival_airport_id" => '',
        "price" => '',
        "nb_seats" => '',
        "name" => '',
    ]
);

?>

<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="title-index-1">DonkeyAir</h1>
                <h4 class="text-center mt-2 mb6">Vol ajouté avec succès</h4>
            </div>
        </div>
    </div>
</main>

<?php

FlightsListView::render($flight);

?>
