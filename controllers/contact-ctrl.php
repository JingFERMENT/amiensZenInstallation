<?php

require_once __DIR__ . '/../config/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $error = [];

    // LASTNAME
    // 1) nettoyage des données récupérées des utilisateurs => éviter "<script> </script>" 
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($lastname)) { // pour les champs obligatoires
        $error['lastname'] = 'Le nom est obligatoire.';
    } else {
        // 2) validation des données "lastname"
        $isOk = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NAME . '/')));
        if (!$isOk) {
            $error['lastname'] = 'Le nom est invalide.';
        }
    }

    // FIRSTNAME
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($firstname)) { // pour les champs obligatoires
        $error['firstname'] = 'Le prénom est obligatoire.';
    } else {
        // 2) validation des données "lastname"
        $isOk = filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NAME . '/')));
        if (!$isOk) {
            $error['firstname'] = 'Le prénom est invalide.';
        }
    }

    // EMAIL
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if (empty($email)) {
        $error['email'] = 'L\'email est obligatoire.';
    } else {
        $isOk = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$isOk) {
            $error['email'] = 'L\'email est invalide.';
        }
    }

    // TELEPHONE
    $telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_NUMBER_INT);
    if (!empty($telephone)) {
        $isOk = filter_var($telephone, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_TELEPHONE . '/')));
        if (!$isOk) {
            $error['telephone'] = 'Votre numéro de téléphone est invalide.';
        }
    }

    // MESSAGE
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
    if (!empty($message)) {
        if (strlen($message) > 1000) {
            $error['message'] = 'Merci de ne pas dépasser 1000 mots.';
        }
    }
}


include __DIR__ . '/../views/templates/header.php';
include __DIR__ . '/../views/contact.php';
include __DIR__ . '/../views/templates/footer.php';
