<?php 
session_start();

if (empty($_SESSION['subscriber'])) {

    $error = 'Vous n etes pas connecté.';

    include __DIR__.'/../../views/templates/header.php';
    include __DIR__.'/../../views/templates/error.php';
    include __DIR__.'/../../views/templates/footer.php';
    die();

}

$connectedSubscriber = $_SESSION['subscriber'];

include __DIR__.'/../../views/templates/header.php';
include __DIR__.'/../../views/myprofile.php';
include __DIR__.'/../../views/templates/footer.php';