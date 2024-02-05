<div class="card border-2">
    <div class="py-5 d-flex flex-column justify-content-center align-items-center">
        <h1 class="text-center pb-3">Ajouter un article</h1>
        <span class="text-success fw-bold"><?= $msg ?? '' ?></span>
        <form class="col-12 col-lg-6" method="POST" enctype='multipart/form-data'>
            <div class="d-flex flex-wrap">
                <!-- categorie -->
                <div class="col-12 p-2">
                    <label for="id_category" class="form-label fw-bold">Catégorie de l'article<span class="text-danger">
                            *<span></label>
                    <select name="id_category" class="form-select" aria-label="Default select example">
                        <option selected disabled>--Sélectionnez votre catégorie--</option>
                        <?php foreach ($categories as $category) {
                            $isSelected = (isset($id_category) && $id_category == $category->id_category) ? 'selected' : '';
                            echo "<option value=\"$category->id_category\" $isSelected>$category->name</option>";
                        } ?>
                    </select>
                    <span class="text-danger"><?= $errors['name'] ?? '' ?></span>
                </div>
                <!-- content -->
                <div class="col-12 col-lg-6 p-2">
                    <label for="brand" class="form-label fw-bold">Marque<span class="text-danger">
                            *<span></label>
                    <input type="text" name="brand" value="<?= $brand ?? '' ?>" class="form-control" id="brand" aria-describedby="brandHelp" placeholder="Citroën" minlength="2" maxlength="50" required>
                    <span class="text-danger"><?= $errors['brand'] ?? '' ?></span>
                </div>
                <!-- photo-->
                <div class="col-12 p-2">
                    <label for="photo" class="form-label fw-bold">Photo de véhicule</label>
                    <input type="file" name="photo" value="<? $filename ?>" class="form-control" id="photo" accept=".png, image/jpeg">
                    <span class="text-danger"><?= $errors['photo'] ?? '' ?></span>
                    <img class="img-fluid m-auto mt-3" src="<?= $picture ?? '' ?>">
                </div>
                <!-- bouton -->
                <div class="col-12 p-2 text-center">
                    <button type="submit" class="btn btn-dark text-white" value="Ajouter">Valider</button>
                </div>
                <small class="text-danger fw-lighter fst-italic"><span class="text-danger">*</span> champs obligatoires</small>
            </div>
            <!-- BOUTON VALIDATION -->
        </form>
    </div>
</div>