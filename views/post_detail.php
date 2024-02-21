<section class="container">
    <div class="py-5">
        <article>
            <h1 class="text-center pb-5"><?=$post->title?></h1>
            <div>
                <div class="py-3">
                    <small class="text-body-secondary"><?=$post->firstname?> <?=$post->lastname?> | <?=(new DateTime($post->published_at))->format('d-m-Y')?></small>
                </div>
                <div>
                    <img src="/public/uploads/posts/<?=$post->photo?>" class="card-img-top" alt="image de l'article <?=$post->title?>">
                </div>
                <div class="article-content px-2 pt-5">
                    <p class="description">
                        <!-- nl2br: new line to br // html_entity_decode : Convert HTML entities to their corresponding characters-->
                    <?=nl2br(html_entity_decode($post->content))?>
                    </p>
                </div>
            </div>
        </article>
    </div>
</section>