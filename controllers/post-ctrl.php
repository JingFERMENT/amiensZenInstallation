<?php 
session_start();

require_once(__DIR__ . '/../models/Post.php');
require_once(__DIR__ . '/../config/init.php');
require_once(__DIR__ . '/../helpers/dd.php');

try {
    // déclaration des variables
    $title = 'Se loger';

    $id_category = intval(filter_input(INPUT_GET, 'id_category', FILTER_SANITIZE_NUMBER_INT));

    // ! filtres input 
    $page = intval(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT));

    
    if ($page == 0) {
        $page = 1;
        $nextPage = 2;
    } 

    if ($page > 1) {
        $previousPage = $page - 1;
    } else {
        $previousPage = 1;
    }

    $offset = PER_PAGE * ($page - 1);
   
    $accommodationArticles = Post::getAll($id_category, $offset);
   
    // round : arrondir au plus proche
    // ceil : arrondir au ceil / floor: arrond dans 
    $nbOfPostInAccommodation = POST::count();

    $nbOfPages = ceil( $nbOfPostInAccommodation / PER_PAGE);

    if ($page >= $nbOfPages) {
        $nextPage = $page;
    } else {
        $nextPage = $page + 1;
    }
    
} catch (Throwable $e) {
    echo "Connection failed: " . $e->getMessage();
    // dd($th);
}

// views
include __DIR__.'/../views/templates/header.php';
include __DIR__.'/../views/post.php';
include __DIR__.'/../views/templates/footer.php';