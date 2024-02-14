<div class="container">
    <div class="py-5">
        Bienvenue <?= $connectedSubscriber->firstname ?><?= $connectedSubscriber->lastname ?>
        (<?= $connectedSubscriber->email ?>)
    </div>


    <?php if ($_SESSION['subscriber']->is_admin == 1) { ?>
        <a type="button" class="btn btn-info text-white" href="/controllers/dashboard/subscriber/list-ctrl.php">Accès Dashboard Admin</a>
    <?php } ?>
</div>