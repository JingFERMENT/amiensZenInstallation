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
                        <p class="lead fw-bold">Ecrire un nouvel article</p>
                    </div>
                    <?php if (!empty($msg)) { ?>
                        <span class="text-success"><?= $msg ?></span>
                    <?php } ?>
                    <!-- FORM ECRIRE ARTICLE -->
                    <form class="my-4" method="POST" name="writeArticle" enctype='multipart/form-data' novalidate>
                        <div class="d-flex flex-wrap">
                            <!-- CATEGORIE DE L'ARTICLE -->
                            <div class="col-12 p-2">
                                <label class="form-label fw-bold">Catégorie de l'article<small class="fw-lighter fst-italic"> (plusieurs réponses possibles)</small><span class="text-danger"> * </span></label>
                                <div class="col-12">
                                    <div class="d-flex flex-wrap justify-content-start">
                                        <?php
                                        foreach ($categoriesInDataBase as $categoryInDataBase) {
                                            $isChecked = (isset($selectedIdCategories) && in_array($categoryInDataBase->id_category, $selectedIdCategories)) ? 'checked' : '';
                                            echo
                                            "<div class=\"form-check m-3\">
                                            <input class=\"form-check-input\" type=\"checkbox\" name=\"selectedCategory[]\" value=\"$categoryInDataBase->id_category\" id=\"$categoryInDataBase->name\" $isChecked>
                                            <label class=\"form-check-label\" for=\"$categoryInDataBase->name\">$categoryInDataBase->name</label>
                                        </div>";
                                        }
                                        ?>
                                    </div>
                                    <span class="text-danger"><?= $errors['selectedCategory'] ?? '' ?></span>
                                </div>
                            </div>
                            <!-- TITLE -->
                            <div class="col-12 p-2">
                                <label for="title" class="form-label fw-bold">Title<span class="text-danger"> * </span></label>
                                <input class="form-control" id="title" name="title" value="<?= $inputTitle ?? '' ?>" placeholder="Ecrire votre titre ici ..." required>
                                <span class="text-danger"><?= $errors['title'] ?? '' ?></span>
                            </div>
                            <!-- CONTENT -->
                            <div class="col-12 p-2">
                                <label for="content" class="form-label fw-bold">Contenu<span class="text-danger"> * </span></label>
                                <textarea class="form-control" id="content" rows="10" maxlength="3000" name="content" placeholder="Ecrire votre contenu du article ici ..." required><?= $content ?? '' ?></textarea>
                                <span class="text-danger"><?= $errors['content'] ?? '' ?></span>
                            </div>
                            <!-- PHOTO -->
                            <div class="col-12 p-2">
                                <label for="photo" class="form-label fw-bold">Photo de l'article</label>
                                <input type="file" name="photo" value="<? $filename ?>" class="form-control" id="photo" accept=".png, image/jpeg">
                                <span class="text-danger"><?= $errors['photo'] ?? '' ?></span>
                                <?php if (!empty($photoToSave)) { ?>
                                    <img class="img-fluid m-auto mt-3" src="<?= '/public/uploads/posts/' . $photoToSave ?? '' ?>">
                                <?php } ?>
                            </div>
                            <!-- BOUTON -->
                            <div class="col-12 p-2 text-center">
                                <button type="submit" class="btn btn-info text-white text-uppercase mt-4" id="btn-add" value="Valider">Valider</button>
                            </div>
                            <small class="text-danger fw-lighter fst-italic"><span class="text-danger">*</span> champs obligatoires</small>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>