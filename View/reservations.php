<?php include_once('header.php'); ?>



<?php

if(empty($_SESSION)){
    header('location:../index.php');
}

require('../Model/ReservationRepository.class.php');
require('../Model/Reservation.class.php');
require('../Connection/Database.class.php');

ReservationRepository::getList(
    [
        "id" => '', 
        "user_id" => $_SESSION['id'], 
        "price" => '', 
        "nb_passengers" => '',
    ]
);

var_dump(ReservationRepository::getList(
    [
        "id" => '', 
        "user_id" => $_SESSION['id'], 
        "price" => '', 
        "nb_passengers" => '',
    ]
)
    ); die;

?>

<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h3 class="title-reservations-1">DonkeyAir</h3>
                <h4 class="title-reservations-2">Réservations</h4>
            </div>
        </div>
    </div>
</main> 
<div class="container w-75">
    <div class="card mt-4 pt-2 pb-0 each-search-result">
        <div class="card-body">
            <div class="d-flex flex-row justify-content-between">
                <div class="d-flex flex-column justify-content-between">
                    <h4 class="hours-search-results">09:30 - 15:10</h4>
                    <p class="destination-search-result">Paris -> New York</p>
                    <p class="text-secondary">18/12/2022</p>
                </div>
                <div class="d-flex flex-column justify-content-between">
                    <h6 class="text-secondary"><i class="fa-solid fa-clock"></i> 5h 40min</h6>
                </div>
                <div class="d-flex flex-column justify-content-start text-right align-items-center">
                    <h4 class="hours-search-results">235€</h4>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary">Détails</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4 pt-2 pb-0 each-search-result">
        <div class="card-body">
            <div class="d-flex flex-row justify-content-between">
                <div class="d-flex flex-column justify-content-between">
                    <h4 class="hours-search-results">09:30 - 15:10</h4>
                    <p class="destination-search-result">Paris -> New York</p>
                    <p class="text-secondary">18/12/2022</p>
                </div>
                <div class="d-flex flex-column justify-content-between">
                    <h6 class="text-secondary"><i class="fa-solid fa-clock"></i> 5h 40min</h6>
                </div>
                <div class="d-flex flex-column justify-content-start text-right align-items-center">
                    <h4 class="hours-search-results">235€</h4>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary">Détails</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4 pt-2 pb-0 each-search-result">
        <div class="card-body">
            <div class="d-flex flex-row justify-content-between">
                <div class="d-flex flex-column justify-content-between">
                    <h4 class="hours-search-results">09:30 - 15:10</h4>
                    <p class="destination-search-result">Paris -> New York</p>
                    <p class="text-secondary">18/12/2022</p>
                </div>
                <div class="d-flex flex-column justify-content-between">
                    <h6 class="text-secondary"><i class="fa-solid fa-clock"></i> 5h 40min</h6>
                </div>
                <div class="d-flex flex-column justify-content-start text-right align-items-center">
                    <h4 class="hours-search-results">235€</h4>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary">Détails</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once('footer.php'); ?>

</body>
</html>