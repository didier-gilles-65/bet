<?php
session_start();
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('UTILS/security.php'); // utils for permanent login checking
// primitive langue
include_once('UTILS/langue.php');
// include de la connexion Mysql
include_once('MODELE/get_connexion.php');
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

if (isset($_GET['err'])) { $retour_post_contact = $_GET['err']; }

include_once('CONTROLEUR/BILLES/c_contact.php');
