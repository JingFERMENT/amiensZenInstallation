<div class="card border-2 text-center">
    <div class="p-5">
        <h1 class="p-5">Liste des commentaires</h1>
        <span class="text-info fw-bold"><?= $msg ?? '' ?></span>
        <span class="text-danger fw-bold"><?= $error ?? '' ?></span>
        <!-- LISTE DES COMMENTAIRES -->
        <div class="d-flex justify-content-end gap-5 pt-5">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Auteur</th>
                        <th scope="col">Commentaires</th>
                        <th scope="col">Status</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($comments as $comment) { ?>
                        <tr>
                            <th scope="row" class="fst-italic fw-normal"><?= $comment->id_comment ?></th>
                            <td><?= $comment->firstname . ' ' . $comment->lastname ?></td>
                            <td><?= $comment->description ?></td>
                            <?php
                            if ($comment->validated_at == NULL) {?>
                            <td><a type="button" href="/controllers/dashboard/comment/validate-ctrl.php?id_comment=<?= $comment->id_comment ?>" class="btn btn-danger btn-sm" id="btnToValidate">A valider</a></td>                       
                            <?php } else {?>
                              <td>Validé le <?=(new DateTime($comment->validated_at))->format('d-m-Y') ?></td>  
                              <?php }?>
                            <!-- Button trigger modal -->
                            <td><a type="button" data-id="<?= $comment->id_comment ?>" data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-dark modalOpenCommentDeleteBtn"><i class="fa-solid fa-trash-can"></i></a></td>
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
                <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Supprimer un commentaire</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Pouvez-vous confirmer votre choix ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger deleteCommentBtn" data-bs-dismiss="modal">Oui</button>
                <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Non</button>
            </div>
        </div>
    </div>
</div>