<?php
session_start();
require_once(__DIR__ . '/../../../models/Subscriber.php');

try {
    $title = "Liste des abonnés";
    $subscribers = Subscriber::getAll();

    // on récupère les messages stockés dans la session.
    $msg = filter_var($_SESSION['msg'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $error = filter_var($_SESSION['error'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

    
} catch (Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../../../views/templates/header.php';
    include __DIR__ . '/../../../views/templates/error.php';
    include __DIR__ . '/../../../views/templates/footer.php';
    die;
}

//views
include __DIR__ . '/../../../views/templates/header_dashboard.php';
include __DIR__ . '/../../../views/dashboard/subscriber/list.php';
include __DIR__ . '/../../../views/templates/footer_dashboard.php';
