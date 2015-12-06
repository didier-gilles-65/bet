<?php
// primitive langue
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('UTILS/langue.php');
include_once('MODELE/get_connexion.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1)
{
	header('Location: index.php?err=9000');
	exit();
}

$pagecourante = 'change_password';

include_once('MODELE/BILLES/get_billes.php'); // include pour comptage
include_once('VUE/BILLES/v_change_password.php'); // On affiche la page (vue)
