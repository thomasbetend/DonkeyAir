<?php include_once('header.php'); ?>

<?php

require('../Connection/Database.class.php');
require('../Security/Security.class.php');
require('../Model/Reservation.class.php');
require('../Model/ReservationRepository.class.php');
require('../Model/Flight.class.php');
require('../Model/FlightRepository.class.php');
require('../Model/ReservationFlight.class.php');
require('../Model/ReservationFlightRepository.class.php');
require('../Model/Airport.class.php');
require('../Model/AirportRepository.class.php');
require('FlightsListView.class.php');
require('ReservationFlightsListView.class.php');

?>

<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="title-index-1">DonkeyAir</h1>
                <h4 class="text-center mt-2 mb6">Votre panier</h4>
            </div>
        </div>
    </div>
</main>



<?php

foreach($_SESSION['cart']['flight'] as $element){

        $flight = FlightRepository::getList([
            "id" => $element, 
            "final_date" => '',
            "departure_airport_id" => '',
            "arrival_airport_id" => '',
            "price" => '',
            "nb_seats" => '',
            "name" => '',
        ]);

        FlightsListView::renderCart($flight);

}

?>

<?php include_once('footer.php'); ?>

