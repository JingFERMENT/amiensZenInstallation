<?php
require_once __DIR__ . '/../config/init.php';
require_once __DIR__.'/../models/Subscriber.php';

try {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $error = [];

        // EMAIL
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        if (empty($email)) {
            $error['email'] = 'L\'email est obligatoire.';
        } else {
            $isOk = filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!$isOk) {
                $error['email'] = 'L\'email est incorrect.';
            }
        }

         // vérifier s'il y a des doublons dans l'email
         $isExistDuplicate = Subscriber::isExist($email);

         if (!$isExistDuplicate) {
             $error['email'] = 'L\'email inconnu.';
         }

        // PASSWORD
        $password = filter_input(INPUT_POST, 'password');
        if (empty($password)) {
            $error['password'] = 'Le mot de passe est obligatoire.';
        } else {
            $isOk = filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PASSWORD . '/')));
            if (!$isOk) {
                $error['password'] = 'Le mot de passe doit contenir au moins 8 caractères, un majuscule, un minuscule, un caractère spécial et un chiffre.';
            }
        }

        // authentification
        if (empty($error)) {
            $subscriber = Subscriber::getByEmail($email);

            if (!$subscriber) {
                $error['password'] = 'Nous n\'avons pas pu vous identifier';
            } else {
                // récupérer le mot de passe hashé
                $passwordHash = $subscriber->password;
                // password_verify
                $isAuth = password_verify($password, $passwordHash);
                if ($isAuth) {
                    session_start();
                    unset($subscriber->password);
                    // stocker l'info de l'abonné dans la session pour utiliser dans toutes les pages quand l'abonné est connecté.
                    $_SESSION['subscriber'] = $subscriber;
                    header("Refresh: 1; url=/controllers/subscriber/myprofile-ctrl.php");
                    die;
                } else {
                    $error['password'] = 'Votre mot de passe est incorrect!';
                }
            }
        }
    }
} catch (\Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../views/templates/header.php';
    include __DIR__ . '/../views/templates/error.php';
    include __DIR__ . '/../views/templates/footer.php';
    die;
}

// Dans Auth::verifyIsConnectedAsAdmin on redirige sur ce controleur
// avec le paramètre error=denied pour afficher un message
$generalError = null;
if (!empty($_GET['error']) && $_GET['error'] == 'denied') {
    $generalError = 'Vous n\'avez pas le droit d\'accéder à cette page';
}

include __DIR__ . '/../views/templates/header.php';
include __DIR__ . '/../views/signIn.php';
include __DIR__ . '/../views/templates/footer.php';
