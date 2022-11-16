<?php include_once('header.php'); ?>

<?php

require('../Connexion/Session.class.php');
require('../Connexion/Database.class.php');
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

?>

<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="title-index-1">DonkeyAir</h1>
                <h4 class="text-center mt-2 mb6">Évadez-vous dans les airs</h4>
            </div>
        </div>

        <?php
        $totalFlightsList = FlightRepository::getList('', '', '', '', '', '', '', '');
        $departures = DepartureAirportRepository::getList('', '');
        $arrivals = ArrivalAirportRepository::getList('', '');
        ?>

        <?php 
        if($_POST){
            $searchFlightsList = FlightRepository::getList('', '', '', intval($_POST['departure']), intval($_POST['arrival']), '' , '', '');
        }
        ?>

        <form method="POST" class="text-center mt-2 small" id="">
            <div class="form-group index-search-form">  
                <select name="departure" id="index-select">
                    <option value="">Aéroport de départ</option> 
                    <?php foreach($departures as $departure): ?>
                        <option value="<?php echo $departure->getId(); ?>" <?php if(!empty($_POST['departure']) && $_POST['departure'] == $departure->getId()) echo "selected"; ?>><?php echo $departure->getName(); ?></option> 
                    <?php endforeach; ?>
                </select>
                <select name="arrival" id="index-select">
                    <option value="">Aéroport d'arrivée</option> 
                    <?php foreach($arrivals as $arrival): ?>
                        <option value="<?php echo $arrival->getId(); ?>" <?php if(!empty($_POST['arrival']) && $_POST['arrival'] == $arrival->getId()){ echo "selected"; }?>><?php echo $arrival->getName(); ?></option> 
                    <?php endforeach; ?>
                </select>
                <input type="date" id="departure-date" name="date" class="index-search" placeholder="<?php if(!empty($_POST['date'])) {echo $_POST['date'];} else { echo "Date de départ";} ?>" onfocus="(this.type='date')" onblur="(this.type='text')"></input>
            </div> 
            <div class="button-search">
                <button type="submit" class="btn btn-primary small mt-3 mb-3 pl-4" id="buttonSearch">Recherchez un vol</button>
            </div>

        </form>
    </div>
</main> 





<?php if(empty($searchFlightsList)): ?>
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
    <?php foreach ($searchFlightsList as $searchFlight): ?>
        <?php
        $searchDepartureAirport = DepartureAirportRepository::getList($searchFlight->getDepartureAirportId(), '');
        $searchArrivalAirport = ArrivalAirportRepository::getList($searchFlight->getArrivalAirportId(), '');
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
                                <button type="button" class="btn btn-sm btn-primary">Réservez</button>
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
        document.getElementById('departure-date').type = "text";
    };

</script>

</body>
</html>