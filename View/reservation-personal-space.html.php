<?php

require('./View/ReservationsListView.class.php');

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
    <div class="text-center">
        Page 
        <?php

        for($i = 1; $i<=ceil(count($searchReservationsTotal)/10); $i++){ ?>
                <a href="/reservations/<?php echo $i ?>"><?php echo $i ?></a>

        <?php 
        } 
        ?>

