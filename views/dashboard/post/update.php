<div class="card border-2">
    <div class="py-5 d-flex flex-column justify-content-center align-items-center">
        <!-- AJOUTER UN ARTICLE -->
        <h1 class="text-center pb-3">Modifier un article</h1>
        <span class="text-success fw-bold"><?= $msg ?? '' ?></span>
        <form class="col-12 col-lg-6" method="POST" enctype='multipart/form-data' novalidate>
            <div class="d-flex flex-wrap">
                <!-- CATEGORIE DE L'ARTICLE -->
                <div class="col-12 p-2">
                   <label class="form-label fw-bold" >Catégorie de l'article<small class="fw-lighter fst-italic"> (plusieurs réponses possibles)</small><span class="text-danger"> * </span></label>
                        <div class="col-12">
                            <div class="d-flex flex-wrap justify-content-start">
                            <?php
                                foreach ($categoriesInDataBase as $categoryInDataBase) {
                                    $isChecked = (in_array($categoryInDataBase->id_category, $postToDisplay->id_categories)) ? 'checked' : '';
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
                    <label for="title" class="form-label fw-bold">Titre<span class="text-danger"> * </span></label>
                    <input class="form-control" value="<?=$postToDisplay->title ?? '' ?>" id="title" rows="5" maxlength="1000" name="title" placeholder="Ecrire votre titre ici ..." required>
                    <span class="text-danger"><?= $errors['title'] ?? '' ?></span>
                </div>

                <!-- CONTENT -->
                <div class="col-12 p-2">
                    <label for="content" class="form-label fw-bold">Contenu<span class="text-danger"> * </span></label>
                    <textarea class="form-control" id="content" rows="10" maxlength="3000" name="content" placeholder="Ecrire votre contenu du article ici ..." required><?=$postToDisplay->content ?? '' ?></textarea>
                    <span class="text-danger"><?= $errors['content'] ?? '' ?></span>
                </div>

                <!-- PHOTO -->
                <div class="col-12 p-2">
                    <label for="photo" class="form-label fw-bold">Photo de l'article</label>
                    <input type="file" name="photo" value="<? $filename ?>" class="form-control" id="photo" accept=".png, image/jpeg">
                    <span class="text-danger"><?= $errors['photo'] ?? '' ?></span>
                    <?php if (!empty($postToDisplay->photo)) { ?>
                        <img class="img-fluid m-auto mt-3" src="/public/uploads/posts/<?=$postToDisplay->photo ?>">
                    <?php } ?>
                </div>
                <!-- BOUTON -->
                <div class="col-12 p-2 text-center">
                    <button type="submit" class="btn text-white" id="btn-add" value="Valider">Valider</button>
                </div>
                <small class="text-danger fw-lighter fst-italic"><span class="text-danger">*</span> champs obligatoires</small>
            </div>
            <!-- BOUTON VALIDATION -->
        </form>
    </div>
</div>