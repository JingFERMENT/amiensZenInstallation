<?php
session_start();
require_once(__DIR__ . '/../../../models/Comment.php');
require_once(__DIR__ . '/../../../helpers/dd.php');

try {

    // supprimer tous sauf les chiffres et + / - ;
     $idComment = intval(filter_input(INPUT_GET, 'id_comment', FILTER_SANITIZE_NUMBER_INT));
    

     $isDeleted = Comment::delete($idComment);

     if ($isDeleted) {
         $msg = 'Commentaire supprimé avec succès.';
     } else {
         $error = 'Erreur, la donnée n\'a pas été supprimée.';
     }

     //on stock les messages dans la session
    $_SESSION['error'] = $error;
    $_SESSION['msg'] = $msg;

    header('location:/controllers/dashboard/comment/list-ctrl.php');
    die;


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