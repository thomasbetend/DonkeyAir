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

$reservationFlight = ReservationFlightRepository::getList(
    [
        "id"=>'',
        "flight_id" => '',
        "reservation_id" => $_GET['id'],
    ]
);

if(!empty($reservationFlight)){
    $idflight = $reservationFlight[0]->getFlightId();
} else {
    $idflight = '';
}

$flight = FlightRepository::getList(
    [
        "id" => $idflight, 
        "min_date" => '', 
        "max_date" => '', 
        "departure_airport_id" => '',
        "arrival_airport_id" => '',
        "price" => '',
        "nb_seats" => '',
        "name" => '',
    ]
);

$searchRightsToAccess = ReservationRepository::getList(
    [
            "id" => $_GET['id'],
            "user_id" => $_SESSION['id'],
            "price" =>"",
            "nb_passengers" => "",
    ]
);

Security::isloggedIn($searchRightsToAccess);

?>

<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h3 class="title-reservations-1">DonkeyAir</h3>
                <h4 class="title-reservations-2"> Réservation n° <?php echo $_GET['id']; ?></h4>
                <p>Nombre de passagers : <?php echo $searchRightsToAccess[0]->getNbPassengers(); ?></p>
                <h5>Prix total : <?php echo $searchRightsToAccess[0]->getPrice(); ?> €</h5>
            </div>
        </div>
    </div>
</main> 

<?php

ReservationFlightsListView::render($reservationFlight, $flight[0], $searchRightsToAccess[0]);

?>

<?php include_once('footer.php'); ?>

</body>
</html>






