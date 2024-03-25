<section class="container">
    <div class="py-5">
        <article>
            <h1 class="text-center pb-5"><?= $post->title ?></h1>
            <div>
                <div class="py-3 d-flex justify-content-between align-items-center">
                    <small class="text-body-secondary"><?= $post->firstname ?> <?= $post->lastname ?> | <?= (new DateTime($post->published_at))->format('d-m-Y') ?></small>
                    <div class="d-flex justify-content-between align-items-center">
                        <?php if (isset($_SESSION['subscriber'])) { ?>
                            <small class="text-blue px-2 fw-bold">Ajouter en favoris</small>
                            <a href="../controllers/favorite-post-ctrl.php?id_post=<?= $post->id_post ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" id="heart" viewBox="0 0 24 24">
                                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </a>
                        <?php } ?>
                        <!-- add favorite article -->
                    </div>
                </div>
                <div>
                    <img src="/public/uploads/posts/<?= $post->photo ?>" class="card-img-top" alt="image de l'article <?= $post->title ?>">
                </div>
                <div class="article-content px-2 pt-5">
                    <p class="description">
                        <!-- nl2br: new line to br // html_entity_decode : Convert HTML entities to their corresponding characters-->
                        <?= nl2br(html_entity_decode($post->content)) ?>
                    </p>
                </div>
            </div>
        </article>
    </div>
</section>