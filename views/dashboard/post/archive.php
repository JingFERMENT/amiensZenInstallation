<div class="card border-2 text-center">
    <div class="p-5">
        <h1 class="pt-5">Liste des articles archivés</h1>
        <span class="text-info fw-bold"><?= $msg ?? '' ?></span>
        <span class="text-danger fw-bold"><?= $error ?? '' ?></span>
        <div class="d-flex justify-content-end">
            <a href="/controllers/dashboard/post/list-ctrl.php" id="btn-add" class="btn my-4 text-white ml-2">Retour à la liste des articles</a>
        </div>
        <!-- LISTE DES ABONNEES -->
        <div class="d-flex justify-content-end gap-5 pt-5">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Auteur</th>
                        <th scope="col">Date de publication</th>
                        <th scope="col">Voir l'article</th>
                        <th scope="col">Déarchiver</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($posts as $post) { ?>
                        <tr>
                            <th scope="row" class="fst-italic fw-normal"><?= $post->id_post ?></th>
                            <td><?= $post->title ?></td>
                            <td><?= $post->firstname . ' ' . $post->lastname ?></td>
                            <td><?= (new DateTime($post->published_at))->format('d-m-Y') ?></td>
                            <td><a class="text-dark" href="/controllers/post_detail-ctrl.php?id_post=<?= $post->id_post ?>"><i class="fa-solid fa-link"></i></a></td>
                            <td><a class="text-dark" href="/controllers/dashboard/post/unarchive-ctrl.php?id_post=<?= $post->id_post ?>"><i class="fa-solid fa-arrow-up-from-bracket"></i></a></td>
                            <!-- Button trigger modal -->
                            <td><a type="button" data-id="<?= $post->id_post ?>" data-bs-toggle="modal" data-bs-target="#deleteModal" class="text-dark modalOpenPostDeleteBtn"><i class="fa-solid fa-trash-can"></i></a></td>
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
                <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Supprimer un article</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Pouvez-vous confirmer votre choix ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger deletePostBtn" data-bs-dismiss="modal">Oui</button>
                <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Non</button>
            </div>
        </div>
    </div>
</div>