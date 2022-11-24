<?php
require('./View/brand.php');
?>

<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <!-- <h1 class="title-index-1">DonkeyAir</h1> -->
                <?php echo $brandLogo ?> 
                <h4 class="text-center mt-2 mb6">Évadez-vous dans les airs</h4>
            </div>
        </div>

        <form method="POST" class="text-center mt-2 small" id="">
            <div class="form-group index-search-form">  
                <select name="departure" id="index-select" class="index-select">
                    <option value="">Départ</option> 
                    <?php foreach($airports as $airport): ?>
                        <option value="<?php echo $airport->getId(); ?>" <?php if(!empty($_POST['departure']) && $_POST['departure'] == $airport->getId()) echo "selected"; ?>>
                            <?php echo $airport->getName(); ?>
                        </option> 
                    <?php endforeach; ?>
                </select>
                <select name="arrival" id="index-select" class="index-select">
                    <option value="">Arrivée</option> 
                    <?php foreach($airports as $airport): ?>
                        <option value="<?php echo $airport->getId(); ?>" <?php if(!empty($_POST['arrival']) && $_POST['arrival'] == $airport->getId()) echo "selected"; ?>>
                            <?php echo $airport->getName(); ?>
                        </option> 
                    <?php endforeach; ?>
                </select>
                <input type="date" id="around_date" name="around_date" class="index-search-date" value="<?php if(!empty($_POST['around_date'])){echo $_POST['around_date'];} else {echo "25/11/2022";} ?>" placeholder="Date de départ" onfocus="(this.type='date')" onblur="(this.type='date')"></input>
            </div> 
            <div class="button-search">
                <button type="submit" class="btn btn-primary small mt-4 mb-3 pl-4" id="buttonSearch">Recherchez un vol</button>
            </div>
        </form>
    </div>
</main> 

<?php if(empty($_POST) || (($_POST['arrival'] === '') && ($_POST['departure'] === '') && ($_POST['around_date'] === ''))): ?>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <?php

                $promo1 = new Promos ('Berlin', 8, 210, '../_medias/berlin-header.png');

                $promo2 = new Promos ('Londres', 7, 300, '../_medias/london-header.png');

                $promo3 = new Promos ('New-York', 10, 550, '../_medias/NYC-header.png');

                $promos = [$promo1, $promo2, $promo3];
                PromosListView::render($promos);

                ?>
            </div>
        </div>
    </div>
<?php else : ?>
    <?php if(empty($flights)): ?>
        <p class="mt-4 text-center text-secondary"><?php echo "Pas de résultats pour votre recherche" ?></p>
        <a href="/accueil" id="initSearch" class="text-center">Réinitialisez la recherche</a><br/>
    <?php endif; ?>
    <?php
    
    FlightsListView::render($flights);

    ?>
<?php endif; ?>


<script type="text/javascript">
    window.onload = () => {
        document.getElementById('min_date').type = "text";
        document.getElementById('max_date').type = "text";
    };

</script>

</body>
</html>