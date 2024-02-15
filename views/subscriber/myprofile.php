<section class="h-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">
                <div class="card">
                    <div id="banner" class="rounded-top text-white d-flex flex-row">
                        <div class="ms-4 mt-5 d-flex flex-column">
                            <img id="image-profile" src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp" alt="photo profile" class="img-fluid img-thumbnail mt-4 mb-2">

                        </div>
                        <div id="myName" class="ms-3">
                            <h3>Profile de Andy Horwitz</h3>
                        </div>
                    </div>
                    <div class="p-4 text-black d-flex justify-content-end" style="background-color: #f8f9fa;">
                        <?php if ($_SESSION['subscriber']->is_admin == 1) { ?>
                            <a id="btn-access" type="button" class="btn text-white" href="/controllers/dashboard/subscriber/list-ctrl.php">Accès Admin</a>
                        <?php } ?>
                    </div>
                    <div class="card-body p-4 text-black">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <p class="lead fw-normal mb-0">A propos de moi</p>
                            <div class="d-flex justify-content-end text-center py-1">
                                <button type="button" class="btn btn-outline-dark">
                                    Modifier
                                </button>
                            </div>
                        </div>
                        <div class="profile-area p-4">
                            <p class="font-italic mb-1">Web Developer</p>
                            <p class="font-italic mb-1">Lives in New York</p>
                            <p class="font-italic mb-0">Photographer</p>
                        </div>
                    </div>
                    <div class="card-body p-4 text-black">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <p class="lead fw-normal mb-0">Rediger mes articles</p>
                            <div class="d-flex justify-content-end text-center py-1">
                                <button type="button" class="btn btn-outline-dark" >
                                    Modifier
                                </button>
                            </div>
                        </div>
                        <div class="profile-area p-4">
                            <p class="font-italic mb-1">Web Developer</p>
                            <p class="font-italic mb-1">Lives in New York</p>
                            <p class="font-italic mb-0">Photographer</p>
                        </div>
                    </div>
                    <div class="card-body p-4 text-black">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <p class="lead fw-normal mb-0 text-danger">Supprimer mon compte</p>
                            <i class="fa-solid fa-trash-can"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>