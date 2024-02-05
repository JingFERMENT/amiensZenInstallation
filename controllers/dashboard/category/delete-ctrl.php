<?php
session_start();

require_once(__DIR__ . '/../../../models/Category.php');
require_once(__DIR__ . '/../../../helpers/dd.php');

try {

     // supprimer tous sauf les chiffres et + / - ;
     $idCategory = intval(filter_input(INPUT_GET, 'id_category', FILTER_SANITIZE_NUMBER_INT));
    
     $isDeleted = Category::delete($idCategory);
     if ($isDeleted) {
         $msg = 'Catégorie supprimée avec succès.';
     } else {
         $error = 'Erreur, la donnée n\'a pas été supprimée.';
     }
     //on stock les messages dans la session
    $_SESSION['error'] = $error;
    $_SESSION['msg'] = $msg;

    header('location:/controllers/dashboard/category/list-ctrl.php');
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
include __DIR__ . '/../../../views/dashboard/category/list.php';
include __DIR__ . '/../../../views/templates/footer_dashboard.php';