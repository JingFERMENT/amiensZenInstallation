<?php
require_once(__DIR__ . '/../../helpers/Auth.php');
require_once __DIR__ . '/../../config/init.php';
require_once __DIR__ . '/../../models/Subscriber.php';
require_once(__DIR__ . '/../../helpers/dd.php');
require_once (__DIR__ . '/../../models/Post.php');

session_start();
Auth::verifyIsConnected();

$title = "Mon profil";

$connectedSubscriber = $_SESSION['subscriber'];

$firstname = $connectedSubscriber->firstname;
$lastname = $connectedSubscriber->lastname;
$email = $connectedSubscriber->email;
$birthdate = $connectedSubscriber->birthdate;
$phone = $connectedSubscriber->phone;
$familySituation = $connectedSubscriber->family_situation;
$profilePicture = $connectedSubscriber->profile_picture;


$maxDate = date('Y-m-d');
$minDate = (date('Y') - 120) . '-01-01';


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

    if ($email !== $connectedSubscriber->email) {
        // vérifier s'il y a des doublons dans l'email
        $isExistDuplicate = Subscriber::isExist($email);

        if ($isExistDuplicate) {
            $error['email'] = 'Cet email existe déjà.';
        }
    }

    // BIRTHDATE
    $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_NUMBER_INT);
    
    if (!empty($birthdate)) {
        $isOk = filter_var($birthdate, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_BIRTHDATE . '/')));
        if (!$isOk || $birthdate > $maxDate || $birthdate < $minDate) {
            $error['birthdate'] = 'La date de naissance est invalide.';
        }
    }

    // PHONE
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
    
    if (!empty($phone)) { // pour les champs non-obligatoires
        $isOk = filter_var($phone, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_TELEPHONE . '/')));
        if (!$isOk) {
            $error['phone'] = 'Votre numéro de téléphone est invalide.';
        }
    }

    // FAMILY SITUATION
    $familySituation = filter_input(INPUT_POST, 'familySituation', FILTER_SANITIZE_SPECIAL_CHARS);

    if (!empty($familySituation) && !in_array($familySituation, ARRAY_FAMILY_SITUATION)) {
        $error['familySituation'] = 'Votre choix est invalide.';
    }

    // PROFILE PICTURE
    $profilePictureToSave = $profilePicture;

    if ($_FILES['profilePicture']['error'] != 4) {
        try {
            if ($_FILES['profilePicture']['error'] != 0) {
                throw new Exception("Une erreur s'est produite.");
            }

            // quand le format n'est pas correct
            if (!in_array($_FILES['profilePicture']['type'], ARRAY_TYPES_MIMES)) {
                throw new Exception("Le format de l'image n'est pas correct.");
            }

            if ($_FILES['profilePicture']['size'] > UPLOAD_MAX_SIZE) {
                throw new Exception("Le fichier est trop lourd");
            }

            // une chaine de caractère unique 
            $filename = uniqid('img_');
            $extension = pathinfo($_FILES['profilePicture']['name'], PATHINFO_EXTENSION);
            // le fichier venait de dossier tmp_name
            $from = $_FILES['profilePicture']['tmp_name'];

            // "/" sinon le chemin ne sera pas reconnu
            $toBack = __DIR__ . '/../../public/uploads/users/' . $filename . '.' . $extension;
            $profilePictureToSave =  $filename . '.' . $extension; // enregistrer uniquement le nom du fichier
            move_uploaded_file($from, $toBack);
        } catch (\Throwable $th) {
            $errors['profilePicture'] = $th->getMessage();
            
        }
    }


    if (empty($error)) {
        // Création d'un nouvel objet issu de la classe 'subscriber'
        $subscriberObj = new Subscriber();

        // Hydratation de notre objet
        $subscriberObj->setLastname($lastname);
        $subscriberObj->setFirstname($firstname);
        $subscriberObj->setEmail($email);
        if($birthdate == "") {
            $birthdate = NULL ;
        }
        $subscriberObj->setBirthdate($birthdate);

        $subscriberObj->setPhone($phone);
        $subscriberObj->setFamily_situation($familySituation);
        $subscriberObj->setProfile_picture($profilePictureToSave);
        $subscriberObj->setId_subscriber($connectedSubscriber->id_subscriber);
       
        
        // Appel de la méthode insert
        $isOk = $subscriberObj->update();

        // Si la méthode a retourné "true", on redirige vers la liste
        if ($isOk) {
            $subscriber = Subscriber::getByEmail($email);
            // mettre la session à jour avec les nouvelles informations du profil
            unset($subscriber->password);
            $_SESSION['subscriber'] = $subscriber;
            $msg = 'Votre profil est à jour.';
            header("Refresh: 1; url=myprofile-ctrl.php");
        } else {
            $msg = 'Erreur, votre modification n\'a pas réussi. Veuillez réessayer.';
        }
    }
}

include __DIR__ . '/../../views/templates/header.php';
include __DIR__ . '/../../views/subscriber/myprofile.php';
include __DIR__ . '/../../views/templates/footer.php';
