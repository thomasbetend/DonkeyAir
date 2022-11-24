    <div class="container w-75">
        <div class="card mt-4 pt-2 pb-0 each-search-result">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between card-flight">
                    <div class="d-flex flex-column justify-content-between card-flight-2">
                        <h4 class="hours-search-results">
                            <?php echo $flight[0]->getDepartureHour()?> - <?php echo $flight[0]->getArrivalHour()?>
                        </h4>
                        <p class="destination-search-result"><?php echo $searchDepartureAirport[0]->getName() . " -> " . $searchArrivalAirport[0]->getName(); ?></p>
                        <p class="text-secondary"><?php echo $flight[0]->getDepartureDate(); ?></p>
                    </div>
                    <div class="d-flex flex-column justify-content-between">
                        <h6 class="text-secondary"><i class="fa-solid fa-clock"></i> 
                        
                            <?php echo $flight[0]->getDuration(); ?>
                        </h6>
                    </div>
                    <div class="d-flex flex-column justify-content-start text-right align-items-center">
                        <h6 class = "text-secondary"> Prix :  <?php echo $reservationFlight->getPrice(); ?> €</h6>
                        <p> Nombre de passagers : <?php echo $reservationFlight->getNbPassengers(); ?></p>
                        <p class="text-danger insurance-mention"> <?php if($userFlight[0]->getInsurance() === true) echo "Assurance annulation"; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>