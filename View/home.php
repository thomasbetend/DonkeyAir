<?php include_once('header.php'); ?>

<?php

require('../Connection/Database.class.php');
require('../Model/Flight.class.php');
require('../Model/FlightRepository.class.php');
require('../Model/User.class.php');
require('../Model/UserRepository.class.php');
require('../Model/Reservation.class.php');
require('../Model/ReservationRepository.class.php');
require('../Model/ArrivalAirport.class.php');
require('../Model/ArrivalAirportRepository.class.php');
require('../Model/DepartureAirport.class.php');
require('../Model/DepartureAirportRepository.class.php');

$departures = DepartureAirportRepository::getList(
    [
        "id" => '', 
        "departure_airport_name" => '',
    ]
);

$arrivals = ArrivalAirportRepository::getList(
    [
        "id" => '', 
        "arrival_airport_name" => '',
    ]
); 

if($_POST){

    $searchFlightsList = FlightRepository::getList(
        [
            "id" => '', 
            "min_date" => $_POST['min_date'], 
            "max_date" => $_POST['max_date'],
            "departure_airport_id" => intval($_POST['departure']),
            "arrival_airport_id" => intval($_POST['arrival']),
            "price" => '',
            "nb_seats" => '',
            "name" => '',
        ]
    );

    if(!empty($_POST['min_date'])){
        $minDate = $_POST['min_date'];
        $mindt = (DateTime::createFromFormat("Y-m-d", $minDate))->format("d/m/Y");
    }
    if(!empty($_POST['max_date'])){
        $maxDate = $_POST['max_date'];
        $maxdt = (DateTime::createFromFormat("Y-m-d", $maxDate))->format("d/m/Y");
    }
}
?>

<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="title-index-1">DonkeyAir</h1>
                <h4 class="text-center mt-2 mb6">Évadez-vous dans les airs</h4>
            </div>
        </div>

        <form method="POST" class="text-center mt-2 small" id="">
            <div class="form-group index-search-form">  
                <select name="departure" id="index-select">
                    <option value="">Aéroport de départ</option> 
                    <?php foreach($departures as $departure): ?>
                        <option value="<?php echo $departure->getId(); ?>" <?php if(!empty($_POST['departure']) && $_POST['departure'] == $departure->getId()) echo "selected"; ?>>
                            <?php echo $departure->getName(); ?>
                        </option> 
                    <?php endforeach; ?>
                </select>
                <select name="arrival" id="index-select">
                    <option value="">Aéroport d'arrivée</option> 
                    <?php foreach($arrivals as $arrival): ?>
                        <option value="<?php echo $arrival->getId(); ?>" <?php if(!empty($_POST['arrival']) && $_POST['arrival'] == $arrival->getId()) echo "selected"; ?>>
                            <?php echo $arrival->getName(); ?>
                        </option> 
                    <?php endforeach; ?>
                </select>
                <span class="between-dates"> Période <span>
                <input type="datetime-local" id="min_date" name="min_date" class="index-search-date" value="<?php if(!empty($_POST['min_date'])) {echo $mindt;} ?>" placeholder="<?php if(!empty($_POST['min_date'])) {echo $mindt;} else {echo "Du";} ?>" onfocus="(this.type='date')" onblur="(this.type='text')"></input>
                <input type="datetime-local" id="max_date" name="max_date" class="index-search-date" value="<?php if(!empty($_POST['max_date'])) {echo $maxdt;} ?>" placeholder="<?php if(!empty($_POST['max_date'])) {echo $maxdt;} else {echo "Au";} ?>" onfocus="(this.type='date')" onblur="(this.type='text')"></input>
            </div> 
            <div class="button-search">
                <button type="submit" class="btn btn-primary small mt-3 mb-3 pl-4" id="buttonSearch">Recherchez un vol</button>
            </div>
        </form>
    </div>
</main> 


<?php if(empty($_POST) || (($_POST['arrival'] === '') && ($_POST['departure'] === '') && ($_POST['min_date'] === '') && ($_POST['max_date'] === ''))): ?>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" alt="Thumbnail [100%x225]" src="/_medias/ny01.webp" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                        <div class="card-body">
                            <h4>Visitez New York pour seulement 399 euros</h4>
                            <p class="card-text"></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary">Réservez</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" alt="Thumbnail [100%x225]" src="/_medias/ny01.webp" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                        <div class="card-body">
                            <h4>Visitez New York pour seulement 399 euros</h4>
                            <p class="card-text"></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary">Réservez</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" alt="Thumbnail [100%x225]" src="/_medias/ny01.webp" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                        <div class="card-body">
                            <h4>Visitez New York pour seulement 399 euros</h4>
                            <p class="card-text"></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary">Réservez</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <?php if(empty($searchFlightsList)): ?>
        <p class="mt-4 text-center text-secondary"><?php echo "Pas de résultats pour votre recherche" ?></p>
        <a href="home.php" id="initSearch" class="text-center">Réinitialisez la recherche</a><br/>
    <?php endif; ?>
    <?php foreach ($searchFlightsList as $searchFlight): ?>
        <?php
        $searchDepartureAirport = DepartureAirportRepository::getList(
            [
            "id" => $searchFlight->getDepartureAirportId(), 
            "departure_airport_name" => '',
            ]
        );
        $searchArrivalAirport = ArrivalAirportRepository::getList(
            [
            "id" => $searchFlight->getArrivalAirportId(), 
            "arrival_airport_name" => '',
            ]
        );
        ?>
        <div class="container w-75">
            <div class="card mt-4 pt-2 pb-0 each-search-result">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="d-flex flex-column justify-content-between">
                            <h4 class="hours-search-results">
                                <?php echo $searchFlight->getDepartureHour()?> - <?php echo $searchFlight->getArrivalHour()?>
                            </h4>
                            <p class="destination-search-result"><?php echo $searchDepartureAirport[0]->getName() . " -> " . $searchArrivalAirport[0]->getName(); ?></p>
                            <p class="text-secondary"><?php echo $searchFlight->getDepartureDate(); ?></p>
                        </div>
                        <div class="d-flex flex-column justify-content-between">
                            <h6 class="text-secondary"><i class="fa-solid fa-clock"></i> 
                            
                                <?php echo $searchFlight->getDuration(); ?>
                            </h6>
                        </div>
                        <div class="d-flex flex-column justify-content-start text-right align-items-center">
                            <h4 class="hours-search-results"><?php echo $searchFlight->getPrice(); ?></h4>
                            <div class="btn-group">
                                <a type="button" class="btn btn-sm btn-primary detail-reservation" href="reservation-validation.php?id=<?php echo $searchFlight->getId(); ?>">Réservez</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

<?php endif; ?>

<?php include_once('footer.php'); ?>

<script type="text/javascript">
    window.onload = () => {
        document.getElementById('min_date').type = "text";
        document.getElementById('max_date').type = "text";
    };

</script>

</body>
</html>