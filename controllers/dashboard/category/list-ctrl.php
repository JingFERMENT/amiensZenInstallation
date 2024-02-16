<?php
session_start();
require_once(__DIR__ . '/../../../models/Category.php');
require_once(__DIR__ . '/../../../helpers/dd.php');
require_once(__DIR__ . '/../../../helpers/Auth.php');
Auth::verifyIsConnectedAsAdmin();

try {

    $title = "Liste des catégories";
    $categories = Category::getAll();

    // on récupère les messages stockés dans la session.
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
include __DIR__ . '/../../../views/dashboard/category/list.php';
include __DIR__ . '/../../../views/templates/footer_dashboard.php';
