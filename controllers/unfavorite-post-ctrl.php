<?php
session_start();
require_once(__DIR__ . '/../models/Post.php');
require_once(__DIR__ . '/../helpers/dd.php');
require_once(__DIR__ . '/../models/FavoritePost.php');


try {
    $id_post = intval(filter_input(INPUT_GET, 'id_post', FILTER_SANITIZE_NUMBER_INT));
    $post = Post::get($id_post);
    $title = $post->title;
  
    $isDeleted = FavoritePost::deleteFavoritePost($id_post);
    

    if ($isDeleted) {
        $msg = 'Article favori supprimé avec succès.';
    } else {
        $error = 'Erreur, l\'article favori n\'a pas été supprimée.';
    }

    //on stock les messages dans la session
   $_SESSION['error'] = $error;
   $_SESSION['msg'] = $msg;

   header('location:/controllers/post_detail-ctrl.php');
   die;
    
} catch (Throwable $th) {
    $error = $th->getMessage();
    $title = "Page erreur ";
    include __DIR__ . '/../views/templates/header.php';
    include __DIR__ . '/../views/templates/error.php';
    include __DIR__ . '/../views/templates/footer.php';
    die;
}

// views
include __DIR__ . '/../views/templates/header.php';
include __DIR__ . '/../views/post_detail.php';
include __DIR__ . '/../views/templates/footer.php';