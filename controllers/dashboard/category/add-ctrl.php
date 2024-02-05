<?php
require_once(__DIR__ . '/../../../models/Category.php');
require_once(__DIR__ . '/../../../helpers/dd.php');
require_once(__DIR__ . '/../../../config/init.php');


try {

    $title = "Ajouter une catégorie";

    // Si les données du formulaire ont été transmises
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = [];

        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        // Récupération, nettoyage et validation des données
        if (empty($name)) { // le champs est obligatoire
            $errors['name'] = 'Le nom est obligatoire.';
        } else {
            // validation des données "name"
            $isOk = filter_var($name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NAME . '/')));
            if (!$isOk) {
                $errors['name'] = 'Le nom de la catégorie doit contenir entre 2 à 50 caractères alphabétiques.';
            }
        }

        // vérifier s'il y a des doublons de catégorie
        $isExist = Category::isExist($name);
       
        if($isExist){
            $errors['name'] = 'Cette catégorie existe déjà.';
        }

        // Enregistrement en base de données
        if (empty($errors)) {
            // Création d'un nouvel objet issu de la classe 'category'
            $categoryObj = new Category();

            // Hydratation de notre objet
            $categoryObj->setName($name);

            // Appel de la méthode insert
            $isOk = $categoryObj->insert();

            // Si la méthode a retourné "true", alors on redirige vers la liste
            if($isOk){
                $msg = 'La catégorie a bien été inséré. Vous pouvez en saisir une autre.';
                header("Refresh: 1; url=/controllers/dashboard/category/list-ctrl.php");
            } else {
                $msg = 'Erreur, la donnée n\'a pas été insérée. Veuillez réessayer.';
            }
        }
    }
}catch (Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../../../views/templates/header.php';
    include __DIR__ . '/../../../views/templates/error.php';
    include __DIR__ . '/../../../views/templates/footer.php';
    die;
}

//views
include __DIR__ . '/../../../views/templates/header_dashboard.php';
include __DIR__ . '/../../../views/dashboard/category/add.php';
include __DIR__ . '/../../../views/templates/footer_dashboard.php';

