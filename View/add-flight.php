<?php include_once('header.php'); ?>

<?php 

require('../Security/Security.class.php');
require('../Security/ErrorRepository.class.php');
require('../Connection/Database.class.php');
require('../Model/User.class.php');
require('../Model/UserRepository.class.php');
require('../Model/Airport.class.php');
require('../Model/AirportRepository.class.php');
require('../Model/Flight.class.php');
require('../Model/FlightRepository.class.php');

Security::isloggedIn($_SESSION);

$airports = AirportRepository::getList(
    [
        "id" => '', 
        "airport_name" => '',
    ]
);

if($_POST) {

    $errorMessage = [];

    if(empty($_POST['departure_date']) || empty($_POST['departure_hour']) || empty($_POST['arrival_date']) || empty($_POST['arrival_hour']) || empty($_POST['departure_airport_id']) || empty($_POST['arrival_airport_id']) || empty($_POST['price']) || empty($_POST['nb_seats']) || empty($_POST['flight_name'])){
        $errorMessage['fields'] = true; 
    }

    if(floatval($_POST['price']) < 0){
        $errorMessage['price'] = true; 
    }

    if(intval($_POST['nb_seats']) < 1){
        $errorMessage['nb_seats'] = true; 
    }

    if(($_POST['departure_date'] . ' ' . $_POST['departure_hour']. ':00') >= $_POST['arrival_date'] . ' ' . $_POST['arrival_hour']. ':00'){
        $errorMessage['time'] = true; 
    }

    if(empty($errorMessage)){

        Database::insertFlight(
            [
                "departure_date" => $_POST['departure_date'] . ' ' . $_POST['departure_hour']. ':00',
                "arrival_date" => $_POST['arrival_date'] . ' ' . $_POST['arrival_hour']. ':00', 
                "departure_airport_id" => intval($_POST['departure_airport_id']),
                "arrival_airport_id" => intval($_POST['arrival_airport_id']),
                "price" => $_POST['price'],
                "nb_seats" => intval($_POST['nb_seats']),
                "name" => $_POST['flight_name'],
            ]
        );

        $totlaFlightsList = FlightRepository::getList(
            [
                "id" => '', 
                "final_date" => '', 
                "departure_airport_id" => '',
                "arrival_airport_id" => '',
                "price" => '',
                "nb_seats" => '',
                "name" => '',
            ]
            );

        $lastAddedFlight = end($totlaFlightsList);

        header('location:add-flight-success.php?id=' . $lastAddedFlight->getId());
        exit();

    }
}
?>

<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h3 class="title-reservations-1">DonkeyAir</h3>
                <h4 class="title-reservations-2">Ajoutez un vol</h4>
            </div>
        </div>
        <div class="container w-50 ">
                <form action = "" method="post" class="mt-3">
                    <div class="form-group mb-1">
                        <label for="flight_name" class="text-secondary"></label>
                        <input type="text" id="flight-flight_name" name="flight_name" class="form-control connection-field" Placeholder="Numéro de vol *" value="<?php if(!empty($_POST['flight_name'])){echo $_POST['flight_name'];}?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="price" class="text-secondary"></label>
                        <input type="number" step="0.01" id="price" name="price" placeholder="Prix *" class="form-control connection-field" value="<?php if(!empty($_POST['price'])){echo $_POST['price'];}?>">
                    </div>
                    <div class="form-group">
                        <label for="add-flight-select"></label>
                        <select name="departure_airport_id" id="add-flight-select" class="form-group mb-1">
                            <option value="">Aéroport de départ</option> 
                            <?php foreach($airports as $airport): ?>
                                <option value="<?php echo $airport->getId(); ?>" <?php if(!empty($_POST['departure']) && $_POST['departure'] == $airport->getId()) echo "selected"; ?>>
                                    <?php echo $airport->getName(); ?>
                                </option> 
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="add-flight-select"></label>
                        <select name="arrival_airport_id" id="add-flight-select" class="form-group mb-1">
                            <option value="">Aéroport d'arrivée</option> 
                            <?php foreach($airports as $airport): ?>
                                <option value="<?php echo $airport->getId(); ?>" <?php if(!empty($_POST['arrival']) && $_POST['arrival'] == $airport->getId()) echo "selected"; ?>>
                                    <?php echo $airport->getName(); ?>
                                </option> 
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="departure_date" class="text-secondary"></label>
                        <input type="date" id="departure_date" name="departure_date" class="form-control connection-field" value="<?php if(!empty($_POST['departure_date'])) {echo $_POST['departure_date'];} ?>" placeholder="Date de départ *" onfocus="(this.type='date')" onblur="(this.type='date')">
                    </div>
                    <div class="form-group mb-2">
                        <label for="departure_hour" class="text-secondary"></label>
                        <input type="time" id="departure_hour" name="departure_hour" class="form-control connection-field" value="<?php if(!empty($_POST['departure_hour'])) {echo $_POST['departure_hour'];} ?>" placeholder="Heure de départ *" onfocus="(this.type='time')" onblur="(this.type='time')">
                    </div>
                    <div class="form-group mb-2">
                        <label for="arrival_date" class="text-secondary"></label>
                        <input type="date" id="arrival_date" name="arrival_date" class="form-control connection-field" value="<?php if(!empty($_POST['arrival_date'])) {echo $_POST['arrival_date'];} ?>" placeholder="Date d'arrivée *" onfocus="(this.type='date')" onblur="(this.type='date')">
                    </div>
                    <div class="form-group mb-2">
                        <label for="arrival_hour" class="text-secondary"></label>
                        <input type="time" id="arrival_hour" name="arrival_hour" class="form-control connection-field" value="<?php if(!empty($_POST['arrival_hour'])) {echo $_POST['arrival_hour'];} ?>" placeholder="Heure d'arrivée *" onfocus="(this.type='time')" onblur="(this.type='time')">
                    </div>
                    <div class="form-group mb-2">
                        <label for="nb_seats" class="text-secondary"></label>
                        <input type="number" id="nb_seats" name="nb_seats" placeholder="Nombre de sièges *" class="form-control connection-field" value="<?php if(!empty($_POST['nb_seats'])){echo $_POST['nb_seats'];}?>">
                    </div>
                    <div class="errorMessage text-danger">
                        <?php 
                            if(!empty($errorMessage)){
                                ErrorRepository::formError($errorMessage);
                            }
                        ?>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mt-2">Ajoutez</button>
                    </div>
                </form>
        </div>
</main>

<?php include_once('footer.php'); ?>

<script type="text/javascript">
    window.onload = () => {
        document.getElementById('departure_date').type = "date";
        document.getElementById('arrival_date').type = "date";
        document.getElementById('departure_hour').type = "time";
        document.getElementById('arrival_hour').type = "time";
    };

</script>

</body>
</html>


