<?php include_once('header.php'); ?>

<?php

require('../Connection/Session.class.php');
require('../Connection/Database.class.php');
require('../Model/Flight.class.php');
require('../Model/FlightRepository.class.php');
require('../Model/Reservation.class.php');
require('../Model/ReservationRepository.class.php');

$searchFlight = FlightRepository::getList(
    [
        "id" => $_GET['id'], 
        "min_date" => '', 
        "max_date" => '',
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
                <h3 class="title-reservations-1">DonkeyAir</h3>

                <?php if(empty($_SESSION)): ?>
                    <h4 class="title-reservations-2"><?php echo "Vous devez être connectés pour réserver un vol"; ?></h4>
            </div>
        </div>
    </div>
</main> 

                <?php else: ?> 

                    <?php

                    $reservationList = ReservationRepository::getList(
                        [
                            "id" => "",
                            "user_id" => $_SESSION['id'],
                            "price" =>"",
                            "nb_passengers" => "",
                    ]
                    );

                    $lastReservation = end($reservationList);

                    ?>

                    <h4 class="title-reservations-2"><?php echo "Réservation validée"; ?></h4>
            </div>
        </div>
    </div>
</main> 



<div class="container w-75">
        <div class="card mt-4 pt-2 pb-0 each-search-result">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <div class="d-flex flex-column justify-content-between">
                        <h4 class="hours-search-results">Réservation n° <?php echo $lastReservation->getId(); ?> </h4>
                        <!-- <p class="text-secondary">18/12/2022</p> -->
                    </div>
                    <div class="d-flex flex-column justify-content-between">
                        <!-- <h6 class="text-secondary"><i class="fa-solid fa-clock"></i> 5h 40min</h6> -->
                    </div>
                    <div class="d-flex flex-column justify-content-start text-right align-items-center">
                        <h4 class="hours-search-results"> <?php echo $lastReservation->getPrice(); ?> €</h4>
                        <div class="btn-group">
                            <a type="button" class="btn btn-sm btn-primary detail-reservation" href="reservation-details.php?id=<?php echo $lastReservation->getId(); ?>">
                                Détails
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <?php endif; ?>
</div>

<?php include_once('footer.php'); ?>
