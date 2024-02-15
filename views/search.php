<section class="container">
    <h2 class="text-center p-5"><?= $title ?></h2>
    <div class="row justify-content-center">
        <form class="col-12 d-flex mb-5 justify-content-center">
            <input id="inputSearch" class="form-control rounded-0" type="search" placeholder="Entrez vos mots clés ici..." name="keywords" value="<?= $keywords ?? '' ?>" aria-label="Search">
            <button class="btn text-white rounded-0" type="submit"><i class="bi bi-search"></i></button>
        </form>

        <?php
        if (is_null($keywords)) {
            $posts = array();
        } else {
            if (empty($posts)) { ?>
                <p class="text-center fw-bold">Désolée, il n'y a pas de résultats trouvés
                <p>
                    <?php } else {
                    foreach ($posts as $post) { ?>
                        <!-- article card  -->
                <div class="col-12 col-md-6 col-lg-4 mb-5 ">
                    <div class="card h-100">
                        <?php if (!is_null($post->photo)) {
                            echo "<img src=\"/public/uploads/posts/$post->photo\" class=\"h-100 card-img-top img-fluid\" alt=\"\">";
                        } ?>
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?= $post->title ?></h5>
                            <p class="text-justify text-truncate"><?= $post->content ?></p>
                            <a href="../controllers/post_detail-ctrl.php?id_post=<?= $post->id_post ?>" target="_blank" class="btn btn-primary" id="btn-send-connexion">Lire plus</a>
                        </div>
                    </div>
                </div>
    <?php }
                }
            } ?>
    </div>
</section>