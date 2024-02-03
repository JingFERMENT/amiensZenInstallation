<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amiens Zen Installation</title>
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/public/assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/public/assets/img/favicon-32x32.png">
    <!-- google font "Josefin" for titles et "Montserrat" for texts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Montserrat&display=swap" rel="stylesheet">
    <!-- css bootstrap file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- bootstrap icon file-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- my css file -->
    <link rel="stylesheet" href="/public/assets/css/style.css">
</head>

<body>
    <!-- begin header -->
    <header class="sticky-top">
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
                    </ul>
                    <div class="text-center d-lg-none">
                        <a class="nav-link link-my-account" href="./signUp-ctrl.php"><i class="bi bi-person-circle"></i> Mon compte</a>
                    </div>
                </div>
            </div>
        </nav>
        <!--end navbar-->
    </header>
    <!-- end header -->
    <main>