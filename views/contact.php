<section class="container">
    <h2 class="text-center pt-5">Nous contacter</h2>
    <p class="text-center text-connexion pb-3">Vous désirez nous contacter ? Remplissez le formulaire
        ci-dessous !
    </p>
    <div class="row" id="contact">
        <div class="col-12 d-none d-lg-block col-lg-4 ">
            <img class="img-fluid" src="/public/assets/img/woman_speak_on_the_phone.webp"
                alt="Portrait d'une femme qui parle au téléphone">
        </div>
        <div class="col-12 col-lg-6 m-auto">
            <form method="POST" class="row g-3" name="contact" novalidate>
                <!-- LASTNAME -->
                <div class="col-md-6">
                    <label for="lastname" class="form-label">Nom</label>
                    <input type="text" name ="lastname" class="form-control" id="lastname" value="<?= $lastname ?? '' ?>" placeholder="Dupont" minlength="2" maxlength="50" pattern="<?= REGEX_NAME ?>" autocomplete="family-name" required>
                    <span class="text-danger"><?= $error['lastname'] ?? '' ?></span>
                </div>
                <!-- FIRSTNAME -->
                <div class="col-md-6">
                    <label for="firstname" class="form-label">Prénom</label>
                    <input type="text" name ="firstname" class="form-control" id="firstname" value="<?= $firstname ?? '' ?>" placeholder="Jean" minlength="2" maxlength="50" pattern="<?= REGEX_NAME ?>" autocomplete="given-name" required>
                    <span class="text-danger"><?= $error['firstname'] ?? '' ?></span>
                </div>
                <!-- EMAIL -->
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name ="email" class="form-control" id="email" value="<?= $email ?? '' ?>" placeholder="ex: jean.dupont@gmail.com" required>
                    <span class="text-danger"><?= $error['email'] ?? '' ?></span>
                </div>
                <!-- TELEPHONE -->
                <div class="col-md-6">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="tel" name ="telephone" class="form-control" id="telephone" value="<?= $telephone ?? '' ?>" placeholder="Entrez votre numéro de téléphone" pattern="<?= REGEX_TELEPHONE ?>">
                    <span class="text-danger"><?= $error['telephone'] ?? '' ?></span>
                </div>
                <!-- MESSAGE -->
                <div class="col-12">
                    <label for="message" class="form-label">Votre message</label>
                    <textarea type="text" class="form-control" name="message" id="message" rows="5" maxlength="1000"
                        placeholder="Je voudrais savoir ..."><?= $message ?? '' ?></textarea>
                    <span class="text-danger"><?= $error['message'] ?? '' ?></span>
                </div>
                <!-- BOUTON ENVOYER -->
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn text-white" id="btn-send-contact">Envoyer</button>
                </div>
            </form>

            <p class="text-footer text-justify mt-5">Les données personnelles recueillies via ce formulaire et,
                plus
                généralement, via ce site font l'objet, par
                l’équipe de Amiens Zen Installation, d'un traitement informatisé. Seules les collaboratrices du
                Service y ont
                accès ; elles les utiliseront pour vous apporter un accompagnement personnalisé. Vos données
                personnelles ne
                sont conservées que pour la durée strictement nécessaire à la réalisation des finalités
                poursuivies,
                telles
                que définies précédemment, et ce conformément à la règlementation et aux lois applicables. Passé
                ce
                délai,
                vos données personnelles seront supprimées.

                Conformément à la loi "Informatique et Libertés" du 6 janvier 1978 modifiée et au RGPD
                (Règlement
                Général
                européen sur la Protection des Données personnelles), vous bénéficiez d'un droit d'accès, de
                rectification
                et de suppression des données personnelles vous concernant. Pour exercer ce droit, vous pouvez
                contacter par e-mail au
                contact.zenInstallation@gmail.com
            </p>
        </div>
    </div>
</section>