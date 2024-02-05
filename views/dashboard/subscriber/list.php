<div class="card border-2 text-center">
    <div class="p-5">
        <h1 class="p-5">Liste des abonnés</h1>
        <span class="text-info fw-bold"><?= $msg ?? '' ?></span>
        <span class="text-danger fw-bold"><?= $error ?? '' ?></span>
        <!-- LISTE DES ABONNEES -->
        <div class="d-flex justify-content-end gap-5 pt-5">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Inscrit le</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($subscribers as $subscriber) { ?>
                        <tr>
                            <th scope="row" class="fst-italic fw-normal"><?= $subscriber->id_subscriber ?></th>
                            <td><?= $subscriber->lastname ?></td>
                            <td><?= $subscriber->firstname ?></td>
                            <td><?= $subscriber->email ?></td>
                            <td><?= (new DateTime($subscriber->subscribed_at))->format('d-m-Y') ?></td>
                            <!-- Button trigger modal -->
                            <td><a type="button" data-id="<?= $subscriber->id_subscriber ?>" data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-dark modalOpenSubscriberDeleteBtn"><i class="fa-solid fa-trash-can"></i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Supprimer un abonné</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Pouvez-vous confirmer votre choix ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger deleteSubscriberBtn" data-bs-dismiss="modal">Oui</button>
                <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Non</button>
            </div>
        </div>
    </div>
</div>