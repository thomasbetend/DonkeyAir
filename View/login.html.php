<?php
require('./View/brand.php');
?>

<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h3 class="title-reservations-1"><?= $brand ?> </h3>
                <i class="fa-solid fa-user picto-page"></i>
                <h4 class="title-reservations-2">Connectez-vous</h4>
            </div>
        </div>

        <div class="container w-50">
            <div class="form-login">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="user_email"></label>
                        <input type="email" id="email" name="user_email" class="form-control connection-field" placeholder="Email *" value="<?php if(!empty($_POST['user_email'])) echo $_POST['user_email']; ?>">
                    </div>
                    <div class="form-group mb-2 mt-1">
                        <label for="user_password"></label>
                        <input type="password" id="password" name="user_password" class="form-control connection-field" placeholder="Mot de passe *" value="<?php if(!empty($_POST['user_password'])) echo $_POST['user_password']; ?>">
                    </div>
                    <div class="errorMessage">
                        <?php ?>
                    </div>
                    <div class="text-center text-danger mt-2">
                        <?php if (!empty($errorMessage['fields'])) echo $errorMessage['fields'] ;?>
                        <?php if (!empty($errorMessage['incorrect'])) echo $errorMessage['incorrect'] ;?>

                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mt-2">Connexion</button>
                    </div>
                    <p class="mt-4 text-secondary"><a href="./inscription">Pas encore inscrit ? Créez un compte.</a></p>
                </form>
            </div>
        </div>
    </div>
</main> 

</body>
</html>