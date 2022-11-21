<?php include_once('header.php'); ?>

<?php

require('../Connection/Database.class.php');
require('../Model/Flight.class.php');
require('../Model/FlightRepository.class.php');
require('../Model/Reservation.class.php');
require('../Model/ReservationRepository.class.php');
require('../Model/Airport.class.php');
require('../Model/AirportRepository.class.php');
require('../Security/Security.class.php');
require('../Security/ErrorRepository.class.php');
require('FlightsListView.class.php');

$searchFlight = FlightRepository::getList(
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

Security::impossibleReservation($_SESSION);

/* no more places on this flight */

ErrorRepository::noMoreSeats($searchFlight[0]);

/* --------- */

$searchDepartureAirport = AirportRepository::getList(
    [
    "id" => $searchFlight[0]->getDepartureAirportId(), 
    "airport_name" => '',
    ]
);
$searchArrivalAirport = AirportRepository::getList(
    [
    "id" => $searchFlight[0]->getArrivalAirportId(), 
    "airport_name" => '',
    ]
);

if($_POST){

    $errorMessage = [];

    if($_POST['nb_passengers'] > $searchFlight[0]->getNbSeats()){
        if(($searchFlight[0]->getNbSeats())>1) {
            $end = " places sur ce vol";
        } else {
            $end = " place sur ce vol";
        } 
        $errorMessage['passengers'] = "Il ne reste que " . $searchFlight[0]->getNbSeats() . $end;
    }

    if(empty($_POST['nb_passengers'])){
        $errorMessage['passengers'] = "Renseignez le nombre de passagers";
    }

    if($_POST['nb_passengers'] < 0){
        $errorMessage['passengers'] = "Nombre de passagers incorrect";
    }

    if(count($errorMessage) === 0){

        /* insert into table reservation */

        Database::insertReservation(
            [
            "user_id" => $_SESSION['id'],
            "price" => $searchFlight[0]->getPrice() * intval($_POST['nb_passengers']),
            "nb_passengers" =>intval($_POST['nb_passengers'])
            ]
        );

        /* insert into table reservation_flight */

        $reservations = ReservationRepository::getList(
            [
                "id" => '', 
                "user_id" => $_SESSION['id'], 
                "price" => '', 
                "nb_passengers" => '',
            ]
        );

        $lastreservation = $reservations[0];

        Database::insertReservationFlight(
            [
                "flight_id" => $searchFlight[0]->getId(),
                "reservation_id" => $lastreservation->getId(),
            ]
        );

        /* update table flight */
    
        Database::update(
            'flight',
            [
                "nb_seats" => $searchFlight[0]->getNbSeats() - intval($_POST['nb_passengers']),
            ],
            intval($_GET['id']),
            );
        
        header('location:reservation-success.php');
        exit;
    }
}
?>

<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h3 class="title-reservations-1">DonkeyAir</h3>

                <h4 class="title-reservations-2"><?php echo "Infos de réservation"; ?></h4>
            </div>
            <div class="text-left mt-1">
                <div>
                    Donnez-nous plus d'informations sur votre vol
                </div>
                <form action = "" method="post" class="text-left form-center">
                    <div class="card-form-reservations-info">
                        <div class="form-group form-center mt-4">
                            <label for="nb_passengers"></label> 
                            <input type="number" id="nb_passengers" name="nb_passengers" class="form-control reservation-fields" placeholder="Nombre de passagers *" value="<?php if(!empty($_POST['nb_passengers'])) {echo $_POST['nb_passengers'];} ?>">
                        </div> 
                        <p class="text-danger">
                            <?php if(!empty($errorMessage['passengers'])) echo $errorMessage['passengers']; ?>
                        </p>
                        <div class="form-group2 mt-2 text-left mb-3"> 
                            <label for="insurance"></label> 
                            <input type="checkbox" name="insurance">Assurance annulation</input>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary mt-1">Validez</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main> 

<?php

FlightsListView::render($searchFlight);

?>

<?php include_once('footer.php'); ?>
