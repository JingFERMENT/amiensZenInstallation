<?php
session_start();
require_once(__DIR__ . '/../../helpers/dd.php');
require_once(__DIR__ . '/../../helpers/Auth.php');
require_once(__DIR__ . '/../../models/Post.php');
Auth::verifyIsConnected();

try {
    $title = "Supprimer un article";
    // supprimer tous sauf les chiffres et + / - ;
    $idPost = intval(filter_input(INPUT_GET, 'id_post', FILTER_SANITIZE_NUMBER_INT));

    $post = Post::get($idPost);
    

    if ($post) {
        // Appel de la méthode delete
        $isDeleted = Post::delete($idPost);
        
        // Suppression du visuel associé
        @unlink(__DIR__."/../../../public/uploads/posts/$post->photo");
        
        $message = 'Article supprimé avec succès.';
       
        
    } else {
        $error = 'Erreur, la donnée n\'a pas été supprimée.';
    }

    //on stock les messages dans la session
    $_SESSION['error'] = $error;
    $_SESSION['message'] = $message;
    
    header('location:/controllers/subscriber/myprofile-ctrl.php');
    die;
} catch (Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../../views/templates/header.php';
    include __DIR__ . '/../../views/templates/error.php';
    include __DIR__ . '/../../views/templates/footer.php';
    die;
}

//views
include __DIR__ . '/../../../views/templates/header.php';
include __DIR__ . '/../../../views/subscriber/myprofile.php';
include __DIR__ . '/../../../views/templates/footer.php';