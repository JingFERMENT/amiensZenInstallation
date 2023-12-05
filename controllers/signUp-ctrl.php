<?php 

require_once __DIR__.'/../config/init.php';


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

    // PASSWORD and CONFIRMED PASSWORD: pas de nettoyage avec special chars
    $password = filter_input(INPUT_POST, 'password');
    $confirmedPassword = filter_input(INPUT_POST, 'confirmedPassword');

    if (!(empty($password) && empty($confirmedPassword))) {
        if ($confirmedPassword != $password) {
            $error['password'] = 'Les mots de passe ne correspondent pas.';
        } else {
            $isConfirmedPasswordOk = filter_var($confirmedPassword, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PASSWORD . '/')));
            if (!$isConfirmedPasswordOk) {
                $error['password'] = 'Le mot de passe doit contenir au moins 8 caractères, un majuscule, un minuscule, un caractère spécial et un chiffre.';
            } else {
                // hash des mots de passe
                $passwordHash = password_hash($isConfirmedPasswordOk, PASSWORD_DEFAULT);
            }
        }
    } else {
        $error['password'] = 'Les mots de passe sont obligatoires.';
    }

    // RGPD
    $checkRGPD = filter_input(INPUT_POST, 'checkRGPD', FILTER_SANITIZE_NUMBER_INT);

    if (empty($checkRGPD)) {
        $error['checkRGPD'] = 'Merci d\'accepter les conditions générales.';
    } else {
        $isOk = filter_var($checkRGPD, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1, "max_range" => 1)));
        if (!$isOk) {
            $error['checkRGPD'] = 'Votre choix est invalide.';
        }

    }
}

include __DIR__.'/../views/templates/header.php';
include __DIR__.'/../views/signUp.php';
include __DIR__.'/../views/templates/footer.php';