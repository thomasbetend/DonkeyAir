<?php foreach($reservations as $reservation): ?>
    <div class="card mt-4 pt-2 pb-0 each-search-result">
        <div class="card-body">
            <div class="d-flex flex-row justify-content-between card-flight">
                <div class="d-flex flex-column justify-content-between card-flight-2">
                    <h4 class="hours-search-results">Réservation n° <?php echo $reservation->getId(); ?></h4>
                    <!-- <p class="text-secondary">18/12/2022</p> -->
                </div>
                <div class="d-flex flex-column justify-content-between">
                    <!-- <h6 class="text-secondary"><i class="fa-solid fa-clock"></i> 5h 40min</h6> -->
                </div>
                <div class="d-flex flex-column justify-content-start text-right align-items-center">
                    <h4 class="hours-search-results"><?php echo $reservation->getPrice(); ?> €</h4>
                    <div class="btn-group">
                        <a type="button" class="btn btn-sm btn-primary detail-reservation" href="reservation-details.php?id=<?php echo $reservation->getId(); ?>">
                            Détails
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>