<?php
session_start();

require_once(__DIR__ . '/../../../models/Post.php');
require_once(__DIR__ . '/../../../helpers/dd.php');
require_once(__DIR__ . '/../../../models/Category.php');
require_once(__DIR__ . '/../../../config/init.php');
require_once(__DIR__ . '/../../../helpers/Auth.php');
Auth::verifyIsConnectedAsAdmin();

try {

    $title = "Ajouter un article";
    $categoriesInDataBase = Category::getAll();
   
    // Si les données du formulaire ont été transmises
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = [];

        // SELECTED CATEGORY
        $selectedIdCategories = filter_input(INPUT_POST, 'selectedCategory', FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);
       
        // Récupération, nettoyage et validation des données
        if (empty($selectedIdCategories)) {
            $errors['selectedCategory'] = 'Votre choix est obligatoire.';
        } else {
            foreach($selectedIdCategories as $selectedIdCategory) {
                $idCategoriesInDataBase = array_column($categoriesInDataBase, 'id_category');
                $isOk = in_array($selectedIdCategory, $idCategoriesInDataBase);
                if (!$isOk) {
                    $errors['selectedCategory'] = 'La catégorie n\'existe pas.';
                }
            }
        }

        $inputTitle = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);

        // Récupération, nettoyage et validation des données
        if (empty($inputTitle)) { // le champs est obligatoire
            $errors['title'] = 'Le titre de l\'article est obligatoire.';
        } else {
            $isOk = (strlen($inputTitle) <= 100);
            if (!$isOk) {
                $errors['title'] = 'Le nom de l\'article doit contenir maximum 100 caractères alphabétiques.';
            }
        }

        // CONTENT
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($content)) {
            $errors['content'] = 'Le contenu de catégorie est obligatoire.';
        } else {
            if (strlen($content) > 3000) {
                $errors['content'] = 'Merci de ne pas dépasser 3000 mots.';
            }
        }

        // Enregistrement de photo localement sur le serveur
        $photoToSave = null;

        if ($_FILES['photo']['error'] != 4) {
            try {
                if ($_FILES['photo']['error'] != 0) {
                    throw new Exception("Une erreur s'est produite.");
                }

                // quand le format n'est pas correct
                if (!in_array($_FILES['photo']['type'], ARRAY_TYPES_MIMES)) {
                    throw new Exception("Le format de l'image n'est pas correct.");
                }

                if ($_FILES['photo']['size'] > UPLOAD_MAX_SIZE) {
                    throw new Exception("Le fichier est trop lourd");
                }

                // une chaine de caractère unique 
                $filename = uniqid('img_');
                $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                // le fichier venait de dossier tmp_name
                $from = $_FILES['photo']['tmp_name'];

                // "/" sinon le chemin ne sera pas reconnu
                $toBack = __DIR__ . '/../../../public/uploads/posts/' . $filename . '.' . $extension;
                $photoToSave =  $filename . '.' . $extension; // enregistrer uniquement le nom du fichier
                move_uploaded_file($from, $toBack);
            } catch (\Throwable $th) {
                $errors['photo'] = $th->getMessage();
                
            }
        }
        
        if (empty($errors)) {
            // Création d'un nouvel objet issu de la classe 'post'
            $postObj = new Post();

            $id_subscriber = $_SESSION['subscriber']->id_subscriber;

            // Hydratation de notre objet
            $postObj->setTitle($inputTitle);
            $postObj->setContent($content);
            $postObj->setPhoto($photoToSave);
            $postObj->setId_subscriber($id_subscriber);
            $postObj->setId_categories($selectedIdCategories);

            // Appel de la méthode insert
            $isOk = $postObj->insert();

            // Si la méthode a retourné "true", alors on redirige vers la liste
            if($isOk){
                $msg = 'Votre article a bien été créé.';
                header("Refresh: 1; url=/controllers/dashboard/post/list-ctrl.php");
            } else {
                $msg = 'Erreur, la donnée n\'a pas été insérée. Veuillez réessayer.';
            }
        }
    }
} catch (\Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../../../views/templates/header.php';
    include __DIR__ . '/../../../views/templates/error.php';
    include __DIR__ . '/../../../views/templates/footer.php';
    die;
}

// views
include __DIR__ . '/../../../views/templates/header_dashboard.php';
include __DIR__ . '/../../../views/dashboard/post/add.php';
include __DIR__ . '/../../../views/templates/footer_dashboard.php';
