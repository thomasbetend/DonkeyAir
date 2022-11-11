<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/jumbotron/">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bowlby+One&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5474cfcdca.js" crossorigin="anonymous"></script>
    <link href="styles.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5474cfcdca.js" crossorigin="anonymous"></script>

</head>


<body class="d-flex flex-column h-100">

<?php include_once('nav-bar.php'); ?>


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