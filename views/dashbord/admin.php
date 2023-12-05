<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amiens Zen Installation - Dashbord</title>
    <!-- google font "Josefin" for titles et "Montserrat" for texts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Montserrat&display=swap" rel="stylesheet">
    <!-- css bootstrap file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- bootstrap icon file-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- my css file -->
    <link rel="stylesheet" href="/public/assets/css/style-admin.css">
</head>

<body>
    <!-- begin header -->
    <header>
        <!-- begin navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand order-lg-1" href="./home-ctrl.php">
                    <img class="logo_site" src="/public/assets/img/logo_amiens_zen_installation.png" alt="Logo Amiens Zen Installation">
                </a>
                <div class="d-flex justify-content-center align-items-center order-lg-3">
                    <a class="nav-link mx-1" href="#"><i class="bi bi-search"></i>
                    </a>
                    <a class="nav-link mx-1 d-none d-lg-block" href="./signUp-ctrl.php"><i class="bi bi-person-circle"></i></a>
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse order-lg-2 justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav text-center px-5">
                        <li class="nav-item">
                            <a class="nav-link" href="./mission-ctrl.php">Notre mission</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./accommodation-ctrl.php">Se loger</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./work-ctrl.php">Emploi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./life-ctrl.php">Vie amiénoise</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./contact-ctrl.php">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dashbord Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Articles</a></li>
                                <li><a class="dropdown-item" href="#">Utilisateurs</a></li>
                                <li><a class="dropdown-item" href="#">Commentaires</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="text-center d-lg-none">
                        <a href="./signUp-ctrl.php" class="nav-link"><i class="bi bi-person-circle"></i> Mon compte</a>
                    </div>
                </div>
            </div>
        </nav>
        <!--end navbar-->
    </header>
    <!-- end header -->

    <main>
        <section id="main__pic">
            <div id="overlay">
                <h2 class="text-center text-white">DASHBORD <br>ADMINISTRATEUR</h2>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row justify-content-center align-items-center d-flex">
                    <div class="col-md-6 col-lg-4">
                        <div class="card m-5">
                            <div class="card-body">
                                <h5 class="card-title text-center">Utilisateurs</h5>
                                <p class="card-text text-center"> + 3 personnes</p>
                                <div class="text-center">
                                    <a href="#" class="btn btn-primary text-center">Voir en détail</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="card m-5">
                            <div class="card-body">
                                <h5 class="card-title text-center">Articles</h5>
                                <p class="card-text text-center"> + 3 articles</p>
                                <div class="text-center">
                                    <a href="#" class="btn btn-primary text-center">Voir en détail</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card m-5">
                            <div class="card-body">
                                <h5 class="card-title text-center">Commentaires</h5>
                                <p class="card-text text-center"> + 3 commentaires </p>
                                <div class="text-center">
                                    <a href="#" class="btn btn-primary text-center">Voir en détail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- begin footer -->
    <footer class="
    container-fluid mt-auto py-3 bg-body-tertiary ">
        <div class="row d-flex align-items-center">
            <div class="col-12 col-md-4 d-flex p-3 d-flex justify-content-center   align-items-center">
                <div class="text-footer text-center mx-3"><a href="">Mentions légales</a></div>
                <div class="text-footer text-center mx-3"><a href="">Protection des données</a></div>
                <div class="text-footer text-center mx-3"><a href="">Cookie</a></div>
            </div>
            <div class="col-12 col-md-4 d-flex align-items-center justify-content-evenly p-3">
                <div class="text-footer">Suivez-nous:</div>
                <a href="https://www.facebook.com/"><i class="bi bi-facebook"></i></a>
                <a href="https://twitter.com/home"><i class="bi bi-twitter"></i></a>
                <a href="https://www.instagram.com/"><i class="bi bi-instagram"></i></a>
                <a href="https://www.linkedin.com/"><i class="bi bi-linkedin"></i></a>
            </div>
            <div class="text-footer col-12 col-md-4 text-center p-3">Amiens Zen
                Installation - © 2023
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- javascript bootstrap file -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- my javascript file-->
    <script src="/public/assets/js/script.js"></script>
</body>

</html>