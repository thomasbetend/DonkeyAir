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
require('FlightsListView.class.php');
require('PromosListView.class.php');

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

    $flights = FlightRepository::getList(
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
                <?php

                $promos = [$promo1 = "", $promo2 = "", $promo3 = ""];

                PromosListView::render($promos);

                ?>
            </div>
        </div>
    </div>
<?php else : ?>
    <?php if(empty($flights)): ?>
        <p class="mt-4 text-center text-secondary"><?php echo "Pas de résultats pour votre recherche" ?></p>
        <a href="home.php" id="initSearch" class="text-center">Réinitialisez la recherche</a><br/>
    <?php endif; ?>
    <?php
    
    FlightsListView::render($flights);

    ?>
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