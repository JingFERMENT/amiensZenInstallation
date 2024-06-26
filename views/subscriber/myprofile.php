<!-- Mon profile -->
<section class="container">
    <div class="row justify-content-center align-items-center ">
        <div class="col-12 col-lg-9 col-xl-7">
            <div class="card">
                <div id="banner" class="rounded-top text-white d-flex flex-row">
                    <div class="ms-4 mt-5 d-flex flex-column">
                        <!-- IMAGE PROFILE -->
                        <?php if ($connectedSubscriber->profile_picture !== NULL) { ?>
                            <img id="image-profile" class="img-fluid img-thumbnail mt-4 mb-2" src="<?= '/public/uploads/users/' . $connectedSubscriber->profile_picture ?>" alt="photo profile">
                        <?php } else { ?>
                            <img id="image-profile" class="img-fluid img-thumbnail mt-4 mb-2" src="/public/assets/img/default-avatar-profile.jpg" alt="photo profile">
                        <?php } ?>
                    </div>
                    <div id="myName" class="ms-3">
                        <!-- TITRE -->
                        <h3>Profil de <?= $firstname . ' ' . $lastname ?></h3>
                    </div>
                </div>
                <!-- ACCES ADMIN SI C'EST ADMIN -->
                <div class="p-4 text-black d-flex justify-content-end" style="background-color: #f8f9fa;">
                    <?php if ($_SESSION['subscriber']->is_admin == 1) { ?>
                        <a id="btn-access" type="button" class="btn text-white" href="/controllers/dashboard/subscriber/list-ctrl.php">Accès Admin</a>
                    <?php } ?>
                </div>
                <!-- INFORMATION PERSONNELLE -->
                <div class="p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <p class="lead fw-bold">A propos de moi</p>
                    </div>
                    <?php if (!empty($msg)) { ?>
                        <span class="text-success"><?= $msg ?></span>
                    <?php } ?>
                    <!-- FORM PERSONAL INFO -->
                    <form class="my-4" method="POST" name="personalInfo" enctype='multipart/form-data' novalidate>
                        <div class="row">
                            <!-- LASTNAME -->
                            <div class="col-12 col-md-6 p-1 mb-2">
                                <label for="lastname" class="form-label">Nom</label>
                                <input type="text" name="lastname" class="form-control" id="lastname" value="<?= $lastname ?? '' ?>" placeholder="ex: Dupont" aria-describedby="lastnameHelp" minlength="2" maxlength="50" pattern="<?= REGEX_NAME ?>" autocomplete="family-name" ; required>
                                <span class="text-danger"><?= $error['lastname'] ?? '' ?></span>
                            </div>
                            <!-- FIRSTNAME -->
                            <div class="col-12 col-md-6 p-1 mb-2">
                                <label for="firstname" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $firstname ?? '' ?>" placeholder="ex: Jean" aria-describedby="firstnameHelp" minlength="2" maxlength="50" pattern="<?= REGEX_NAME ?>" autocomplete="given-name" ; required>
                                <span class="text-danger"><?= $error['firstname'] ?? '' ?></span>
                            </div>
                            <!-- EMAIL -->
                            <div class="col-12 col-md-6 p-1 mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="email@email.com" value="<?= $email ?? '' ?>" required>
                                <span class="text-danger"><?= $error['email'] ?? '' ?></span>
                            </div>
                            <!-- BIRTHDATE -->
                            <div class="col-12 col-md-6 p-1 mb-2">
                                <label for="birthdate" class="form-label">Date de naissance</label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate" min="<?= $minDate ?>" max="<?= $maxDate ?>" value="<?= $birthdate ?? '' ?>" pattern="<?= REGEX_BIRTHDATE ?>" aria-describedby="birthdayHelp">
                                <span class="text-danger"><?= $error['birthdate'] ?? '' ?></span>
                            </div>
                            <!-- PHONE -->
                            <div class="col-12 col-md-6 p-1 mb-2">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="tel" name="phone" class="form-control" id="phone" value="<?= $phone ?? '' ?>" placeholder="Entrez votre numéro de téléphone" pattern="<?= REGEX_TELEPHONE ?>">
                                <span class="text-danger"><?= $error['phone'] ?? '' ?></span>
                            </div>
                            <!-- FAMILY SITUATION -->
                            <div class="col-12 col-md-6 p-1 mb-2">
                                <label for="familySituation" class="form-label">Situation familiale</label>
                                <select name="familySituation" class="form-select">
                                    <option selected disabled>---Veuillez sélectionner votre situation familiale---</option>
                                    <?php
                                    foreach (ARRAY_FAMILY_SITUATION as $familySituationInArray) {
                                        $isSelected = ($familySituation && $familySituation == $familySituationInArray) ? 'selected' : '';
                                        echo "<option value=\"$familySituationInArray\" $isSelected >$familySituationInArray</option>";
                                    }
                                    ?>
                                </select>
                                <span class="text-danger"><?= $error['birthdate'] ?? '' ?></span>
                            </div>
                            <!-- PHOTO -->
                            <div class="col-12 p-1 mb-2">
                                <label for="profilePicture" class="form-label">Photo de profil</label>
                                <input type="file" name="profilePicture" value="<? $filename ?>" class="form-control" id="profilePicture" accept=".png, image/jpeg">
                                <span class="text-danger"><?= $errors['profilePicture'] ?? '' ?></span>

                            </div>

                            <!-- BOUTON ENVOYER -->
                            <button type="submit" class="btn btn-info text-white text-uppercase mt-4" id="btn-send-connexion">Valider</button>
                        </div>
                    </form>
                    <!-- MES ARTICLES - TITRE -->
                    <div class="mb-4">
                        <p class="lead fw-bold">Mes articles</p>
                        <span class="text-success fw-bold"><?= $message ?? '' ?></span>
                        <span class="text-danger fw-bold"><?= $error ?? '' ?></span>
                        <div class="d-flex justify-content-end pt-3">
                            <a href="/controllers/subscriber/add-post-ctrl.php" class="btn btn-send-contact text-white">
                                Ecrire un nouvel article
                            </a>
                        </div>
                    </div>
                    <!-- MES ARTICLES - LISTE  -->
                    <div class="table-responsive">
                        <table class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th scope="col" class="d-none d-sm-table-cell fw-normal">Titre</th>
                                    <th scope="col" class="d-none d-sm-table-cell fw-normal">Publication</th>
                                    <th scope="col" class="fw-normal">Voir l'article</th>
                                    <th scope="col" class="fw-normal">Modifier</th>
                                    <th scope="col" class="fw-normal">Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                foreach ($posts as $post) { ?>
                                    <tr>
                                        <td><?= $post->title ?></td>
                                        <td><?= (new DateTime($post->published_at))->format('d-m-Y') ?></td>
                                        <td><a class="text-dark" href="/controllers/post_detail-ctrl.php?id_post=<?= $post->id_post ?>"><i class="fa-solid fa-link"></i></a></td>
                                        <td><a class="text-dark" href="/controllers/subscriber/update-post-ctrl.php?id_post=<?= $post->id_post ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                        <!-- Button trigger modal -->
                                        <td><a type="button" data-id="<?= $post->id_post ?>" data-bs-toggle="modal" data-bs-target="#deletePostOfSubscriberModal" class="text-dark modalOpenPostOfSubscriberDeleteBtn"><i class="fa-solid fa-trash-can text-danger"></i></a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- SUPPRESSION DES COMPTES -->
                    <div class="pt-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <p class="lead fw-normal text-danger">Supprimer mon compte</p>
                            <i class="fa-solid fa-trash-can text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- delete Modal -->
<div class="modal fade" id="deletePostOfSubscriberModal" tabindex="-1" aria-hidden="true">
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
                <button type="button" class="btn btn-danger deletePostOfSubscriberBtn" data-bs-dismiss="modal">Oui</button>
                <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Non</button>
            </div>
        </div>
    </div>
</div>