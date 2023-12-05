<?php 

require_once __DIR__.'/../config/init.php';

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

    // PASSWORD and CONFIRMED PASSWORD: pas de nettoyage avec special chars
    $password = filter_input(INPUT_POST, 'password');
    $confirmedPassword = filter_input(INPUT_POST, 'confirmedPassword');


}

include __DIR__.'/../views/templates/header.php';
include __DIR__.'/../views/signIn.php';
include __DIR__.'/../views/templates/footer.php';