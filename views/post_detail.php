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
                    <?=nl2br($post->content)?>
                    </p>
                </div>
            </div>
        </article>
    </div>
</section>