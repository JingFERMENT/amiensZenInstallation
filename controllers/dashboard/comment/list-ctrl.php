<?php
session_start();
require_once(__DIR__ . '/../../../models/Comment.php');
require_once(__DIR__ . '/../../../helpers/dd.php');

// if the susbcriber is not admin, the dashboard is not authorized
// Auth::Check() -> mettre sur toutes les pages // sécuriser toutes les controlleurs 
// if (empty($_SESSION['subscriber']) || $_SESSION['subscriber']->is_admin == false) {   
//     header('location: /controllers/signIn-ctrl.php');
// }

try {

    $title = "Liste des commentaires";
    $comments = Comment::getAll();
   
    // // on récupère les messages stockés dans la session.
    $msg = filter_var($_SESSION['msg'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $error = filter_var($_SESSION['error'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

    // on voir si cela existe, puis on détruit la session lorsque l'on a fini de supprimer.
    if (isset($_SESSION['msg'])) {
        unset($_SESSION['msg']);
    }

    if (isset($_SESSION['error'])) {
        unset($_SESSION['error']);
    }
} catch (Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../../../views/templates/header.php';
    include __DIR__ . '/../../../views/templates/error.php';
    include __DIR__ . '/../../../views/templates/footer.php';
    die;
}

//views
include __DIR__ . '/../../../views/templates/header_dashboard.php';
include __DIR__ . '/../../../views/dashboard/comment/list.php';
include __DIR__ . '/../../../views/templates/footer_dashboard.php';
