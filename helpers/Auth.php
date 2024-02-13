<?php

class Auth {
    public static function verifyIsConnected()
    {
        if (empty($_SESSION['subscriber']) || $_SESSION['subscriber']->is_admin !== 1) {
            header('location: /controllers/signIn-ctrl.php?error=denied');
            die();
        }
    }
}