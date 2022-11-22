<?php foreach ($flights as $flight): ?>
    <?php
    $searchDepartureAirport = AirportRepository::getList(
        [
        "id" => $flight->getDepartureAirportId(), 
        "airport_name" => '',
        ]
    );
    $searchArrivalAirport = AirportRepository::getList(
        [
        "id" => $flight->getArrivalAirportId(), 
        "airport_name" => '',
        ]
    );
    ?>
    <div class="container w-75">
        <div class="card mt-4 pt-2 pb-0 each-search-result">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between card-flight">
                    <div class="d-flex flex-column justify-content-between card-flight-2">
                        <h4 class="hours-search-results">
                            <?php echo $flight->getDepartureHour()?> - <?php echo $flight->getArrivalHour()?>
                        </h4>
                        <p class="destination-search-result"><?php echo $searchDepartureAirport[0]->getName() . " -> " . $searchArrivalAirport[0]->getName(); ?></p>
                        <p class="text-secondary"><?php echo $flight->getDepartureDate(); ?></p>
                    </div>
                    <div class="d-flex flex-column justify-content-between">
                        <h6 class="text-secondary"><i class="fa-solid fa-clock"></i> 
                        
                            <?php echo $flight->getDuration(); ?>
                        </h6>
                    </div>
                    <div class="d-flex flex-column justify-content-start text-right align-items-center">
                        <h4 class="hours-search-results"><?php echo $price; ?> €</h4>
                            <p><?php echo $nb_passengers; ?> passagers</p>
                            <div class="btn-group">
                                <a type="button" class="btn btn-sm btn-secondary detail-reservation" href="cart-supp.php?id=<?php echo $flight->getId(); ?>">Supprimez ce vol</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>