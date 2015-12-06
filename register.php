<?php
// primitive langue
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('UTILS/langue.php');
include_once('MODELE/get_connexion.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

$pagecourante = 'register';

include_once('CONTROLEUR/BILLES/c_register.php');
