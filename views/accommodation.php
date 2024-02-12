<section class="container">
    <h2 class="text-center p-5">Se loger</h2>
    <div class="row">
        
    <!-- article card 1 -->
        <div class="col-12 col-md-6 col-lg-4 mb-3 ">
            <div class="card h-100">
                <img src="../public/assets/img/amiens_quartier_st_leu.webp" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Où habite à Amiens ?</h5>
                    <p class="text-justify">Vous avez décidé de venir habiter à Amiens ? Mais connaissez-vous bien la ville et ses différents quartiers ? Savez-vous où habiter à Amiens ?</p>
                    <a href="../controllers/accommodation_detail-ctrl.php" class="btn btn-primary" id="btn-send-connexion">Lire plus</a>
                </div>
            </div>
        </div>







    

      
    </div>

    <div class="center">
        <div class="pagination">
            <!-- page précédente -->
            <a href="?page=<?= $previousPage ?>&id_category=<?= $id_category ?>">&laquo;</a>
            <!-- détail des pages -->
            <?php
            for ($counter = 1; $counter <= $nbOfPages; $counter++) {
                if ($counter == $page) {
                    echo "<a class=\"active\" href=\"?page=$counter&id_category=$id_category\">$counter</a>";
                } else {
                    echo "<a href=\"?page=$counter&id_category=$id_category\">$counter</a>";
                }
            } ?>
            <!-- page suivante -->
            <a href="?page=<?= $nextPage ?>&id_category=<?= $id_category ?>&keywords=<?= $keywords ?>">&raquo;</a>
        </div>
    </div>
</section>