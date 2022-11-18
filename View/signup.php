<?php include_once('header.php'); ?>

<?php if($_POST) ?>

<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h3 class="title-reservations-1">DonkeyAir</h3>
                <h4 class="title-reservations-2">Inscrivez-vous</h4>
            </div>
        </div>

        <div class="container w-50">
            <div class=""></div>
                <form action = "" method="post" class="">
                    <div class="form-group2">
                        <label for="user_firstname"></label> 
                        <input type="text" id="firstname" name="user_firstname" class="form-control connection-field" placeholder="Prénom *" value="<?php ?>">
                    </div>
                    <div class="form-group">
                        <label for="user_lastname"></label>
                        <input type="text" id="lastname" name="user_lastname" class="form-control connection-field" placeholder="Nom *" value="<?php ?>">
                    </div>
                    <div class="form-group">
                        <label for="user_email"></label>
                        <input type="email" id="email" name="user_email" class="form-control connection-field" placeholder="Email *" value="<?php ?>">
                    </div>
                    <div class="form-group mb-2 mt-1">
                        <label for="user_password"></label>
                        <input type="password" id="password" name="user_password" class="form-control connection-field" placeholder="Mot de passe *" value="<?php ?>">
                    </div>
                    <div class="errorMessage">
                        <?php ?>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mt-2">Connexion</button>
                    </div>
                </form>
                <p class="mt-4 text-secondary"><a href="login.php">Déjà inscrit ? Connectez-vous.</a></p>
            </div>
        </div>
    </div>
</main> 

<?php include_once('footer.php'); ?>

</body>
</html>