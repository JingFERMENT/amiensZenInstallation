<?php 
session_start();

require_once(__DIR__ . '/../models/Post.php');
require_once(__DIR__ . '/../config/init.php');
require_once(__DIR__ . '/../helpers/dd.php');

try {
    // déclaration des variables
    $title = 'Se loger';

    // ! filtres input 
    $page = intval(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT));
    $id_category = intval(filter_input(INPUT_GET, 'id_category', FILTER_SANITIZE_NUMBER_INT));
    $keywords = filter_input(INPUT_GET, 'keywords', FILTER_SANITIZE_SPECIAL_CHARS);
    
    
    if ($page == 0) {
        $page = 1;
        $nextPage = 2;
    } 

    if ($page > 1) {
        $previousPage = $page - 1;
    } else {
        $previousPage = 1;
    }

    $categories = Post::filterByCategory();
    // récupérer ID Categorie il vaut mieux utiliser intval que la valeur nulle 
    
    // $id_category = filter_input(INPUT_GET, 'id_category', FILTER_SANITIZE_NUMBER_INT);
    
    $offset = PER_PAGE * ($page - 1);
   
    $accommodationArticles = Post::getAll('ASC', $offset, false, $id_category, $keywords);
    
    $nbOfAllVehicles = Post::nbOfAllVehicles($id_category, $keywords);

    // round : arrondir au plus proche
    // ceil : arrondir au ceil / floor: arrond dans 
    $nbOfPages = ceil($nbOfAllVehicles / PER_PAGE);

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
include __DIR__.'/../views/accommodation.php';
include __DIR__.'/../views/templates/footer.php';