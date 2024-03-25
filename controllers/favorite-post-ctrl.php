<?php
session_start();
require_once(__DIR__ . '/../models/Post.php');
require_once(__DIR__ . '/../helpers/dd.php');
require_once(__DIR__ . '/../models/FavoritePost.php');


try {
    $id_post = intval(filter_input(INPUT_GET, 'id_post', FILTER_SANITIZE_NUMBER_INT));
    $post = Post::get($id_post);

    $title = $post->title;
  
    
    if(!empty($_SESSION['subscriber'])) {

        $id_subscriber = $_SESSION['subscriber']->id_subscriber;
        $favoriteArticleObj = new FavoritePost();
        
    
    
        // Hydratation de notre objet
        $favoriteArticleObj->setId_post($id_post);
        $favoriteArticleObj->setId_subscriber($id_subscriber);
        
        $isOk = $favoriteArticleObj->insertFavoritePost();
       
    }
   
    
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