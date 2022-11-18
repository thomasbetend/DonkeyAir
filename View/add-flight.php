<?php include_once('header.php'); ?>

<?php 

require('../Security/Security.class.php');
require('../Connection/Database.class.php');
require('../Model/User.class.php');
require('../Model/UserRepository.class.php');

Security::isloggedIn($_SESSION);

if($_POST) {


}
?>

<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h3 class="title-reservations-1">DonkeyAir</h3>
                <h4 class="title-reservations-2">Ajoutez un vol</h4>
            </div>
        </div>
        <div class="container w-50 ">
                <form action = "" method="post" class="mt-3">
                    <div class="form-group mb-1">
                        <label for="flight_name" class="text-secondary"></label>
                        <input type="text" id="flight-flight_name" name="flight_name" class="form-control connection-field" Placeholder="Numéro de vol *" value="<?php if(!empty($_POST['flight_name'])){echo $_POST['flight_name'];}?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="price" class="text-secondary"></label>
                        <input type="number" step="0.01" id="price" name="price" placeholder="Prix *" class="form-control connection-field" value="<?php if(!empty($_POST['price'])){echo $_POST['price'];}?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="departure_airport" class="text-secondary"></label>
                        <input type="text" id="departure_airport" name="departure_airport" class="form-control connection-field" Placeholder="Aéroport de départ *" value="<?php if(!empty($_POST['departure_airport'])){echo $_POST['departure_airport'];}?>">
                    </div>
                    <div class="form-group mb-1">
                        <label for="arrival_airport" class="text-secondary"></label>
                        <input type="text" id="arrival_airport" name="arrival_airport" class="form-control connection-field" Placeholder="Aéroport d'arrivée *" value="<?php if(!empty($_POST['arrival_airport'])){echo $_POST['arrival_airport'];}?>">
                    </div>
                    <div class="form-group mb-2">
                        <label for="departure_date" class="text-secondary"></label>
                        <input type="date" id="departure_date" name="departure_date" class="form-control connection-field" placeholder="<?php if(!empty($_POST['departure_date'])) {echo $dt->format("d/m/Y");} else {echo "Date de départ *";} ?>" onfocus="(this.type='date')" onblur="(this.type='text')">
                    </div>
                    <div class="form-group mb-2">
                        <label for="arrival_date" class="text-secondary"></label>
                        <input type="date" id="arrival_date" name="arrival_date" class="form-control connection-field" placeholder="<?php if(!empty($_POST['arrival_date'])) {echo $dt->format("d/m/Y");} else {echo "Date d'arrivée *";} ?>" onfocus="(this.type='date')" onblur="(this.type='text')">
                    </div>
                    <div class="form-group mb-2">
                        <label for="nb_seats" class="text-secondary"></label>
                        <input type="number" id="nb_seats" name="nb_seats" placeholder="Nombre de sièges *" class="form-control connection-field" value="<?php if(!empty($_POST['nb_seats'])){echo $_POST['nb_seats'];}?>">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mt-2">Ajoutez</button>
                    </div>
                </form>
        </div>
</main>

<?php include_once('footer.php'); ?>

<script type="text/javascript">
    window.onload = () => {
        document.getElementById('departure_date').type = "text";
        document.getElementById('arrival_date').type = "text";
    };

</script>

</body>
</html>


