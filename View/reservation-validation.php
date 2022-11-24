<?php
require('./View/brand.php');
?>

<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h3 class="title-reservations-1"><?= $brand ?></h3>
                <i class="fa-solid fa-pen-to-square picto-page"></i>
                <h4 class="title-reservations-2"><?php echo "Infos de réservation"; ?></h4>
            </div>
            <div class="text-left mt-1">
                <div class = "text-secondary mb-2">
<!--                     Donnez-nous plus d'informations sur votre vol
 -->                </div>
                <form action = "" method="post" class="text-left form-center">
                    <div class="card-form-reservations-info">
                        <div class="form-group form-center mt-4">
                            <label for="nb_passengers"></label> 
                            <input type="number" id="nb_passengers" name="nb_passengers" class="form-control reservation-fields" placeholder="Nombre de passagers *" value="<?php if(!empty($_POST['nb_passengers'])) {echo $_POST['nb_passengers'];} ?>">
                        </div> 
                        <p class="text-danger">
                            <?php if(!empty($errorMessage['passengers'])) echo $errorMessage['passengers']; ?>
                        </p>
                        <div class="form-group2 mt-2 text-left mb-3"> 
                            <label for="insurance"></label> 
                            <input type="checkbox" name="insurance">  Assurance annulation (20 euros par passager)</input>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary mt-1">Validez</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main> 

<?php

FlightsListView::renderWithoutReservationButton($searchFlight);

?>