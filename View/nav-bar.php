<?php 

require('../Connection/Session.class.php');
Session::creation();

?>

<nav class="navbar navbar-expand-md navbar-dark navbar-DonkeyAir ml-15">
  <a class="navbar-brand ml-5" href="./home.php">DonkeyAir</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <?php if(!empty($_SESSION['admin'])): ?>
        <li class="nav-item text-black">
          <a class="nav-link text-black" href="./add-flight.php">Ajoutez un vol</a>
        </li>
      <?php endif ?>
      <?php if(!empty($_SESSION['login'])): ?>
        <li class="nav-item active">
          <a class="nav-link" href="./reservation-personal-space.php">Réservations</a>
        </li>
        <li class="nav-item text-white">
          <a class="nav-link" href="./logout.php">Déconnexion</a>
        </li>
        <li class="nav-item text-white welcome-nav-bar">
          <p class="pt-4">Bienvenue <?php echo ucwords($_SESSION['login']); ?></p>
        </li>
        <li class="nav-item text-white cart">
          <a class="nav-link cart" href="./cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
        </li>
        <li class="nav-item text-white welcome-nav-bar">
        <a class="nav-link" href="./cart.php">Panier</a>
        </li>
      <?php else: ?>
        <li class="nav-item text-white">
          <a class="nav-link" href="./login.php">Connexion</a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>


