<?php foreach($promos as $promo): ?>
    <div class="col-md-4">
        <div class="card mb-4 box-shadow">
            <img class="card-img-top" alt="Thumbnail [100%x225]" src= "<?php echo $promo->getImg() ?>" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
            <div class="card-body">
                <h4>Visitez <?php echo $promo->getName() ?> à partir de </br> <?= $promo->getPrice() ?> euros</h4>
                <p class="card-text"></p>
                <div class="d-flex justify-content-between align-items-center">
                    <a type="button" class="btn btn-sm btn-primary detail-reservation" href="reservation-validation.php?id= <?php echo $promo->getId_flight() ?>">Réservez</a>
                </div>
            </div>
        </div>
    </div>
    
<?php endforeach; ?>