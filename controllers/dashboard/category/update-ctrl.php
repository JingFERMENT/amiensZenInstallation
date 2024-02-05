<?php
session_start();

require_once(__DIR__ . '/../../../models/Category.php');
require_once(__DIR__ . '/../../../config/init.php');
require_once(__DIR__ . '/../../../helpers/dd.php');

try {

    $title = 'Modifier une catégorie';

    // Récupération du paramètre d'URL correspondant à l'id de la catégorie cliquée
    $id_category = intval(filter_input(INPUT_GET, 'id_category', FILTER_SANITIZE_NUMBER_INT));

    $categorytoDisplay = Category::get($id_category);
    
    if (!$categorytoDisplay) {
        header('location: /controllers/dashboard/categories/list-ctrl.php');
        die;
    }

    // Si les données du formulaire ont été transmises
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = [];
        // Récupération, nettoyage et validation des données
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        
        // Récupération, nettoyage et validation des données
        if (empty($name)) { // le champs est obligatoire
            $errors['name'] = 'Le nom de catégorie est obligatoire.';
        } else {
            // validation des données "name"
            $isOk = filter_var($name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NAME . '/')));
            if (!$isOk) {
                $errors['name'] = 'Le nom de la catégorie doit contenir entre 2 à 50 caractères alphabétiques.';
            }
        }

         // vérifier s'il y a des doublons de catégorie
         $isExistDuplicate = Category::isExist($name);
         if ($isExistDuplicate && $name != $categorytoDisplay->name) {
             $errors['name'] = 'Cette catégorie existe déjà.';
         } 

        // Enregistrement en base de données
        if (empty($errors)) {
            // Création d'un nouvel objet issu de la classe 'Type'
            $categoryObj = new Category();

            // Hydratation de notre objet
            $categoryObj->setId_category($id_category);
            $categoryObj->setName($name);
            
            // Appel de la méthode update
            $isOk = $categoryObj->update();
            
            // Si la méthode a retourné "true", alors on redirige vers la liste
            if($isOk){
                $msg = 'Catégorie modifiée avec succès';
                header('location: /controllers/dashboard/category/list-ctrl.php');
            } else {
                $msg = 'Erreur, la catégorie n\'a pas été modifiée.';
            }

             // Récupération de la catégorie selon son id
             $categorytoDisplay = Category::get($id_category);
        }
    }

} catch (\Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../../../views/templates/header.php';
    include __DIR__ . '/../../../views/templates/error.php';
    include __DIR__ . '/../../../views/templates/footer.php';
    die;
}

//views
include __DIR__ . '/../../../views/templates/header_dashboard.php';
include __DIR__ . '/../../../views/dashboard/category/update.php';
include __DIR__ . '/../../../views/templates/footer_dashboard.php';