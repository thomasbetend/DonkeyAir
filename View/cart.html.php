<?php
require('./View/brand.php');
?>

<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="title-index-1"><?= $brand ?></h1>
                <i class="fa-solid fa-cart-shopping picto-page"></i>
                <?php if(!empty($_SESSION['cart_price_total']) && $_SESSION['cart_price_total'] !== 0): ?>
                    <h4 class="text-center mt-2 mb6">Votre panier</h4>
                    <h5 class="text-center mt-2 mb6">Prix total : <?php echo $_SESSION['cart_price_total'] ?> €</h5>
                <?php else: ?>
                    <h4 class="text-center mt-2 mb6">Panier vide</h4>
                <?php endif; ?>    
            </div>
        </div>
    </div>
</main>

<?php if(!empty($_SESSION['cart_price_total']) && $_SESSION['cart_price_total'] !== 0): ?>
    <div class="container w-50 text-center">
        <form>
            <div>
                <a type="submit" class="btn btn-primary mt-3 mb-2" href="/panier/valide">Validez votre panier</a>
            </div>
        </form>
        <a href="/accueil" class="text-center mt-1 mb-3" >Ajoutez un autre vol</a>
    </div>
<?php endif; ?>



