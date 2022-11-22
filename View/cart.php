<?php include_once('header.php'); ?>

<?php

require('../Connection/Database.class.php');
require('../Security/Security.class.php');
require('../Model/Reservation.class.php');
require('../Repositories/ReservationRepository.class.php');
require('../Model/Flight.class.php');
require('../Repositories/FlightRepository.class.php');
require('../Model/ReservationFlight.class.php');
require('../Repositories/ReservationFlightRepository.class.php');
require('../Model/Airport.class.php');
require('../Repositories/AirportRepository.class.php');
require('FlightsListView.class.php');
require('ReservationFlightsListView.class.php');

?>

<?php


if($_POST){

    /* insert into table reservation */

    Database::insertReservation(
        [
        "user_id" => $_SESSION['id'],
        "price" => $_SESSION['cart_price'],
        "date" => date("Y-m-d"),
        ]
    );

    foreach($_SESSION['cart'] as $element){

    /* insert into table reservation_flight */

    $reservations = ReservationRepository::getList(
        [
            "id" => '',
            "user_id" => $_SESSION['id'], 
            "price" => '',
            "date" => '',
        ]
    );

    $lastreservation = $reservations[0];

    Database::insertReservationFlight(
        [
            "flight_id" => $element['flight'],
            "reservation_id" => $lastreservation->getId(),
            "price" => $element['price'],
            "nb_passengers" => $element['nb_passengers'],
        ]
    );

    /* update table flight */

    $flightToUpdate = FlightRepository::getList([
        "id" => $element['flight'], 
        "final_date" => '',
        "departure_airport_id" => '',
        "arrival_airport_id" => '',
        "price" => '',
        "nb_seats" => '',
        "name" => '',
    ]);

    Database::update(
        'flight',
        [
            "nb_seats" => $flightToUpdate[0]->getNbSeats() - $element['nb_passengers'],
        ],
        $element['flight'],
        );
    }

    /* empty the cart */

    $_SESSION['cart'] = array();
    $_SESSION['cart_price'] = 0;

    header('location:reservation-success.php?id=' . $lastreservation->getId());
    exit;
}

?>

<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="title-index-1">DonkeyAir</h1>
                <?php if(!empty($_SESSION['cart_price']) && $_SESSION['cart_price'] !== 0): ?>
                    <h4 class="text-center mt-2 mb6">Votre réservation</h4>
                    <h5 class="text-center mt-2 mb6">Prix total : <?php if(!empty( $_SESSION['cart_price'])) echo $_SESSION['cart_price'] ?> €</h5>
                <?php endif; ?>    
            </div>
        </div>
    </div>
</main>

<?php

foreach($_SESSION['cart'] as $element){

    $flight = FlightRepository::getList([
        "id" => $element['flight'], 
        "final_date" => '',
        "departure_airport_id" => '',
        "arrival_airport_id" => '',
        "price" => '',
        "nb_seats" => '',
        "name" => '',
    ]);

    FlightsListView::renderCart($flight, $element['price'], $element['nb_passengers']);

}

?>

<?php if(!empty($_SESSION['cart_price']) && $_SESSION['cart_price'] !== 0): ?>
    <div class="container w-50 text-center">
        <a href="home.php" class="text-center mt-1 mb-3" >Ajouter un autre vol</a>
        <form method="POST">
            <input type="text" name="test"></input>
            <div>
                <button type="submit" class="btn btn-primary mt-3">Validez votre réservation</button>
            </div>
        </form>
    </div>
<?php endif; ?>

<?php include_once('footer.php'); ?>

