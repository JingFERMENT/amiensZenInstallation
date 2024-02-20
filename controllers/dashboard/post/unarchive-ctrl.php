<?php
session_start();
require_once(__DIR__ . '/../../../models/Post.php');
require_once(__DIR__ . '/../../../helpers/dd.php');
require_once(__DIR__ . '/../../../helpers/Auth.php');
Auth::verifyIsConnectedAsAdmin();

try {

    // supprimer tous sauf les chiffres et + / - ;
    $idPost = intval(filter_input(INPUT_GET, 'id_post', FILTER_SANITIZE_NUMBER_INT));

    // PREMIER CAS - il y a un id_post : archiver un post
    if ($idPost) {
        // Appel de la méthode delete
        $isUnarchived = Post::unarchive($idPost);
        $msg = 'Article désarchivé avec succès.';
        
        $_SESSION['msg'] = $msg;
        // redirection vers la liste des archives
        header('Location: /controllers/dashboard/post/list-ctrl.php');
        die();
    }    
    
    $msg = filter_var($_SESSION['msg'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

    if (isset($_SESSION['msg'])) {
        unset($_SESSION['msg']); // une fois que le message a été affiché, on le retire de la session pour pas qu'il reste tout le temps)
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
include __DIR__ . '/../../../views/dashboard/post/archive.php';
include __DIR__ . '/../../../views/templates/footer_dashboard.php';
