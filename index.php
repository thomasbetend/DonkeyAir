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
                    <h1 class="title-index-1">DonkeyAir</h1>
                    <h4 class="text-center mt-2 mb6">Évadez-vous dans les airs</h4>
                </div>
            </div>

            <form method="POST" action="index-search-results.php" class="text-center mt-2 small" id="">
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
<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" alt="Thumbnail [100%x225]" src="/_src/ny01.webp" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                    <div class="card-body">
                        <h4>Visitez New York pour seulement 399 euros</h4>
                        <p class="card-text"></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary">Réservez</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" alt="Thumbnail [100%x225]" src="/_src/ny01.webp" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                    <div class="card-body">
                        <h4>Visitez New York pour seulement 399 euros</h4>
                        <p class="card-text"></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary">Réservez</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" alt="Thumbnail [100%x225]" src="/_src/ny01.webp" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                    <div class="card-body">
                        <h4>Visitez New York pour seulement 399 euros</h4>
                        <p class="card-text"></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary">Réservez</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once('footer.php'); ?>

</body>
</html>