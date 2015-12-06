<?php
session_start();
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');

// primitive langue
include_once('UTILS/langue.php');
// include de la connexion Mysql
include_once('MODELE/get_connexion.php');
include_once('MODELE/BILLES/get_billes.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

$pagecourante = 'reset_password';

//error_reporting(E_ALL);
if (!isset($_GET['page'])) { $cible = 'index'; } else { $cible = $_GET['page']; }

include_once('VUE/BILLES/v_reset_password.php');
