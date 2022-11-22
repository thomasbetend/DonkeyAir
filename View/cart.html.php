<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="title-index-1">DonkeyAir</h1>
                <?php if(!empty($_SESSION['cart_price']) && $_SESSION['cart_price'] !== 0): ?>
                    <h4 class="text-center mt-2 mb6">Votre réservation</h4>
                    <h5 class="text-center mt-2 mb6">Prix total : <?php if(!empty( $_SESSION['cart_price'])) echo $_SESSION['cart_price'] ?> €</h5>
                <?php endif; ?>    
            </div>
        </div>
    </div>
</main>

<?php if(!empty($_SESSION['cart_price']) && $_SESSION['cart_price'] !== 0): ?>
    <div class="container w-50 text-center">
        <form method="POST">
            <div>
                <button type="submit" class="btn btn-primary mt-3 mb-2">Validez votre réservation</button>
            </div>
        </form>
        <a href="/accueil" class="text-center mt-1 mb-3" >Ajouter un autre vol</a>
    </div>
<?php endif; ?>



