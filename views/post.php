<section class="container">
    <h2 class="text-center p-5">Se loger</h2>
    <div class="row">

        <?php foreach ($accommodationArticles as $accommodationArticle) { ?>
            <!-- article card  -->
            <div class="col-12 col-md-6 col-lg-4 mb-3 ">
                <div class="card h-100">
                    <?php if (!is_null($accommodationArticle->photo)) {
                        echo "<img src=\"/public/uploads/posts/$accommodationArticle->photo\" class=\"h-100 card-img-top img-fluid\" alt=\"\">";
                    } ?>
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><?= $accommodationArticle->title ?></h5>
                        <p class="text-justify text-truncate"><?= $accommodationArticle->content ?></p>
                        <a href="../controllers/accommodation_detail-ctrl.php?id_post=<?= $accommodationArticle->id_post ?>" target="_blank" class="btn btn-primary" id="btn-send-connexion">Lire plus</a>
                    </div>
                </div>

            </div>
        <?php } ?>
    </div>

    <div class="center py-3">
        <div class="pagination">
            <!-- page précédente -->
            <a href="?page=<?= $previousPage ?>">&laquo;</a>
            <!-- détail des pages -->
            <?php
            for ($counter = 1; $counter <= $nbOfPages; $counter++) {
                if ($counter == $page) {
                    echo "<a class=\"active\" href=\"?page=$counter\">$counter</a>";
                } else {
                    echo "<a href=\"?page=$counter\">$counter</a>";
                }
            } ?>
            <!-- page suivante -->
            <a href="?page=<?= $nextPage ?>">&raquo;</a>
        </div>
    </div>
</section>