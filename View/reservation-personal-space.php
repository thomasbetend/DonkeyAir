<?php include_once('header.php'); ?>

<?php

require('../Connection/Database.class.php');
require('../Model/ReservationRepository.class.php');
require('../Model/Reservation.class.php');
require('../Security/Security.class.php');
require('ReservationsListView.class.php');

Security::isloggedIn($_SESSION);

$searchReservations= ReservationRepository::getList(
    [
        "id" => '', 
        "user_id" => $_SESSION['id'], 
        "price" => '', 
        "date" => '',
    ]
);

?>

<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h3 class="title-reservations-1">DonkeyAir</h3>
                <h4 class="title-reservations-2">Historique de vos réservations</h4>
            </div>
        </div>
    </div>
</main> 
<div class="container w-75">

    <?php

    ReservationsListView::render($searchReservations);

    ?>
    
</div>

<?php include_once('footer.php'); ?>

</body>
</html>