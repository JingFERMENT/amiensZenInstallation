<?php 
require_once(__DIR__ . '/../models/Post.php');
require_once(__DIR__ . '/../config/init.php');
require_once(__DIR__ . '/../helpers/dd.php');

try {

    $title = 'Détail de l\'article';
    // Récupération du paramètre d'URL correspondant à l'id de l'article cliquée
    $id_post = intval(filter_input(INPUT_GET, 'id_post', FILTER_SANITIZE_NUMBER_INT));
    
    // Appel de la méthode statique getAll permettant de récupérer tous les véhicules
    $post = Post::get($id_post);


} catch (\Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../views/templates/header.php';
    include __DIR__ . '/../views/templates/error.php';
    include __DIR__ . '/../views/templates/footer.php';
    die;
}



include __DIR__.'/../views/templates/header.php';
include __DIR__.'/../views/post_detail.php';
include __DIR__.'/../views/templates/comment.php';
include __DIR__.'/../views/templates/footer.php';