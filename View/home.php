<?php include_once('header.php'); ?>

<?php

require('../Connection/Database.class.php');
require('../Model/Flight.class.php');
require('../Model/FlightRepository.class.php');
require('../Model/User.class.php');
require('../Model/UserRepository.class.php');
require('../Model/Reservation.class.php');
require('../Model/ReservationRepository.class.php');
require('../Model/Airport.class.php');
require('../Model/AirportRepository.class.php');
require('FlightsListView.class.php');
require('PromosListView.class.php');
require('../Security/ErrorRepository.class.php');

$airports = AirportRepository::getList(
    [
        "id" => '', 
        "airport_name" => '',
    ]
);

if($_POST){

    $flights = FlightRepository::getList(
        [
            "id" => '', 
            "final_date" => $_POST['final_date'], 
            "departure_airport_id" => intval($_POST['departure']),
            "arrival_airport_id" => intval($_POST['arrival']),
            "price" => '',
            "nb_seats" => '',
            "name" => '',
        ]
    );

    /* checking if airport chosen in selects are in database */

    $airportSelectExisting = [
        AirportRepository::getList(
            [
                "id" => intval($_POST['departure']),
                "airport_name" => "",
            ]
        ),
        AirportRepository::getList(
            [
                "id" => intval($_POST['arrival']),
                "airport_name" => "",
            ]
            ),
    ];

    if(empty($airportSelectExisting)){
        ErrorRepository::toErrorPage();
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
            <div class="form-group index-search-form select-form">  
                <select name="departure" id="index-select" class="select-form">
                    <option value="">Aéroport de départ</option> 
                    <?php foreach($airports as $airport): ?>
                        <option value="<?php echo $airport->getId(); ?>" <?php if(!empty($_POST['departure']) && $_POST['departure'] == $airport->getId()) echo "selected"; ?>>
                            <?php echo $airport->getName(); ?>
                        </option> 
                    <?php endforeach; ?>
                </select>
                <select name="arrival" id="index-select" class="select-form">
                    <option value="">Aéroport d'arrivée</option> 
                    <?php foreach($airports as $airport): ?>
                        <option value="<?php echo $airport->getId(); ?>" <?php if(!empty($_POST['arrival']) && $_POST['arrival'] == $airport->getId()) echo "selected"; ?>>
                            <?php echo $airport->getName(); ?>
                        </option> 
                    <?php endforeach; ?>
                </select>
                <span class="between-dates"><span>
                <input type="date" id="final_date" name="final_date" class="select-form index-search-date" value="<?php if(!empty($_POST['final_date'])){echo $_POST['final_date'];} ?>" placeholder="Date de départ" onfocus="(this.type='date')" onblur="(this.type='date')"></input>
            </div> 
            <div class="button-search">
                <button type="submit" class="btn btn-primary small mt-3 mb-3 pl-4 select-form" id="buttonSearch">Recherchez un vol</button>
            </div>
        </form>
    </div>
</main> 

<?php if(empty($_POST) || (($_POST['arrival'] === '') && ($_POST['departure'] === '') && ($_POST['final_date'] === ''))): ?>
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