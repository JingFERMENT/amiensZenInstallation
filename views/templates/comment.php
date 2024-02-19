<?php if (!empty($_SESSION['subscriber'])) { ?>
  <div class="container">
    <hr>
    <h4>Laisser un commentaire</h4>
    <div class="card py-3 border-0">
      <div class="d-flex w-100">
        <?php if (!is_null($_SESSION['subscriber']->profile_picture)) { ?>
          <img id="profile_comment" class="rounded-circle shadow-1-strong me-3 d-none d-sm-block" src="../public/uploads/users/<?= $_SESSION['subscriber']->profile_picture ?>" alt="avatar" />
        <?php } else { ?>
          <img id="profile_comment" class="rounded-circle shadow-1-strong me-3 d-none d-sm-block" src="/public/assets/img/default-avatar-profile.jpg" alt="photo profile par défaut">
        <?php } ?>
        <!-- FORMULAIRE COMMENTAIRE -->
        <form class="form-outline w-100" method="POST">
          <textarea class="form-control" id="description" maxlength="500" name="description" rows="2" placeholder="Laisser un message"></textarea>
          <button id="send_comment" type="submit" class="btn my-3 text-white">Envoyer</button>
        </form>
      </div>
    </div>
  </div>
<?php } ?>

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
          <?php if (!empty($comment->profile_picture)) { ?>
            <img id="profile_comment" class="rounded-circle shadow-1-strong me-3 d-none d-sm-block" src="../public/uploads/users/<?= $comment->profile_picture ?>" alt="avatar" />
          <?php } else { ?>
            <img id="profile_comment" class="rounded-circle shadow-1-strong me-3 d-none d-sm-block" src="/public/assets/img/default-avatar-profile.jpg" alt="photo profile par défaut">
          <?php } ?>
          <div class="rounded-3 bg-body-secondary px-3 py-1">
            <small class="fw-bold mb-1"><?= $comment->firstname ?> <?= $comment->lastname ?></small>
            <small class="mb-0 fst-italic ext-secondary">
              <?php 
                $date = new DateTime($comment->validated_at);
                $formDate = $date->format('d F Y à H:i');
                $formatter = new IntlDateFormatter('fr_FR');
                $formatter->setPattern('dd MMMM yyyy à hh:mm');
                $frenchDate =  $formatter->format($date);
                echo $frenchDate; 
              ?>
            </small><br>
            <p class="mb-0">
              <?= $comment->description ?>
            </p>
          </div>
        </div>
      </div>
  <?php }
  } ?>
</div>