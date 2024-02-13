<div class="container vh-100">
    <div class="row justify-content-center align-items-center">
    <div class="col-md-8 col-xl-4">
        <div class="text-center">
        <h2 class="font-weight-bold mt-4">Connexion</h2>
        </div>

        <?php if (!empty($generalError)) { ?>
        <div class="alert alert-danger" role="alert">
            <?=$generalError?>
        </div>
        <?php } ?>

        <form class="my-4" action="" method="POST" name="signIn">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
            type="email"
            name = "email"
            class="form-control"
            id="email"
            aria-describedby="emailHelp"
            />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input
            type="password"
            name = "password"
            class="form-control"
            id="password"
            />
        </div>
        <button
            type="submit"
            class="btn btn-info text-white text-uppercase mt-4"
            id="btn-send-connexion"
        >
            Connexion
        </button>
        <div class="d-flex justify-content-between align-items-center py-4">
            <a
            class="text-connexion text-strong text-center"
            href="./reset-password-ctrl.php"
            >Mot de passe oublié ?</a
            >
            <span class="text-connexion text-center"
            >Nouveau sur Zen Installation ?
            <a
                class="text-connexion text-strong text-center"
                href="./signUp-ctrl.php"
                >Inscription</a
            >
            </span>
        </div>
        </form>
    </div>
    </div>
</div>
