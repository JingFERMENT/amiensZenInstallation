<?php
session_start();
require_once(__DIR__ . '/../models/Post.php');
require_once(__DIR__ . '/../config/init.php');
require_once(__DIR__ . '/../helpers/dd.php');
require_once(__DIR__ . '/../models/Comment.php');

try {

    // Récupération du paramètre d'URL correspondant à l'id de l'article cliquée
    $id_post = intval(filter_input(INPUT_GET, 'id_post', FILTER_SANITIZE_NUMBER_INT));

    $post = Post::get($id_post);
   
    $title = $post->title;

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

        $comment = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

        $errors = [];
        
        if(!empty($comment)) {
            if (strlen($comment) > 1000) {
                $errors['description'] = 'Merci de ne pas dépasser 1000 mots.';
            }
        }

        if (empty($errors)) {
            // Création d'un nouvel objet issu de la classe 'comment'
            $commentObj = new Comment();

            $id_subscriber = $_SESSION['subscriber']->id_subscriber;

            // Hydratation de notre objet
            $commentObj->setDescription($comment);
            $commentObj->setId_post($id_post);
            $commentObj->setId_subscriber($id_subscriber);

            // Appel de la méthode insert
            $isOk = $commentObj->insert();

            // Si la méthode a retourné "true", alors on redirige vers la liste
            if($isOk){
                // $msg = 'Votre commentaire a bien été créé.';
                header("Refresh: 1; url=/controllers/post_detail-ctrl.php?id_post=$id_post");
            } else {
                $msg = 'Erreur, la donnée n\'a pas été insérée. Veuillez réessayer.';
            }
        }
    }

    $post = Post::get($id_post);
    $comments= Comment::getAllCommentsForOnePost($id_post);

} catch (\Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../views/templates/header.php';
    include __DIR__ . '/../views/templates/error.php';
    include __DIR__ . '/../views/templates/footer.php';
    die;
}

// traiter le cas où l'article est archivé
if($post->deleted_at !=NULL){
    $error = 'L\'article que vous cherchez est archivé.';
    include __DIR__ . '/../views/templates/header.php';
    include __DIR__ . '/../views/templates/error.php';
    include __DIR__ . '/../views/templates/footer.php';
    die;
}


include __DIR__ . '/../views/templates/header.php';
include __DIR__ . '/../views/post_detail.php';
include __DIR__ . '/../views/templates/comment.php';
include __DIR__ . '/../views/templates/footer.php';
