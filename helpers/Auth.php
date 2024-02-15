<?php

class Auth {
    public static function verifyIsConnectedAsAdmin()
    {
        if (empty($_SESSION['subscriber']) || $_SESSION['subscriber']->is_admin !== 1) {
            header('location: /controllers/signIn-ctrl.php?error=denied');
            die();
        }
    }

    public static function verifyIsConnected()
    {
        if (empty($_SESSION['subscriber'])) {
            header('location: /controllers/signIn-ctrl.php?error=denied');
            die();
        }
    }
}