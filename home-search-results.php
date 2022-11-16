

<?php 

include_once('header.php');
require('ListFlights.class.php');

?>


<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
            <div class="row py-lg-1">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="mt-0">DonkeyAir</h1>
                    <h4 class="text-center mt-2 mb6">Évadez-vous dans les airs</h4>
                </div>
            </div>

            <form method="POST" action="" class="text-center mt-2 small" id="">
                <div class="form-group index-search-form">  
                    <select name="departure" id="index-select">
                        <option value="">Aéroport de départ</option> 
                    </select>
                    <select name="arrival" id="index-select">
                        <option value="">Aéroport d'arrivée</option> 
                    </select>
                    <input type="date" id="departure-date" name="departure-date" class="index-search" placeholder="" value="today" ></input>
                    <input type="date" id="arrival-date" name="arrival-date" class="index-search" placeholder="" value="" ></input>
                </div> 
                <div class="button-search-hidden">
                    <button type="submit" class="btn btn-primary small mt-3 mb-3 pl-4" id="buttonSearchHidden">Recherchez un vol</button>
                </div>
            </form>
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
                        <button type="button" class="btn btn-sm btn-primary">Réservez</button>
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
                        <button type="button" class="btn btn-sm btn-primary">Réservez</button>
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
                        <button type="button" class="btn btn-sm btn-primary">Réservez</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once('footer.php'); ?>

</body>
</html>