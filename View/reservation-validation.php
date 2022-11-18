<?php include_once('header.php'); ?>

<?php

require('../Connection/Session.class.php');
require('../Connection/Database.class.php');
require('../Model/Flight.class.php');
require('../Model/FlightRepository.class.php');
require('../Model/Reservation.class.php');
require('../Model/ReservationRepository.class.php');
require('../Model/ArrivalAirport.class.php');
require('../Model/ArrivalAirportRepository.class.php');
require('../Model/DepartureAirport.class.php');
require('../Model/DepartureAirportRepository.class.php');

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

$searchDepartureAirport = DepartureAirportRepository::getList(
    [
    "id" => $searchFlight[0]->getDepartureAirportId(), 
    "departure_airport_name" => '',
    ]
);
$searchArrivalAirport = ArrivalAirportRepository::getList(
    [
    "id" => $searchFlight[0]->getArrivalAirportId(), 
    "arrival_airport_name" => '',
    ]
);

if($_POST){

    $errorMessage = [];

    if($_POST['nb_passengers'] > $searchFlight[0]->getNbSeats()){
        $errorMessage['passengers'] = "Il ne reste que " . $searchFlight[0]->getNbSeats() . " places sur ce vol";
    }

    if(count($errorMessage) === 0){
        Database::insertReservation(
            'reservation', 
            [
            "user_id" => $_SESSION['id'],
            "price" => $searchFlight[0]->getPrice(),
            "nb_passengers" =>$_POST['nb_passengers']
            ]
        );
    
        Database::update(
            'flight',
            [
                "nb_seats" => ($searchFlight[0]->getNbSeats()) - $_POST['nb_passengers'],
            ],
            intval($_GET['id']),
            );
        
        header('location:reservation-success.php?id=' . $searchFlight[0]->getId());
    }
    
}
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
                    <h4 class="title-reservations-2"><?php echo "Infos de réservation"; ?></h4>
            </div>
            <div class="text-left">
                <div>
                    Donnez-nous plus d'informations sur votre vol
                </div>
                <form action = "" method="post" class="text-center">
                    <div class="form-group form-center mt-4">
                        <label for="nb_passengers"></label> 
                        <input type="number" id="nb_passengers" name="nb_passengers" class="form-control reservation-fields" placeholder="Nombre de passagers" value="<?php ?>">
                    </div> 
                    <p class="text-danger">
                        <?php if(!empty($errorMessage['passengers'])) echo $errorMessage['passengers']; ?>
                    </p>
                    <div class="form-group2 mt-2"> 
                        <label for="nb_passengers"></label> 
                        <input type="checkbox" name="insurance">Assurance annulation</input>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary mt-2">Validez</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main> 


<div class="container w-75">
    <div class="card mt-4 pt-2 pb-0 each-search-result">
        <div class="card-body">
            <div class="d-flex flex-row justify-content-between">
                <div class="d-flex flex-column justify-content-between">
                    <h4 class="hours-search-results">
                        <?php echo $searchFlight[0]->getDepartureHour()?> - <?php echo $searchFlight[0]->getArrivalHour()?>
                    </h4>
                    <p class="destination-search-result"><?php echo $searchDepartureAirport[0]->getName() . " -> " . $searchArrivalAirport[0]->getName(); ?></p>
                    <p class="text-secondary"><?php echo $searchFlight[0]->getDepartureDate(); ?></p>
                </div>
                <div class="d-flex flex-column justify-content-between">
                    <h6 class="text-secondary"><i class="fa-solid fa-clock"></i> 
                    
                        <?php echo $searchFlight[0]->getDuration(); ?>
                    </h6>
                </div>
                <div class="d-flex flex-column justify-content-start text-right align-items-center">
                    <h4 class="hours-search-results"><?php echo $searchFlight[0]->getPrice(); ?> €</h4>
                </div>
            </div>
        </div>
    </div>
</div>
                <?php endif; ?>


<?php include_once('footer.php'); ?>
