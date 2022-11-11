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
                <h3 class="title-reservations-1">DonkeyAir</h3>
                <h4 class="title-reservations-2">Connectez-vous</h4>
            </div>
        </div>

        <div class="container w-50">
            <div class=""></div>
                <form action = "" method="post" class="">
                    <div class="form-group2">
                        <label for="user_firstname"></label> 
                        <input type="text" id="firstname" name="user_firstname" class="form-control connexion-field" placeholder="Prénom *" value="<?php ?>">
                    </div>
                    <div class="form-group">
                        <label for="user_lastname"></label>
                        <input type="text" id="lastname" name="user_lastname" class="form-control connexion-field" placeholder="Nom *" value="<?php ?>">
                    </div>
                    <div class="form-group">
                        <label for="user_email"></label>
                        <input type="email" id="email" name="user_email" class="form-control connexion-field" placeholder="Email *" value="<?php ?>">
                    </div>
                    <div class="form-group mb-2 mt-1">
                        <label for="user_password"></label>
                        <input type="password" id="password" name="user_password" class="form-control connexion-field" placeholder="Mot de passe *" value="<?php ?>">
                    </div>
                    <div class="errorMessage">
                        <?php ?>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mt-2">Connexion</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main> 

<?php include_once('footer.php'); ?>

</body>
</html>