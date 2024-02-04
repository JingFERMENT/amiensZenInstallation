<div class="container-fluid">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8 col-xl-4">
            <div class="text-center">
                <h2 class="font-weight-bold mt-4">Inscription</h2>
            </div>
            <!-- FORM -->
            <form class="my-4" method="POST" name="signUp" novalidate>
                <div class="mb-3 d-flex">
                    <!-- LASTNAME -->
                    <div class="col p-1">
                        <label for="lastname" class="form-label">Nom</label>
                        <input type="text" name="lastname" class="form-control" id="lastname" value="<?= $lastname ?? '' ?>" placeholder="ex: Dupont" aria-describedby="lastnameHelp" minlength="2" maxlength="50" pattern="<?= REGEX_NAME ?>" autocomplete="family-name" ; required>
                        <span class="text-danger"><?= $error['lastname'] ?? '' ?></span>
                    </div>
                    <!-- FIRSTNAME -->
                    <div class="col p-1">
                        <label for="firstname" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $firstname ?? '' ?>" placeholder="ex: Jean" aria-describedby="firstnameHelp" minlength="2" maxlength="50" pattern="<?= REGEX_NAME ?>" autocomplete="given-name" ; required>
                        <span class="text-danger"><?= $error['firstname'] ?? '' ?></span>
                    </div>
                </div>
                <!-- EMAIL -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="email@email.com" value="<?= $email ?? '' ?>" required>
                    <span class="text-danger"><?= $error['email'] ?? '' ?></span>
                </div>
                <!-- PASSWORD -->
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?= $password ?? '' ?>" pattern="<?= REGEX_PASSWORD ?>" required>
                    <span class="text-danger"><?= $error['password'] ?? '' ?></span>
                </div>
                <!-- PASSWORD CONFIRMATION -->
                <div class="mb-3">
                    <label for="confirmedPassword" class="form-label">Confirmation du mot de passe </label>
                    <input type="password" class="form-control" id="confirmedPassword" name="confirmedPassword" value="<?= $confirmedPassword ?? '' ?>" name="confirmedPassword" pattern="<?= REGEX_PASSWORD ?>" required>
                    <span class="text-danger"><?= $error['password'] ?? '' ?></span>
                </div>
                <!-- RGPD checkbox -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="checkRGPD" name="checkRGPD" value="1" <?= (isset($checkRGPD) && $checkRGPD == "1") ? 'checked' : '' ?>>
                    <label class="form-check-label text-connexion text-justify" for="checkRGPD">J'accepte
                        les conditions générales d'utilisation, politique de confidentialité, et la politique de
                        cookies</label>
                </div>
                <span class="text-danger"><?= $error['checkRGPD'] ?? '' ?></span>
                <!-- BOUTON ENVOYER -->
                <button type="submit" class="btn btn-info text-white text-uppercase mt-4" id="btn-send-connexion">Créer mon compte</button>
                <div class="d-flex justify-content-between align-items-center py-4">
                    <!-- RESET PASSWORD -->
                    <a class="text-connexion text-strong text-center" href="./reset-password-ctrl.php">Mot de passe
                        oublié ?</a>
                    <!--SIGN IN -->
                    <span class="text-connexion text-center">Déjà un compte ?
                        <a class="text-connexion text-strong text-center" href="./signIn-ctrl.php">Connexion</a>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>