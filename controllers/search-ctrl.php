<?php
session_start();
require_once(__DIR__ . '/../models/Category.php');
require_once(__DIR__ . '/../models/Post.php');
require_once(__DIR__ . '/../config/init.php');
require_once(__DIR__ . '/../helpers/dd.php');


try {
    $title = 'Rechercher';

    $keywords = filter_input(INPUT_GET, 'keywords', FILTER_SANITIZE_SPECIAL_CHARS);

    $posts = Post::searchPosts($keywords);
  
     
} catch (\Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../views/templates/header.php';
    include __DIR__ . '/../views/templates/error.php';
    include __DIR__ . '/../views/templates/footer.php';
    die;
}


// views
include __DIR__ . '/../views/templates/header.php';
include __DIR__ . '/../views/search.php';
include __DIR__ . '/../views/templates/footer.php';
