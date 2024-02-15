<?php
session_start();
require_once(__DIR__ . '/../../../models/Subscriber.php');
require_once(__DIR__ . '/../../../helpers/dd.php');
require_once(__DIR__ . '/../../../helpers/Auth.php');
Auth::verifyIsConnectedAsAdmin();

try {

    // Récupération du paramètre d'URL correspondant à l'id de l'abonné cliquée
    $id_subscriber = intval(filter_input(INPUT_GET, 'id_subscriber', FILTER_SANITIZE_NUMBER_INT));
    
    Subscriber::get($id_subscriber);
    
    // Appel de la méthode delete
    $isOk = Subscriber::delete($id_subscriber);

    // Si la méthode a retourné "true", alors on redirige vers la liste
    if ($isOk) {
        $msg = 'Abonné supprimé avec succès.';
    } else {
        $error = 'Erreur, l\'abonné n\'a pas été supprimé.';
    }

    //on stock les message / error dans la session
    $_SESSION['msg'] = $msg;
    $_SESSION['error'] = $error;

    header('location: /controllers/dashboard/subscriber/list-ctrl.php');
    die;

} catch (\Throwable $th) {
    $error = $th->getMessage();
    include __DIR__ . '/../../../views/templates/header.php';
    include __DIR__ . '/../../../views/templates/error.php';
    include __DIR__ . '/../../../views/templates/footer.php';
    die;
}
