<?php

require_once __DIR__.'/../models/Subscriber.php';
require_once __DIR__.'/../helpers/JWT.php';

try {
    $jwt = filter_input(INPUT_GET, 'jwt');

    $payload = JWT::check($jwt);
    if(!$payload){
        header('location: /');
        die;
    }

    $email = $payload->email;

    $isConfirmed = Subscriber::confirm($email);

} catch (\Throwable $th) {
    //throw $th;
}