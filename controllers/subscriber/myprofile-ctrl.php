<?php 
session_start();

$title = "Mon profil";

if (empty($_SESSION['subscriber'])) {


    $error = 'Vous n etes pas connecté.';

    include __DIR__.'/../../views/templates/header.php';
    include __DIR__.'/../../views/templates/error.php';
    include __DIR__.'/../../views/templates/footer.php';
    die();

}

$connectedSubscriber = $_SESSION['subscriber'];

include __DIR__.'/../../views/templates/header.php';
include __DIR__.'/../../views/subscriber/myprofile.php';
include __DIR__.'/../../views/templates/footer.php';