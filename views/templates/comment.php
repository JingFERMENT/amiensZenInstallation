<div class="container">
  <hr>
  <h4>Laisser un commentaire</h4>
  <div class="card py-3 border-0">
    <div class="d-flex w-100">
      <img class="rounded-circle shadow-1-strong me-3 d-none d-sm-block" src="../public/assets/img/Testimonial_2.webp" alt="avatar" />
      <!-- FORMULAIRE COMMENTAIRE -->
      <form class="form-outline w-100" method="POST">
        <textarea class="form-control" id="description" maxlength="500" name="description" rows="2" placeholder="Laisser un message">Hello</textarea>
        <button id="send_comment" type="submit" class="btn my-3 text-white">Envoyer</button>
      </form>
    </div>
  </div>
</div>

<div class="container">
  <!-- AFFICHAGE COMMENTAIRES -->
  <?php if (!($comments == NULL)) { ?>
    <hr>
    <h4>Les commentaires</h4>
  <?php } ?>
  <?php foreach ($comments as $comment) {
    if (!is_null($comment->validated_at)) { ?>
      <div class="card py-3 border-0">
        <div class="d-flex w-100">
          <img id="profile_comment" class="rounded-circle shadow-1-strong me-3 d-none d-sm-block" src="../public/assets/img/Testimonial_2.webp" alt="avatar" />
          <div class="rounded-3 bg-body-secondary px-3 py-1">
            <small class="fw-bold mb-1"><?= $comment->firstname ?> <?= $comment->lastname ?>:</small>
            <small class="mb-0">
              <?= $comment->description ?>
            </small>
            <br>
            <small class="mb-0 fst-italic">
              <?= (new DateTime($comment->validated_at))->format('d-m-Y')
              ?>
            </small>
          </div>
        </div>
      </div>
  <?php }
  } ?>
</div>