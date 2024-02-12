<?php 
session_start();

unset($_SESSION['subscriber']);

header('location: /controllers/home-ctrl.php');
die;