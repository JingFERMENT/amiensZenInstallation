<?php 
// pour fermer il faudrait mettre session_start
session_start();

unset($_SESSION['subscriber']);

header('location /');
die;