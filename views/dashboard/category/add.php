<div class="card border-2 text-center py-2 d-flex flex-column justify-content-center align-items-center">
    <div class="p-5">
        <h1 class="p-5 text-center">Ajouter une catégorie</h1>
        <span class="text-danger fw-bold pb-3"><?= $errors['name'] ?? '' ?></span>
        <span class="text-info fw-bold"><?= $msg ?? '' ?></span>
        <form method="POST" class="pt-5">
            <!-- AJOUT CATEGORIE -->
            <div>
                <label for="name" class="form-label fw-bold">Nom de la catégorie</label>
                <input type="text" name="name" value="<?= $name ?? '' ?>" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Ex: emploi" minlength="2" maxlength="50" pattern="<?= REGEX_NAME ?>" required>              
            </div>
            <!-- BOUTON VALIDATION -->
            <button type="submit" id="btn-add" class="btn text-white my-4" value="Ajouter">Ajouter</button>
        </form>
    </div>
</div>