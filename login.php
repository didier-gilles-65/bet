<?php
session_start();
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');

// primitive langue
include_once('UTILS/langue.php');
// include de la connexion Mysql
include_once('MODELE/get_connexion.php');
include_once('MODELE/BILLES/get_billes.php');

$pagecourante = 'login';

//error_reporting(E_ALL);
if (!isset($_GET['page'])) { $cible = '/index.php'; } else { $cible = $_GET['page']; }

include_once('VUE/BILLES/v_login.php');
