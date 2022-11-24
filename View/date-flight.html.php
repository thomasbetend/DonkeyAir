<main role="main" class="bg-grey-light">
    <div class="py-5 text-center container top-section">
        <div class="row py-lg-1">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="title-index-1">DonkeyAir</h1>
                <h4 class="text-center mt-2 mb6">Les vols du <?php echo $date->format("d/m/Y"); ?></h4>
            </div>
        </div>
    </div>
</main>

<?php 

FlightsListView::render($flights);

?>