<?php include_once('header.php'); ?>


<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="title-index-1">DonkeyAir</h1>
                <h4 class="text-center mt-2 mb6">Évadez-vous dans les airs</h4>
            </div>
        </div>

        <?php

        require('FlightsList.class.php');

        $sql = 'SELECT DISTINCT departure_airport FROM flight';
        $flightsList = new FlightsList($sql);
        $flights = $flightsList->getList();

        ?>

        <form method="POST" action="home-search-results.php" class="text-center mt-2 small" id="">
            <div class="form-group index-search-form">  
                <select name="departure" id="index-select">
                    <?php foreach($flights as $flight): ?>
                        <option value=""><?php echo $flight->getDepartureAirport(); ?></option> 
                    <?php endforeach; ?>
                </select>
                <select name="arrival" id="index-select">
                    <option value="">Aéroport d'arrivée</option> 
                </select>
                <input type="date" id="departure-date" name="departure-date" class="index-search" placeholder="Date de départ" onfocus="(this.type='date')" onblur="(this.type='text')"></input>
            </div> 
            <div class="button-search">
                <button type="submit" class="btn btn-primary small mt-3 mb-3 pl-4" id="buttonSearch">Recherchez un vol</button>
            </div>
        </form>
    </div>
</main> 

<?php


$sql = 'SELECT * FROM flight';

$flightsList1 = new FlightsList($sql);

$flights = $flightsList1->getList();

?>

<div>
    <?php foreach($flights as $flight): ?>
        <h3><?php echo $flight->getDuration(); ?></h3>
    <?php endforeach; ?>
</div>

    

<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" alt="Thumbnail [100%x225]" src="/_medias/ny01.webp" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
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
                    <img class="card-img-top" alt="Thumbnail [100%x225]" src="/_medias/ny01.webp" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
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
                    <img class="card-img-top" alt="Thumbnail [100%x225]" src="/_medias/ny01.webp" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
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

<script type="text/javascript">
    window.onload = () => {
        document.getElementById('departure-date').type = "text";
    };

</script>

</body>
</html>