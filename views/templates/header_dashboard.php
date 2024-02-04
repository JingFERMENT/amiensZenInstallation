<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?? '' ?> | Amiens Zen Installation</title>
  <!-- favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="/public/assets/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/public/assets/img/favicon-32x32.png">
  <!-- google font "Josefin" for titles et "Montserrat" for texts-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Montserrat&display=swap" rel="stylesheet">
  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <!-- css bootstrap file -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- bootstrap icon file-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <!-- my css file -->
  <link rel="stylesheet" href="/public/assets/css/dashboard.css">
</head>

<body>
  <header></header>

  <div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="pb-3">
          <a class="text-center pt-3" href="/index.php">
            <img class="logo_site" src="/public/assets/img/logo_bleu.png" alt="Logo Amiens Zen Installation">
          </a>
          <a href="/index.php">
            <h1 class="pt-4 text-center text-white">Dashboard</h1>
          </a>
          <hr class="m-auto">
        </li>
        <li>
          <a href="#"><i class="fa-solid fa-user"></i>Abonnés</a>
        </li>
        <li>
          <a href="#"><i class="fa-solid fa-table-list"></i>Catégories</a>
        </li>
        <li>
          <a href="#"><i class="fa-solid fa-newspaper"></i>Articles</a>
        </li>
        <li>
          <a href="#"><i class="fa-solid fa-comment"></i>Commentaires</a>
        </li>
      </ul>
      <div class="text-center">
        <a href="/index.php" class="btn fw-bold px-4" id="btnQuit">Quitter</a>
      </div>
    </div>
    <div id="page-content-wrapper" class="mx-auto">


      <a href="/index.php" class="d-md-none btn btn-info text-white my-4" value="Retour">
        << Retour</a>